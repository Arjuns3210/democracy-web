<section class="users-list-wrapper">
	<div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6 col-sm-7">
                                    <h5 class="pt-2">Add Contest</h5>
                                </div>
                                <div class="col-6 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{URL::previous()}}" class="btn btn-sm btn-primary px-3 py-1"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="mb-0"> -->
                    	<div class="card-body">
                            <form autocomplete="off" id="saveContestData" method="post" action="contest/save">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Name<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" maxlength="52"  id="name" name="name"><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Sub Title<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" maxlength="200"  id="sub_title" name="sub_title"><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Contest Date<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="contest_date" name="contest_date"><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Registration Start Date<span class="text-danger">*</span></label>
                                        <input class="form-control required flatpickr" type="text" id="registration_start_date" name="registration_start_date"><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Start Time<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="time" id="start_time" name="start_time"><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>End Time<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="time" id="end_time" name="end_time"><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Contest Details<span class="text-danger">*</span></label>
                                        <textarea rows="4" class="form-control required" id="contest_details" name="contest_details"></textarea><br/>
                                    </div>
                                    <div class="col-sm-6 mt-2 mb-2">
                                        <div class="form-group">
                                            <label for="lifeline">Will be on TV ?</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="on_tv" name="on_tv">
                                                <label class="custom-control-label" for="on_tv"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Winning Award<span class="text-danger">*</span></label>
                                        <textarea rows="4" class="form-control required" id="winning_award" name="winning_award"></textarea><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Rules<span class="text-danger">*</span></label>
                                        <textarea rows="4" class="form-control required" id="rules" name="rules"></textarea><br/>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-success" onclick="submitForm('saveContestData','post')">Submit</button>
                                            <a href="{{URL::previous()}}" class="btn btn-danger px-3 py-1">Cancel</a>
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
<script>
    $('.select2').select2();
    hidePastDate();
</script>
