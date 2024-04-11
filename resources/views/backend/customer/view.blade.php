<section class="users-list-wrapper">
    <div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <h5 class="pt-2">View App User</h5>
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
                                                    <td>{{$customer->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone</strong></td>
                                                    <td>{{$customer->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Gender</strong></td>
                                                    <td><span><span> {{ $customer->gender == 'M' ? 'Male' : ($customer->gender == 'F' ? 'Female' : 'Others') }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Date of Birth</strong></td>
                                                    <?php
                                                        if($customer->dob){
                                                            $date=\Carbon\Carbon::parse($customer->dob);
                                                        }
                                                    ?>
                                                    <td>{{$customer->dob ? $date->format('d-m-Y') : "-"}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Registered On</strong></td>
                                                    <?php
                                                        if($customer->created_at){
                                                            $date=\Carbon\Carbon::parse($customer->created_at);
                                                        }
                                                    ?>
                                                    <td>{{$customer->created_at ? $date->format('d-m-Y') : "-"}}</td>
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
