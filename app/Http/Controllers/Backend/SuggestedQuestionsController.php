<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuggestedQuestion;
use Yajra\DataTables\DataTables;


class SuggestedQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['suggested_questions_view'] = checkPermission('suggested_questions_view');
        $data['suggested_questions_status'] = checkPermission('suggested_questions_status');
        return view('backend/suggested_questions/index', $data);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = SuggestedQuestion::with('user')->orderBy('updated_at', 'desc');
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if (isset($request['search']['search_suggested_question']) && !is_null($request['search']['search_suggested_question'])) {
                            $query->where('question', 'like', "%" . $request['search']['search_suggested_question'] . "%");
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
                    ->editColumn('question', function ($event) {
                        return $event->question;
                    })
                    ->editColumn('user_name', function ($event) {
                        return $event->user->name;
                    })
                    ->editColumn('date', function ($event) {
                        return $event->created_at->format('d-m-Y');
                        ;
                    })
                    ->editColumn('action', function ($event) {
                        $suggested_questions_view = checkPermission('suggested_questions_view');
                        $suggested_questions_status = checkPermission('suggested_questions_status');
                        $actions = '<span style="white-space:nowrap;">';
                        if ($suggested_questions_view) {
                            $actions .= '<a href="suggested_questions/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View" title="View"><i class="fa fa-eye"></i></a>';
                        }
                        $actions .= '</span>';
                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['question', 'user_name', 'date', 'action'])->setRowId('id')->make(true);
            } catch (\Exception $e) {
                \Log::error("Something Went Wrong. Error: " . $e->getMessage());
                return response([
                    'draw' => 0,
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'error' => 'Something went wrong',
                ]);
            }
        }
    }
    public function show($id)
    {
        $data['data'] = SuggestedQuestion::with('suggestedQuestionOptions')->find($id);

        return view('backend/suggested_questions/view', $data);
    }
    public function updateStatus(Request $request)
    {
        try {
            $msg_data = array();
            $question = SuggestedQuestion::find($request->id);
            $question->status = $request->status;
            $question->save();
            if ($request->status == 1) {
                successMessage(trans('message.enable'), $msg_data);
            } else {
                errorMessage(trans('message.disable'), $msg_data);
            }
            errorMessage('Suggested question not found', []);
        } catch (\Exception $e) {
            errorMessage(trans('auth.something_went_wrong'));
        }
    }
}
