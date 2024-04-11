<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Category;
use App\Models\Contest;
use App\Models\ContestQuestion;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['question_add'] = checkPermission('question_add');
        $data['question_view'] = checkPermission('question_view');
        $data['question_edit'] = checkPermission('question_edit');
        $data['question_status'] = checkPermission('question_status');
        $data['question_delete'] = checkPermission('question_delete');
        $data['categories'] = Category::where('status',1)->get();
        return view('backend/question/index', ["data" =>$data]);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = Question::with('option','category')->orderBy('updated_at', 'desc');
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if ($request['search']['search_question'] && !is_null($request['search']['search_question'])) {
                            $query->where('question', 'like', "%" . $request['search']['search_question'] . "%");
                        }
                        if ($request['search']['search_question_code'] && !is_null($request['search']['search_question_code'])) {
                            $query->where('question_code', 'like', "%" . $request['search']['search_question_code'] . "%");
                        }
                        if (isset($request['search']['search_status']) && !is_null($request['search']['search_status'])) {
                            $query->where('status', 'like', "%" . $request['search']['search_status'] . "%");
                        }
                        if (isset($request['search']['search_category']) && !is_null($request['search']['search_category'])) {
                            $query->where('category_id',  $request['search']['search_category'] );
                        }

                        $query->get();
                    })

                    ->editColumn('question_code', function ($event) {
                        return $event->question_code;
                    })
                    ->editColumn('question', function ($event) {
                        return $event->question;
                    })
                    ->editColumn('category', function ($event) {
                        return $event->category->category_name ??'';
                    })
                    ->editColumn('action', function ($event) {
                        $question_view = checkPermission('question_view');
                        $question_edit = checkPermission('question_edit');
                        $question_status = checkPermission('question_status');
                        $question_delete = checkPermission('question_delete');
                        $flag = false;
                        $question_ids = ContestQuestion::where('question_id', $event->id)->pluck('contest_id')->toArray();

                        if (!empty($question_ids)) {
                            $contestsData = Contest::whereIn('id', $question_ids)->get();

                            foreach ($contestsData as $contestData) {
                                $contest_startTime = $contestData->contest_date . ' ' . $contestData->start_time;
                                $contest_endTime = $contestData->contest_date . ' ' . $contestData->end_time;

                                if ((date("Y-m-d H:i:s")) > $contest_startTime && (date("Y-m-d H:i:s")) < $contest_endTime) {
                                    $flag = true;
                                    break;
                                }
                            }
                        }

                        $actions = '<span style="white-space:nowrap;">';

                        if ($question_view) {
                            $actions .= '<a href="question/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View question Details" title="View"><i class="fa fa-eye"></i></a>';
                        }

                        if ($question_edit) {
                            $updateButton = ($flag)
                                ? ' <a class="btn btn-danger btn-sm" title="Update" id="question_edit"> <i class="fa fa-edit"></i></a>'
                                : ' <a href="question/edit/' . $event->id . '" class="btn btn-success btn-sm src_data" title="Update"><i class="fa fa-edit"></i></a>';
                            $actions .= $updateButton;
                        }
                        if ($question_status) {
                            if ($event->status == '1') {
                                $actions .= ' <input type="checkbox" data-url="publish/question" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery" checked>';
                            } else {
                                $actions .= ' <input type="checkbox" data-url="publish/question" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery">';
                            }
                        }
                        // if ($question_delete) {
                        //     $actions .= ' <a data-url="question/delete/' . $event->id . '" class="btn  btn-sm delete-data btn-danger"  title="Delete"><i class="fa fa-trash"></i></a>';
                        // }

                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['question', 'level', 'category', 'action'])->setRowId('id')->make(true);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data['categories'] = Category::all();
        return view('backend/question/add',$data);
    }

    public function store(CreateQuestionRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = Question::create([
                'question' => $request['question'],
                'max_allowed_answer' => 1,
                'level' => "easy",
                'category_id' => $request['category'],
                'created_by' => session('data')['id']
            ]);

            $question = Question::where('id',$data->id)->first();
            $question->update([
                'question_code' => 'Q000'.$question['id']
            ]);

            foreach ($request['option'] as $option) {
            $option = QuestionOption::create([
                'question_id'=> $data->id,
                'option'=> $option,
                'created_by' => session('data')['id']
            ]);
            }
            DB::commit();
            successMessage('Question Saved Successfully', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());

            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $data['data'] = Question::with('option','category')->where('id',$id)->first();
        return view('backend/question/view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['question'] = Question::with('option')->find($id);
        $data['categories'] = Category::all();
        return view('backend/question/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $flag = false;
            $question_ids = ContestQuestion::where('question_id', $input['id'])->pluck('contest_id')->toArray();

            if (!empty($question_ids)) {
                $contestsData = Contest::whereIn('id', $question_ids)->get();

                foreach ($contestsData as $contestData) {
                    $contest_startTime = $contestData->contest_date . ' ' . $contestData->start_time;
                    $contest_endTime = $contestData->contest_date . ' ' . $contestData->end_time;

                    if ((date("Y-m-d H:i:s")) > $contest_startTime && (date("Y-m-d H:i:s")) < $contest_endTime) {
                        $flag = true;
                        break;
                    }
                }
            }

            if($flag){
                errorMessage("This question is currently used in a running contest, please update after the contest is completed");
            }

            $question = Question::where('id',$input['id'])->first();
            $question->update([
                'updated_by' => session('data')['id'],
                'question' => $input['question'],
                'level' => "easy",
                'category_id' => $input['category']
            ]);

            $quesOptIdsData = QuestionOption::where('question_id', $question->id)->pluck('id')->toArray();
            $result = array_diff($quesOptIdsData, $input['opID']);
            foreach($result as $resId) {
                QuestionOption::find($resId)->forceDelete();
            }

            foreach ($input['option'] as $idkey => $option) {
                if(isset($input['opID'][$idkey])) {
                    $optionData = QuestionOption::where('id', $input['opID'][$idkey])->first();
                    $optionData->update([
                        'option' => $option,
                        'updated_by' => session('data')['id'],

                    ]);
                } else {
                    $optionData = QuestionOption::create([
                        'question_id'=> $question->id,
                        'option'=> $option,
                        'updated_by' => session('data')['id']
                    ]);
                }
            }
            DB::commit();
            successMessage('Question Updated Successfully', []);
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
            $question = Question::where('id',$input['id'])->first();

            if ($question->exists()) {
                $question->update($input);
                DB::commit();
                if ($request->status == 1) {
                    successMessage(trans('message.enable'), $msg_data);
                } else {
                    errorMessage(trans('message.disable'), $msg_data);
                }
            }
            errorMessage('Question not found', []);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Something Went Wrong. Error: " . $e->getMessage());
            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $record = Question::find($id);
            $record->delete();
            DB::commit();
            successMessage('Question Deleted successfully', []);
            return view('backend/question/index');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());
            errorMessage(trans('auth.something_went_wrong'));
        }
    }
}
