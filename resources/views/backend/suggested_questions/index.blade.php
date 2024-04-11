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
                                                <h5 class="pt-2">Suggested Questions</h5>
                                            </div>
                                            <div class="col-12 col-sm-5 d-flex justify-content-end align-items-center">
                                                <button class="btn btn-sm btn-outline-danger px-3 py-1 mr-2" id="listing-filter-toggle"><i class="fa fa-filter"></i> Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <hr class="mb-0"> -->
                                    <div class="card-body">
                                        <div class="row mb-2" id="listing-filter-data" style="display: none;">
                                            <div class="col-md-4">
                                                <label>Question</label>
                                                <input class="form-control mb-3" type="text" id="search_suggested_question" name="search_suggested_question">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Submitted By</label>
                                                <input class="form-control mb-3" type="text" id="search_user_name" oninput="validateNameInput(this)" name="search_user_name">
                                            </div>
                                            <div class="col-md-4">
                                                <label>&nbsp;</label><br/>
                                                <input class="btn btn-md btn-primary px-3 py-1 mb-3" id="clear-form-data" type="reset" value="Clear Search">
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped datatable" id="dataTable" width="100%" cellspacing="0" data-url="suggested_questions/fetch">
                                                <thead>
                                                <tr>
                                                    <th class="sorting_disabled" id="id" data-orderable="false" data-searchable="false">Id</th>
                                                    <th id="question" data-orderable="false" data-searchable="false">Suggested Question</th>
                                                    <th id="user_name" data-orderable="false" data-searchable="false">Submitted By</th>
                                                    <th id="date" data-orderable="false" data-searchable="false">Submitted On</th>
                                                    @if($suggested_questions_view || $suggested_questions_status)
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
