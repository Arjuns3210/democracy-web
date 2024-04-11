<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ChangeCustomerPasswordRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['customer_verify'] = checkPermission('customer_verify');
        $data['customer_view'] = checkPermission('customer_view');
        $data['customer_status'] = checkPermission('customer_status');
        $data['customer_change_password'] = checkPermission('customer_change_password');
        return view('backend/customer/index',['data' =>$data]);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = User::orderBy('updated_at','desc')->withTrashed();;
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if ($request['search']['search_phone'] && !is_null($request['search']['search_phone'])) {
                            $query->where('phone', 'like', "%" . $request['search']['search_phone'] . "%");
                        }
                        if ($request['search']['search_name'] && !is_null($request['search']['search_name'])) {
                            $query->where('name', 'like', "%" . $request['search']['search_name'] . "%");
                        }
                        if (isset($request['search']['search_status']) && !is_null($request['search']['search_status'])) {
                            if ($request['search']['search_status'] == '2'){
                               $query->onlyTrashed(); 
                            }else{
                                $query->where('deleted_at',null)->where('users.status', 'like', "%" . $request['search']['search_status'] . "%");
                            }
                        }
                        $query->get()->toArray();
                    })
                    ->editColumn('name', function ($event) {
                        $isDeleted = isRecordDeleted($event->deleted_at);
                        if (!$isDeleted) {
                            return $event->name;
                        } else {
                            return '<span class="text-danger text-center">' . $event->name . '</span>';
                        }
                    })
                    ->editColumn('phone', function ($event) {
                        $isDeleted = isRecordDeleted($event->deleted_at);
                        if (!$isDeleted) {
                            return $event->phone;
                        } else {
                            return '<span class="text-danger text-center">' . $event->phone . '</span>';
                        }
                    })
                    ->editColumn('action', function ($event) {
                        $isDeleted = isRecordDeleted($event->deleted_at);
                        $customer_verify = checkPermission('customer_verify');
                        $customer_view = checkPermission('customer_view');
                        $customer_status = checkPermission('customer_status');
                        $customer_change_password = checkPermission('customer_change_password');
                        $actions = '<span style="white-space:nowrap;">';
                        if ($customer_view) {
                            $actions .= '<a href="customer/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View customer Details" title="View"><i class="fa fa-eye"></i></a>';
                        }
                        if(!$isDeleted){

                            if ($customer_status) {
                                if ($event->status == '1') {
                                    $actions .= ' <input type="checkbox" data-url="customer/publish" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery" checked>';
                                } else {
                                    $actions .= ' <input type="checkbox" data-url="customer/publish" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery">';
                                }
                            }
                        }else{
                            $actions .= ' <span class="bg-danger text-center p-1 text-white" style="border-radius:20px !important;">Deleted</span>';
                        }
                        $actions .= '</span>';
                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['name', 'email', 'phone', 'action'])->setRowId('id')->make(true);
            } catch (\Exception $e) {
                \Log::error("Something Went Wrong. Error: " . $e->getMessage());
                return response([
                    'draw'            => 0,
                    'recordsTotal'    => 0,
                    'recordsFiltered' => 0,
                    'data'            => [],
                    'error'           => 'Something went wrong',
                ]);
            }
        }
    }
    public function show($id)
    {
        $data['customer'] = User::withTrashed()->find($id);
       // print_r($data['customer']->toArray());exit;
        return view('backend/customer/view',$data);
    }

    public function isVerify(Request $request,$id)
    {
        $data = User::find($id);
        $input['is_verified'] = 'Y';
        $data->update($input);
        successMessage('Customer Verify Successfully',[]);
    }

    public function updateStatus(Request $request)
    {
        try {
            $msg_data = array();
            $users = User::find($request->id);
            $users->status = $request->status;
            $users->save();
            if ($request->status == 1) {
                successMessage(trans('message.enable'), $msg_data);
            } else {
                errorMessage(trans('message.disable'), $msg_data);
            }
            errorMessage('Customer not found', []);
        } catch (\Exception $e) {
            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    public function changePassword($id) {
        $data['customer'] = User::find($id);
        return view('backend/customer/change_password',$data);
    }

    public function changeCustomerPassword(ChangeCustomerPasswordRequest $request)
    {
        $msg_data = array();
        $users = User::find($_GET['id']);

        if ($users->password == md5($users->email . $request->new_password)) {
            errorMessage('New password can not be same as current password.', $msg_data);
        }

        $users->password = md5($users->email . $request->new_password);
        $users->save();
        successMessage('Password updated successfully!', $msg_data);
    }
}
