<section class="users-list-wrapper">
	<div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6 col-sm-7">
                                    <h5 class="pt-2">Add Staff User</h5>
                                </div>
                                <div class="col-6 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{URL::previous()}}" class="btn btn-sm btn-primary px-3 py-1"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="mb-0"> -->
                    	<div class="card-body">
                    		<form id="saveStaffData" method="post" action="staff/save">
                    			@csrf
								<div class="row">
                        			<div class="col-sm-6">
                        				<label>Role<span class="text-danger">*</span></label>
                        				<select class="select2 required" id="role_id" name="role_id" style="width: 100% !important;">
                                            <option value="">Select</option>
                                            @foreach($data['role'] as $roles)
                                                <option value="{{$roles->id}}">{{$roles->role_name}}</option>
                                            @endforeach
                                        </select><br/>
                        			</div>
									<div class="col-sm-6 mt-2 is_head" style="display:none">
										<div class="form-group">
											<label for="lifeline">Is head ?</label>
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="is_head" name="is_head">
												<label class="custom-control-label" for="is_head"></label>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
                        				<label>Name<span class="text-danger">*</span></label>
                        				<input class="form-control required" type="text" oninput="validateNameInput(this)" id="admin_name" maxlength="52" name="admin_name"><br/>
                        			</div>
                                    <div class="col-sm-6">
                                        <label>Nick Name<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="nick_name" oninput="validateNameInput(this)" maxlength="3"name="nick_name"><br/>
                                    </div>
                        			<div class="col-sm-6">
                        				<label>Email Id<span class="text-danger">*</span></label>
                        				<input class="form-control required" type="email" id="email" name="email"><br/>
                        			</div>
                                    <div class="col-sm-6">
                                        <label>Phone<span class="text-danger">*</span></label>
                                        <input class="form-control required numeric-input" type="text" id="phone" name="phone" maxlength="10"><br/>
                                    </div>
                        			<div class="col-sm-6">
                        				<label>Password<span class="text-danger">*</span></label>
                        				<input class="form-control required" type="password" id="password" name="password" maxlength="28"><br/>
                        			</div>
                        			<div class="col-sm-6">
                        				<label>Address<span class="text-danger">*</span></label>
                        				<textarea class="form-control required" id="address" name="address"></textarea><br/>
                        			</div>
                        		</div>
                        		<hr>
                        		<div class="row">
                        			<div class="col-sm-12">
                        				<div class="pull-right">
                        					<button type="button" class="btn btn-success" onclick="submitForm('saveStaffData','post')">Submit</button>
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
</script>
