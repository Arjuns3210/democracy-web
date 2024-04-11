<section class="users-list-wrapper">
    <div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <h5 class="pt-2">Contest View : {!! toolTipInfo($data->name,$data->contest_code)!!}</h5>
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
                                                    <td><strong>Name</strong></td>
                                                    <td>{{$data->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Sub Title</strong></td>
                                                    <td>{{$data->sub_title}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contest Details</strong></td>
                                                    <td>{!! nl2br($data->contest_details) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>On Tv</strong></td>
                                                    <td>{{$data->on_tv}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Winning Award</strong></td>
                                                    <td>{!! nl2br($data->winning_award) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Rules</strong></td>
                                                    <td>{!! nl2br($data->rules) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contest Date</strong></td>
                                                    <?php
                                                        $date=\Carbon\Carbon::parse($data->contest_date);
                                                        $startDate=\Carbon\Carbon::parse($data->registration_start_date);
                                                        $endDate=\Carbon\Carbon::parse($data->registration_allowed_until);
                                                        $start_time = \Carbon\Carbon::createFromFormat('H:i:s', $data->start_time);
                                                        $end_time = \Carbon\Carbon::createFromFormat('H:i:s', $data->end_time);
                                                    ?>
                                                    <td>{{$date->format('d-m-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contest Timing</strong></td>
                                                    <td>{{$start_time->format('g:i A')}} - {{$end_time->format('g:i A')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Registration Start Date</strong></td>
                                                    <td>{{$startDate->format('d-m-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status</strong></td>
                                                    <td>{{displayStatus($data->status)}}</td>
                                                </tr>
                                            </table>
                                            @if (!empty($contestResultData))
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Question</th>
                                                        <th>Most Selected Answer</th>
                                                    </tr>
                                                        @foreach ($contestResultData as $key => $value )
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$value['question']?? ''}}</td>
                                                                <td>{{$value['option']?? ''}}</td>
                                                            </tr>
                                                        @endforeach
                                                </table>
                                            @endif
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $('.select2').select2();
</script>
