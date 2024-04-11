<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Winner;
use App\Models\User;
use App\Models\Contest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WinnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['winners_view'] = checkPermission('winners_view');
        $data['winners_status'] = checkPermission('winners_status');
        return view('backend/winners/index', $data);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = winner::with('contest','user')->orderBy('updated_at','desc');
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
                    ->editColumn('score', function ($event) {
                        return $event->score;
                    })
                    ->editColumn('action', function ($event) {
                        $winners_view = checkPermission('winners_view');
                        $winners_status = checkPermission('winners_status');
                        $actions = '<span style="white-space:nowrap;">';
                        if ($winners_view) {
                            $actions .= '<a href="winners/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View customer Details" title="View"><i class="fa fa-eye"></i></a>';
                        }
                        if ($winners_status) {
                            if ($event->status == '1') {
                                $actions .= ' <input type="checkbox" data-url="publish/winners" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery" checked>';
                            } else {
                                $actions .= ' <input type="checkbox" data-url="publish/winners" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery">';
                            }
                        }
                        $actions .= '</span>';
                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['contest', 'user', 'score', 'action'])->setRowId('id')->make(true);
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
        $data['winners'] = Winner::with('user','contest')->find($id);

        return view('backend/winners/view', $data);
    }
    public function updateStatus(Request $request)
    {
        try {
            $msg_data = array();
            $users = Winner::find($request->id);
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
