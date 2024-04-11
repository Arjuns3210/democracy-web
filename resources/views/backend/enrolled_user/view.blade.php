<section class="users-list-wrapper">
    <div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <h5 class="pt-2">View Enrolled User</h5>
                                </div>
                                <div class="col-12 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary px-3 py-1"><i
                                            class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <td><strong>Contest Type</strong></td>
                                                    <td>{{$enrolled->contest->type}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contest Name</strong></td>
                                                    <td>{{$enrolled->contest->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Location</strong></td>
                                                    <td>{{$enrolled->contest->location->name ?? 'NA'}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contest Date</strong></td>
                                                    @php
                                                        $data = \Carbon\Carbon::parse($enrolled->contest->contest_date);
                                                    @endphp
                                                    <td>{{$data->format('d-m-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contest Time</strong></td>
                                                    <td>{{$enrolled->contest->start_time}} - {{$enrolled->contest->end_time}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contest Details</strong></td>
                                                    <td>{{$enrolled->contest->contest_details}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Winning Award</strong></td>
                                                    <td>{{$enrolled->contest->winning_award}}</td>
                                                </tr>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <td><strong>User Name</strong></td>
                                                    <td>{{$enrolled->user->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Mobile</strong></td>
                                                    <td>{{$enrolled->user->phone ??'-'}}</td>
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
