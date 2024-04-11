<section class="users-list-wrapper">
    <div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <h5 class="pt-2">View Winner</h5>
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
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#details">Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#contest">Contest</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#user">User</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="user" class="tab-pane fade mt-2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <tr>
                                                            <td><strong>User Name</strong></td>
                                                            <td>{{$winners->user->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Email</strong></td>
                                                            <td>{{$winners->user->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Mobile</strong></td>
                                                            <td>{{$winners->user->phone ?? '-'}}</td>
                                                        </tr>
                                                    </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="contest" class="tab-pane fade mt-2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <tr>
                                                            <td><strong>Contest Name</strong></td>
                                                            <td>{{$winners->contest->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Location</strong></td>
                                                            <td>{{$winners->contest->location->name ?? "-"}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Contest Details</strong></td>
                                                            <td>{{$winners->contest->contest_details}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Winning Award</strong></td>
                                                            <td>{!! nl2br($winners->contest->winning_award) !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Contest Date</strong></td>
                                                            @php
                                                                $data = \Carbon\Carbon::parse($winners->contest->contest_date);
                                                            @endphp
                                                            <td>{{$data->format('d-m-Y')}}</td>
                                                        </tr>
                                                    </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="details" class="tab-pane fade mt-2 active show" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <tr>
                                                            <td><strong>Award</strong></td>
                                                            <td>{!! nl2br($winners->contest->winning_award) !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Score</strong></td>
                                                            <td>{{$winners->score}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Winnig Date</strong></td>
                                                            @php
                                                                $data = \Carbon\Carbon::parse($winners->created_at);
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
        </div>
    </div>
</section>
