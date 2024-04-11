<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data['category_add'] = checkPermission('category_add');
        $data['category_view'] = checkPermission('category_view');
        $data['category_edit'] = checkPermission('category_edit');
        $data['category_status'] = checkPermission('category_status');
        $data['category_delete'] = checkPermission('category_delete');
        return view('backend/category/index', ['data'=>$data]);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = Category::orderBy('updated_at', 'desc');
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if ($request['search']['search_category'] && !is_null($request['search']['search_category'])) {
                            $query->where('category_name', 'like', "%" . $request['search']['search_category'] . "%");
                        }
                        if (isset($request['search']['search_status']) && !is_null($request['search']['search_status'])) {
                            $query->where('status', 'like', "%" . $request['search']['search_status'] . "%");
                        }
                        $query->get();
                    })
                    ->editColumn('category', function ($event) {
                        return $event->category_name;
                    })
                    ->editColumn('action', function ($event) {
                        $category_view = checkPermission('category_view');
                        $category_edit = checkPermission('category_edit');
                        $category_status = checkPermission('category_status');
                        $category_delete = checkPermission('category_delete');
                        $actions = '<span style="white-space:nowrap;">';

                        if ($category_view) {
                            $actions .= '<a href="category/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View category Details" title="View"><i class="fa fa-eye"></i></a>';
                        }
                        if ($category_edit) {
                            $actions .= ' <a href="category/edit/' . $event->id . '" class="btn btn-success btn-sm src_data" title="Update"><i class="fa fa-edit"></i></a>';
                        }
                        if ($category_status) {
                            if ($event->status == '1') {
                                $actions .= ' <input type="checkbox" data-url="publish/category" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery" checked>';
                            } else {
                                $actions .= ' <input type="checkbox" data-url="publish/category" id="switchery' . $event->id . '" data-id="' . $event->id . '" class="js-switch switchery">';
                            }
                        }
                        // if($category_delete){
                        //     $actions .= ' <a data-url="category/delete/' . $event->id . '" class="btn  btn-sm delete-data btn-danger"  title="Delete"><i class="fa fa-trash"></i></a>';
                        // }

                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['category', 'action'])->setRowId('id')->make(true);
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
        return view('backend/category/add',);
    }

    public function store(CreateCategoryRequest $request)
    {

        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['created_by'] = session('data')['id'];
            Category::create($input);

            DB::commit();
            successMessage('Category Saved Successfully', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());

            errorMessage(trans('auth.something_went_wrong'));
        }
    }

    public function view($id)
    {
        $data['category'] = Category::where('id',$id)->first();

        return view('backend/category/view', $data);
    }


    public function edit($id)
    {
        $data['category'] = Category::find($id);

        return view('backend/category/edit', $data);
    }

    public function update(UpdateCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $category = Category::where('id',$input['id'])->first();
            $category->update([
                'updated_by' => session('data')['id'],
                'category_name' => $input['category_name']
            ]);

            DB::commit();
            successMessage('Category Updated Successfully', []);
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
            $category = Category::where('id',$input['id'])->first();

            if ($category->exists()) {
                $category->update($input);
                DB::commit();
                if ($request->status == 1) {
                    successMessage(trans('message.enable'), $msg_data);
                } else {
                    errorMessage(trans('message.disable'), $msg_data);
                }
            }
            errorMessage('Category not found', []);
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
            $record = Category::find($id);
            $record->delete();
            DB::commit();
            successMessage('Category Deleted successfully', []);
            return view('backend/category/index');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: ".$e->getMessage());
            errorMessage(trans('auth.something_went_wrong'));
        }
    }



}
