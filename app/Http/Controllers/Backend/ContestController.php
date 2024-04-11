<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\CorrectAnswer;
use App\Models\Location;
use App\Models\Question;
use App\Models\Category;
use App\Models\ContestQuestion;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CreateContestRequest;
use App\Http\Requests\UpdateContestRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['contest_add'] = checkPermission('contest_add');
        $data['contest_view'] = checkPermission('contest_view');
        $data['contest_edit'] = checkPermission('contest_edit');
        $data['contest_status'] = checkPermission('contest_status');
        $data['contest_delete'] = checkPermission('contest_delete');
        return view('backend/contest/index', ['data'=>$data]);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = Contest::orderBy('updated_at', 'desc');
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if ($request['search']['search_contest_code'] && !is_null($request['search']['search_contest_code'])) {
                            $query->where('contest_code', 'like', "%" . $request['search']['search_contest_code'] . "%");
                        }if ($request['search']['search_contest_name'] && !is_null($request['search']['search_contest_name'])) {
                            $query->where('name', 'like', "%" . $request['search']['search_contest_name'] . "%");
                        }
                        if (isset($request['search']['search_status']) && !is_null($request['search']['search_status'])) {
                            $query->where('status', 'like', "%" . $request['search']['search_status'] . "%");
                        }
                        if (isset($request['search']['search_date']) && !is_null($request['search']['search_date'])) {
                            $query->where('contest_date', $request['search']['search_date']);
                        }
                        if (isset($request['search']['search_on_tv']) && !is_null($request['search']['search_on_tv'])) {
                            $query->where('on_tv', $request['search']['search_on_tv']);
                        }
                        if (isset($request['search']['date_range_picker']) && !is_null($request['search']['date_range_picker'])) {
                            $date = explode(" - ",$request['search']['date_range_picker']);
                            $startDate = $date[0];
                            $endDate = $date[1];
                            $format = 'd/m/Y';

                            $startDate = Carbon::createFromFormat($format, $startDate)->format("Y-m-d");
                            $endDate = Carbon::createFromFormat($format, $endDate)->format("Y-m-d");
                            $query->whereBetween('contest_date', [$startDate ,$endDate]);
                        }

                        $query->get();
                    })
                    ->editColumn('contest_code', function ($event) {
                        return $event->contest_code;
                    })
                    ->editColumn('name', function ($event) {
                        return $event->name;
                    })
                    ->editColumn('date', function ($event) {
                        return date('d-m-Y', strtotime($event->contest_date));
                    })
                    ->editColumn('action', function ($event) {
                        $contest_date = $event->contest_date.' '.$event->start_time;
                        $contest_view = checkPermission('contest_view');
                        $contest_edit = checkPermission('contest_edit');
                        $contest_copy = checkPermission('$contest_copy');
                        $contest_status = checkPermission('contest_status');
                        $contest_delete = checkPermission('contest_delete');
                        $actions = '<span style="white-space:nowrap;">';

                        if ($contest_view) {
                            $actions .= '<a href="contest/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View question Details" title="View"><i class="fa fa-eye"></i></a>';
                        }
                        if(date("Y-m-d H:i:s") < $contest_date){
                            if ($contest_edit) {
                                $actions .= ' <a href="contest/edit/' . $event->id . '" class="btn btn-success btn-sm src_data" title="Update"><i class="fa fa-edit"></i></a>';
                                $actions .= ' <a href="mapp_question/' . $event->id . '" class="btn btn-info btn-sm" title="Assign Question"><i class="fa fa-question" aria-hidden="true"></i></a>';
                            }
                        }
                        if ($contest_copy) {
                            $actions .= ' <a href="contest/copy/' . $event->id . '" class="btn btn-warning btn-sm src_data" title="Copy"><i class="fa fa-clone" aria-hidden="true"></i></a>';
                        }
                        if ($contest_status) {
                            if ($event->status == '1') {
                                $actions .= ' <input type="checkbox" data-url="publish/contest" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery" checked>';
                            } else {
                                $actions .= ' <input type="checkbox" data-url="publish/contest" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery">';
                            }
                        }
                       

                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['type', 'contest_details', 'location' ,'action'])->setRowId('id')->make(true);
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
        $data['questions'] = Question::all();
        $data['locations'] = Location::all();
        $data['categories'] = Category::all();

        return view('backend/contest/add',$data);
    }

    public function store(CreateContestRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['created_by'] = session('data')['id'];
            $input['contest_date'] = Carbon::parse($input['contest_date'])->format('Y-m-d');
            $input['registration_start_date'] = Carbon::parse($input['registration_start_date'])->format('Y-m-d');
            $input['registration_allowed_until'] =$input['contest_date'];
            $input['cancellation_allowed'] = $request->cancellation_allowed == 'on' ? 'Yes' : 'No' ;
            $input['on_tv'] = $request->on_tv == 'on' ? 'Yes' : 'No' ;
            $data = Contest::create($input);
            $data->update([
                'contest_code' => 'C000'.$data['id']
            ]);

            DB::commit();
            successMessage('Contest Saved Successfully', []);
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
        $data['data'] = Contest::where('id',$id)->first();
        $contestEndDate = Carbon::parse($data['data']->contest_date.' '.$data['data']->end_time)->format('Y-m-d H:i:s');
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $contestResultData = [];
        if ($contestEndDate < $now) {
            $contestCorrectAnswers = CorrectAnswer::where('contest_id', $data['data']->id)->get();
            foreach ($contestCorrectAnswers as $contestCorrectAnswer){
                $contestResultData[] = [
                    'question' => $contestCorrectAnswer->question->question ?? '',
                    'option'   => $contestCorrectAnswer->option->option ?? '',
                ];
            }
        }
        $data['contestResultData'] = $contestResultData;
        
        return view('backend/contest/view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['questions'] = Question::all();
        $data['locations'] = Location::all();
        $data['data'] = Contest::find($id);
        $data['contestIds'] = explode(',',$data['data']['mapped_questions'] ?? '');

        return view('backend/contest/edit', $data);
    }

    public function copy($id)
    {
        $data['questions'] = Question::all();
        $data['locations'] = Location::all();
        $data['data'] = Contest::find($id);
        $data['contestIds'] = explode(',',$data['data']['mapped_questions'] ?? '');
        if(!empty($data['data'])){
            $data['media'] =$data['data']->getMedia(Contest::IMAGE)->first()?? '';
        }
        return view('backend/contest/copy', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContestRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['contest_date'] = Carbon::parse($input['contest_date'])->format('Y-m-d');
            $input['registration_start_date'] = Carbon::parse($input['registration_start_date'])->format('Y-m-d');
            $input['registration_allowed_until'] = $input['contest_date'];
            $contest = Contest::find($input['id']);
            $contest_date = $contest['contest_date'].' '.$contest['start_time'];

            if(date("Y-m-d H:i:s") > $contest_date){
                errorMessage("Contest started you can not edit");
            }
            $input['updated_by'] = session('data')['id'];

            $input['mapped_questions'] = implode(',', $input['mapped_questions'] ?? []);
            $input['cancellation_allowed'] = $request->cancellation_allowed == 'on' ? 'Yes' : 'No' ;
            $input['on_tv'] = $request->on_tv == 'on' ? 'Yes' : 'No' ;
            $contest->update($input);

            DB::commit();
            successMessage('Contest Updated Successfully', []);
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
            $question = Contest::where('id',$input['id'])->first();

            if ($question->exists()) {
                $question->update($input);
                DB::commit();
                if ($request->status == 1) {
                    successMessage(trans('message.enable'), $msg_data);
                } else {
                    errorMessage(trans('message.disable'), $msg_data);
                }
            }
            errorMessage('Contest not found', []);
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
    public function destroy( $id)
    {
        try {
            DB::beginTransaction();
            $record = Contest::find($id);
            $record->delete();
            DB::commit();
            successMessage('Contest Deleted successfully', []);
            return view('backend/contest/index');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());
            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    public function assignQuestion($id)
    {
        $data['contest_add'] = checkPermission('contest_add');
        $data['contest_view'] = checkPermission('contest_view');
        $data['contest_edit'] = checkPermission('contest_edit');
        $data['contest_status'] = checkPermission('contest_status');
        $data['contest_delete'] = checkPermission('contest_delete');
        $data['categories'] = Category::all();
        $data['name'] = Contest::find($id);
        $data['question_count'] = ContestQuestion::where('contest_id', $id)->count();
        return view('backend/contest/assign_question',['data'=> $data]);
    }

    public function questionList(Request $request){
        $id = $request['search']['contest_id'];
        if ($request->ajax()) {
            try {
                $query = Question::with('category')->where('status',1)->orderBy('updated_at', 'desc');
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if ($request['search']['search_category'] && !is_null($request['search']['search_category'])) {
                            $query->where('category_id', 'like', "%" . $request['search']['search_category'] . "%");
                        }
                        if ($request['search']['search_question'] && !is_null($request['search']['search_question'])) {
                            $query->where('question', 'like', "%" . $request['search']['search_question'] . "%");
                        }
                        $query->get();
                    })
                    ->editColumn('checkbox', function ($event) use ($id){
                        return '<div class="text-center"><input class="form-check-input myCheckbox" type="checkbox" id="question_checkox'.$event->id.'" name="id[]" value="'.$event->id.'" disabled></div>';
                    })
                    ->editColumn('sequence', function ($event) use($id){
                        $question_ids = ContestQuestion::where('contest_id',$id)->get();
                        $question_id = [];
                        for($i=0 ; $i<count($question_ids) ; $i++){
                            $question_id[] = $question_ids[$i]->question_id;
                        }
                        if(in_array($event->id, $question_id)){
                            $value = ContestQuestion::where('contest_id',$id)->where('question_id',$event->id)->get();
                            return '<input type="number" class="form-control sequence" name="sequence[]" id="sequence'.$event->id.'" autocomplete="off" disabled style="opacity:0.5;background:#dedede" value="'.$value[0]->sequence.'">';
                        }
                        return '<input type="number" class="form-control sequence" name="sequence[]" id="sequence'.$event->id.'" autocomplete="off" disabled style="opacity:0.5;background:#dedede">';
                    })
                    ->editColumn('question', function ($event) use($id){
                        $question_ids = ContestQuestion::where('contest_id',$id)->get();
                        $question_id = [];
                        for($i=0 ; $i<count($question_ids) ; $i++){
                            $question_id[] = $question_ids[$i]->question_id;
                        }
                        if(in_array($event->id, $question_id)){
                            return '<div class="d-flex align-items-center"><i class="fa fa-check success mr-2"></i><span>'.$event->question.'</span></div>';
                        }
                        return $event->question;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['checkbox', 'sequence', 'question' ,'action'])->setRowId('id')->make(true);
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
    public function saveContestQuestion(Request $request){
        $input =$_POST['question_data'];

        foreach($input as $key => $value){
            $newRow=ContestQuestion::where('contest_id',$_POST['contest_id'])->where('question_id',$value[0])->first();
            if($newRow === null){
                ContestQuestion::create([
                    'contest_id'=> $_POST['contest_id'],
                    'question_id'=> $value[0],
                    'sequence'=> $value[1]
                ]);
            }
            else{
                $newRow->update([
                    'sequence' => $value[1]
                ]);
            }

        }

        successMessage('Contest Question Added', []);

    }

    public function deleteMappedQuestion(Request $request){

        try {
            DB::beginTransaction();
            foreach($request->question_ids as $id){
                $record = ContestQuestion::where('contest_id',$request->contest_id)->where('question_id',$id);
                $record->forceDelete();
            }
            DB::commit();
            successMessage('Question Deleted successfully', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());
            errorMessage(trans('auth.something_went_wrong'));
        }

    }
    public function getCategory($id = null){
        $perPage = $_GET['perPage'];
        $categories = $id ? Question::where('category_id', $id)->paginate($perPage)
                        : Question::paginate($perPage);
        return response()->json($categories);
    }
}
