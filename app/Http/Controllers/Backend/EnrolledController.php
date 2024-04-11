<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EnrolledContest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EnrolledController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['enrolled_user_view'] = checkPermission('enrolled_user_view');
        $data['enrolled_user_status'] = checkPermission('enrolled_user_status');
        return view('backend/enrolled_user/index', $data);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = EnrolledContest::with('contest','user')->orderBy('updated_at','desc');
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if (isset($request['search']['search_contest_name']) && !is_null($request['search']['search_contest_name'])) {
                            $query->whereHas('contest', function ($contest) use ($request) {
                                $contest->where('name', 'like', "%" . $request['search']['search_contest_name'] . "%");
                            });
                        }
                        if (isset($request['search']['search_user_name']) && !is_null($request['search']['search_user_name'])) {
                            $query->whereHas('user', function ($user) use ($request) {
                                $user->where('name', 'like', "%" . $request['search']['search_user_name'] . "%");
                            });
                        }
                        if (isset($request['search']['date_range_picker']) && !is_null($request['search']['date_range_picker'])) {
                            $date = explode(" - ",$request['search']['date_range_picker']);
                            $startDate = $date[0];
                            $endDate = $date[1];
                            $format = 'd/m/Y';

                            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay()->format("Y-m-d H:i:s");
                            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay()->format("Y-m-d H:i:s");
                            $query->whereBetween('created_at', [$startDate ,$endDate]);
                        }
                        if (isset($request['search']['search_status']) && !is_null($request['search']['search_status'])) {
                            $query->where('status', 'like', "%" . $request['search']['search_status'] . "%");
                        }
                        $query->get()->toArray();
                    })
                    ->editColumn('contest', function ($event) {
                        return $event->contest->name;
                    })
                    ->editColumn('user', function ($event) {
                        return $event->user->name;
                    })
                    ->editColumn('date', function ($event) {
                        return $event->created_at->format('d-m-Y');;
                    })
                    ->editColumn('action', function ($event) {
                        $enrolled_user_view = checkPermission('enrolled_user_view');
                        $enrolled_user_status = checkPermission('enrolled_user_status');
                        $actions = '<span style="white-space:nowrap;">';
                        if ($enrolled_user_view) {
                            $actions .= '<a href="enrolled_user/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View customer Details" title="View"><i class="fa fa-eye"></i></a>';
                        }
                        $actions .= '</span>';
                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['contest', 'user', 'action'])->setRowId('id')->make(true);
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
        $data['enrolled'] = EnrolledContest::with('user','contest')->find($id);

        return view('backend/enrolled_user/view', $data);
    }
    public function updateStatus(Request $request)
    {
        try {
            $msg_data = array();
            $users = EnrolledUser::find($request->id);
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
}
