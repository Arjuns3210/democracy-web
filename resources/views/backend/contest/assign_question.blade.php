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
                                            <div class="col-lg-4 col-md-5 col-sm-4">
                                                <h5 class="pt-2">Assign Question : {!! toolTipInfo($data['name']->name,$data['name']->contest_code)!!}</h5>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-8 text-right pt-1">
                                                <button class="btn btn-sm btn-danger px-3 py-1 mr-1 mb-3" id="listing-filter-toggle"><i class="fa fa-filter"></i>&nbsp;Filter</button>
                                                <button class="btn btn-sm btn-warning px-3 py-1 mr-1 mb-3" id="AddQue"><i class="fa fa-plus"></i>&nbsp;Add&nbsp;/&nbsp;Edit</button>
                                                <button class="btn btn-sm btn-warning px-3 py-1 mr-1 mb-3" id="DelQue"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                <a href="{{route('contest')}}" class="btn btn-sm btn-primary px-3 py-1 mb-3"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                                                <input type="hidden" value="{{$data['name']->id}}" id="contest_id">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <hr class="mb-0"> -->
                                    <div class="card-body">
                                        <div class="row mb-2" id="listing-filter-data" style="display: none;">
                                            <input type="hidden" class="form-control mb-3" value="{{$data['name']->id}}" name="contest_id" id="contest_id">
                                            <div class="col-md-4">
                                                <label>Category</label>
                                                <select class="form-control mb-3" type="text" id="search_category" name="search_category">
                                                    <option value="">All</option>
                                                    @foreach ($data['categories'] as $category)
                                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div><div class="col-md-4">
                                                <label>Question</label>
                                                <input class="form-control mb-3" type="text" id="search_question" name="search_question">
                                            </div>
                                            <div class="col-md-4">
                                                <label>&nbsp;</label><br/>
                                                <input class="btn btn-md btn-primary px-3 py-1 mb-3" id="clear-form-data" type="reset" value="Clear Search">
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped datatable" id="dataTable" width="100%" cellspacing="0" data-url="{{route('contest/question_list')}}">
                                                <thead>
                                                <tr>
                                                    <th class="sorting_disabled" id="id" data-orderable="false" data-searchable="false">Id</th>
                                                    <th id="checkbox" data-orderable="false" data-searchable="false">Select</th>
                                                    <th id="sequence" data-orderable="false" data-searchable="false">sequence</th>
                                                    <th id="question" data-orderable="false" data-searchable="false">Question ({{$data['question_count']}})</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="pull-right">
                                                    <button type="button" class="btn btn-danger" id="deleteQuestionData" style="display:none;">Delete</button>
                                                    <button type="button" class="btn btn-success" id="questionData" style="display:none;">Submit</button>
                                                </div>
                                            </div>
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
