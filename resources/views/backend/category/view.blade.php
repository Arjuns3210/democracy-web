<section class="users-list-wrapper">
    <div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <h5 class="pt-2">View Category : {{$category->category_name}}</h5>
                                </div>
                                <div class="col-12 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary px-3 py-1"><i
                                            class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade mt-2 show active" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <td><strong>Category Name</strong></td>
                                                    <td>{{$category->category_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status</strong></td>
                                                    <td> {{displayStatus($category->status)}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Creation Date</strong></td>
                                                    @php
                                                        $data = \Carbon\Carbon::parse($category->created_at);
                                                    @endphp
                                                    <td>{{$data->format('d-m-Y')}}</td>
                                                </tr>
                                            </table>
                                            </div>
                                        </div>
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