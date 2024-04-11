<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['banner_view'] = checkPermission('banner_view');
        $data['banner_edit'] = checkPermission('banner_edit');
        $data['banner_delete'] = checkPermission('banner_delete');
        return view('backend/banner/index', ['data' => $data]);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = Banner::orderBy('updated_at', 'desc');
                return DataTables::of($query)
                    ->filter(function ($query) use ($request) {
                        if ($request['search']['search_name'] && !is_null($request['search']['search_name'])) {
                            $query->where('name', 'like', "%" . $request['search']['search_name'] . "%");
                        }
                        $query->get();
                    })
                    ->editColumn('name', function ($event) {
                        return $event->name;
                    })
                    ->editColumn('action', function ($event) {
                        $banner_view = checkPermission('banner_view');
                        $banner_edit = checkPermission('banner_edit');
                        $actions = '<span style="white-space:nowrap;">';

                        if ($banner_view) {
                            $actions .= '<a href="banner/view/' . $event->id . '" class="btn btn-primary btn-sm src_data" data-size="large" data-title="View Banner Details" title="View"><i class="fa fa-eye"></i></a>';
                        }
                        if ($banner_edit) {
                            $actions .= ' <a href="banner/edit/' . $event->id . '" class="btn btn-success btn-sm src_data" title="Update"><i class="fa fa-edit"></i></a>';
                        }

                        return $actions;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['name', 'action'])->setRowId('id')->make(true);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function view($id)
    {
        $data['data'] = Banner::where('id', $id)->first();

        $data['media'] = $data['data']->getMedia(Banner::IMAGE)->first() ?? '';


        return view('backend/banner/view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $data['data'] = Banner::find($id);
        if (!empty($data['data'])) {
            $data['media'] = $data['data']->getMedia(Banner::IMAGE)->first() ?? '';
        }
        return view('backend/banner/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $banner = Banner::find($input['id']);
            $input['updated_by'] = session('data')['id'];

            $banner->update($input);
            if (!empty($input['image'])) {
                $banner->clearMediaCollection(Banner::IMAGE);
                storeMedia($banner, $input['image'], Banner::IMAGE, $input['id']);
            }
            DB::commit();
            successMessage('Banner Updated Successfully', []);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: " . $e->getMessage());

            errorMessage(trans('auth.something_went_wrong'));
        }
    }

}
