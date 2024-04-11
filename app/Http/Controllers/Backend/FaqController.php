<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Faq;
use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['faq_add'] = checkPermission('faq_add');
        $data['faq_view'] = checkPermission('faq_view');
        $data['faq_edit'] = checkPermission('faq_edit');
        $data['faq_status'] = checkPermission('faq_status');

        return view('backend/faqs/index', ['data'=>$data]);
    }

    /**
     * Fetch and display data for DataTables.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request){
        if ($request->ajax()) {
            try {
                $query = Faq::orderBy('id','desc');
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if ($request['search']['search_que'] && ! is_null($request['search']['search_que'])) {
                            $query->where('question', 'like', "%" . $request['search']['search_que'] . "%");
                        }
                        if (isset($request['search']['search_status']) && !is_null($request['search']['search_status'])) {
                            $query->where('status', 'like', "%" . $request['search']['search_status'] . "%");
                        }
                        $query->get();
                    })
                    ->editColumn('question', function ($event) {
                        return $event->question;
                    })
                    ->editColumn('answer', function ($event) {
                        return $event->answer;
                    })
                    ->editColumn('action', function ($event) {
                        $faq_view = checkPermission('faq_view');
                        $faq_edit = checkPermission('faq_edit');
                        $faq_status = checkPermission('faq_status');

                        $actions = '<span style="white-space:nowrap;">';
                        if ($faq_view) {
                            $actions .= '<a href="faq/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View FAQ Details" title="View"><i class="fa fa-eye"></i></a>';
                        }
                        if($faq_edit) {
                            $actions .= ' <a href="faq/edit/'.$event->id.'" class="btn btn-success btn-sm src_data" title="Update"><i class="fa fa-edit"></i></a>';
                        }

                        if($faq_status) {
                                if($event->status == '1') {
                                    $actions .= ' <input type="checkbox" data-url="faq/publish" id="switchery'.$event->id.'" data-id="'.$event->id.'" class="js-switch switchery" checked>';
                                } else {
                                    $actions .= ' <input type="checkbox" data-url="faq/publish" id="switchery'.$event->id.'" data-id="'.$event->id.'" class="js-switch switchery">';
                                }
                        }
                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['question','answer','action'])->setRowId('id')->make(true);
            }
            catch (\Exception $e) {
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
    public function create() {
        return view('backend/faqs/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFaqRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['created_by'] = session('data')['id'];
            Faq::create($input);

            DB::commit();
            successMessage('FAQ Saved Successfully', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());

            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['data'] = Faq::find($id);
        return view('backend/faqs/view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data['data'] = Faq::find($id);
        return view('backend/faqs/edit',$data);
    }

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $faq = Faq::where('id',$input['id'])->first();
            $faq->update([
                'updated_by' => session('data')['id'],
                'question' => $input['question'],
                'answer' => $input['answer']
            ]);

            DB::commit();
            successMessage('FAQ Updated Successfully', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());

            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    /**
    * Update the status of a FAQ.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $msg_data = array();
            $input = $request->all();
            $input['updated_by'] = session('data')['id'];
            $faq = Faq::where('id',$input['id'])->first();

            if ($faq->exists()) {
                $faq->update($input);
                DB::commit();
                if ($request->status == 1) {
                    successMessage(trans('message.enable'), $msg_data);
                } else {
                    errorMessage(trans('message.disable'), $msg_data);
                }
            }
            errorMessage('FAQ not found', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: " . $e->getMessage());
            errorMessage(trans('auth.something_went_wrong'));
        }
    }

}
