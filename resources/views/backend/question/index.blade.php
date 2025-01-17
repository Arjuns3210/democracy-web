@extends('backend.layouts.app')
@section('content')
    <div class="main-content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <section class="users-list-wrapper">
                <div class="users-list-table">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-12 col-sm-7">
                                                <h5 class="pt-2">Manage Question</h5>
                                            </div>
                                            <div class="col-12 col-sm-5 d-flex justify-content-end align-items-center">
                                                <button class="btn btn-sm btn-outline-danger px-3 py-1 mr-2" id="listing-filter-toggle"><i class="fa fa-filter"></i> Filter</button>
                                                @if($data['question_add'])
                                                    <a href="question/add" class="btn btn-sm btn-outline-primary px-3 py-1 src_data"><i class="fa fa-plus"></i> Add Question</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <hr class="mb-0"> -->
                                    <div class="card-body">
                                        <div class="row mb-2" id="listing-filter-data" style="display: none;">
                                            <div class="col-md-4">
                                                <label>Question Code</label>
                                                <input class="form-control mb-3" type="text" id="search_question_code" oninput="validateNameInput(this, 1)" name="search_question_code">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Question</label>
                                                <input class="form-control mb-3" type="text" id="search_question" name="search_question">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Category</label>
                                                <select class="form-control select2" type="text" id="search_category" name="search_category" style="width: 100% !important;">
                                                    <option value="">All</option>
                                                    @foreach ($data['categories'] as $category )
                                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Status</label>
                                                <select class="form-control mb-3" type="text" id="search_status" name="search_status">
                                                    <option value="">All</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            <!-- <div class="col-md-4">
                                                <label>Category Name</label>
                                                <input class="form-control mb-3" type="text" id="search_category" name="search_category">
                                            </div> -->
                                            <div class="col-md-4">
                                                <label>&nbsp;</label><br/>
                                                <input class="btn btn-md btn-primary px-3 py-1 mb-3" id="clear-form-data" type="reset" value="Clear Search">
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped datatable" id="dataTable" width="100%" cellspacing="0" data-url="question/fetch">
                                                <thead>
                                                <tr>
                                                    <th class="sorting_disabled" id="id" data-orderable="false" data-searchable="false">Id</th>
                                                    <th id="question_code" data-orderable="false" data-searchable="false">Question Code</th>
                                                    <th id="question" data-orderable="false" data-searchable="false">Question</th>
                                                    <th id="category" data-orderable="false" data-searchable="false">Category</th>
                                                    @if($data['question_edit'] || $data['question_view'] || $data['question_status'] || $data['question_delete'])
                                                        <th id="action" data-orderable="false" data-searchable="false" width="130px">Action</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
