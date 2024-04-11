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
                                                <h5 class="pt-2">Customer Report</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="user_report_export">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <label>Date Range</label>
                                                    <input type="text" class="form-control" id="date_range_picker" name="user_date" value="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button type="submit" class="btn btn-success export">Export</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
