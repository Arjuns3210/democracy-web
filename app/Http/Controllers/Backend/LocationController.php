<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Requests\CreateLocationRequest;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $data['location_add'] = checkPermission('location_add');
        $data['location_view'] = checkPermission('location_view');
        $data['location_edit'] = checkPermission('location_edit');
        $data['location_status'] = checkPermission('location_status');
        $data['location_delete'] = checkPermission('location_delete');
        return view('backend/location/index', ['data'=>$data]);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = Location::orderBy('updated_at', 'desc');
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if ($request['search']['search_name'] && !is_null($request['search']['search_name'])) {
                            $query->where('name', 'like', "%" . $request['search']['search_name'] . "%");
                        }
                        if ($request['search']['search_google_address'] && !is_null($request['search']['search_google_address'])) {
                            $query->where('google_address', 'like', "%" . $request['search']['search_google_address'] . "%");
                        }
                        if (isset($request['search']['search_status']) && !is_null($request['search']['search_status'])) {
                            $query->where('status', 'like', "%" . $request['search']['search_status'] . "%");
                        }
                        $query->get();
                    })
                    ->editColumn('name', function ($event) {
                        return $event->name;
                    })
                    ->editColumn('google_address', function ($event) {
                        return $event->google_address;
                    })
                    ->editColumn('action', function ($event) {
                        $location_view = checkPermission('location_view');
                        $location_edit = checkPermission('location_edit');
                        $location_status = checkPermission('location_status');
                        $location_delete = checkPermission('location_delete');
                        $actions = '<span style="white-space:nowrap;">';

                        if ($location_view) {
                            $actions .= '<a href="location/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View location Details" title="View"><i class="fa fa-eye"></i></a>';
                        }
                        if ($location_edit) {
                            $actions .= ' <a href="location/edit/' . $event->id . '" class="btn btn-success btn-sm src_data" title="Update"><i class="fa fa-edit"></i></a>';
                        }
                        if ($location_status) {
                            if ($event->status == '1') {
                                $actions .= ' <input type="checkbox" data-url="publish/location" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery" checked>';
                            } else {
                                $actions .= ' <input type="checkbox" data-url="publish/location" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery">';
                            }
                        }
                        // if($location_delete){
                        //     $actions .= ' <a data-url="location/delete/' . $event->id . '" class="btn  btn-sm delete-data btn-danger"  title="Delete"><i class="fa fa-trash"></i></a>';
                        // }

                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['name', 'google_address','action'])->setRowId('id')->make(true);
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

    public function add()
    {
        return view('backend/location/add',);
    }

    public function store(CreateLocationRequest $request)
    {

        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['created_by'] = session('data')['id'];
            Location::create($input);

            DB::commit();
            successMessage('Location Saved Successfully', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());

            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    public function view($id)
    {
        $data['location'] = Location::where('id',$id)->first();

        return view('backend/location/view', $data);
    }


    public function edit($id)
    {
        $data['location'] = Location::find($id);

        return view('backend/location/edit', $data);
    }

    public function update(UpdateLocationRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $location = Location::where('id',$input['id'])->first();
            $location->update([
                'updated_by' => session('data')['id'],
                'name' => $input['name'],
                'google_address' => $input['google_address']
            ]);

            DB::commit();
            successMessage('Location Updated Successfully', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());

            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $msg_data = array();
            $input = $request->all();
            $input['updated_by'] = session('data')['id'];
            $location = Location::where('id',$input['id'])->first();

            if ($location->exists()) {
                $location->update($input);
                DB::commit();
                if ($request->status == 1) {
                    successMessage(trans('message.enable'), $msg_data);
                } else {
                    errorMessage(trans('message.disable'), $msg_data);
                }
            }
            errorMessage('Location not found', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: " . $e->getMessage());
            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $record = Location::find($id);
            $record->delete();
            DB::commit();
            successMessage('Location Deleted successfully', []);
            return view('backend/location/index');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());
            errorMessage(trans('auth.something_went_wrong'));
        }
    }



}
