<section class="users-list-wrapper">
	<div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6 col-sm-7">
                                    <h5 class="pt-2">Edit Staff:  {{$data['data']->admin_name}}</h5>
                                </div>
                                <div class="col-6 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{URL::previous()}}" class="btn btn-sm btn-primary px-3 py-1"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="mb-0"> -->
                    	<div class="card-body">
                    		<form id="updateStaffData" method="post" action="staff/update">
                    			@csrf
                                <div class="row">
                        			<div class="col-sm-6 mb-3">
                        				<label>Role<span class="text-danger">*</span></label>
                        				<select class="select2 required" id="role_id" name="role_id" style="width: 100% !important;" disabled>
                                            <option value="">Select</option>
                                            @foreach($data['roles'] as $roles)
                                                @if($roles->id == $data['data']->role_id)
                                                    <option value="{{$roles->id}}" selected>{{$roles->role_name}}</option>
                                                @else
                                                    <option value="{{$roles->id}}">{{$roles->role_name}}</option>
                                                @endif
                                            @endforeach
                                        </select><br/>
                        			</div>
                                    @php
                                        $none = $data['data']->role_id != 1 ? 'display:none' : '';
                                    @endphp
                                    <div class="col-sm-6 mt-2 is_head" style="{{$none}}">
                                        <div class="form-group">
                                            <label for="lifeline">Is Head ?</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="is_head" name="is_head" {{$data['data']->is_head == "1"?"checked":""}}>
                                                <label class="custom-control-label" for="is_head"></label>
                                            </div>
                                        </div>
                                    </div>
								</div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Admin Name<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text"oninput="validateNameInput(this)" id="admin_name" maxlength="52" name="admin_name" value="{{$data['data']->admin_name}}"><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Nick Name<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="nick_name" name="nick_name" oninput="validateNameInput(this)" maxlength="3" value="{{$data['data']->nick_name}}"><br/>
                                    </div>
                                    <dl class="col-sm-6">
                                        <label>Email Id</label>
                                        <dd class="form-control" readonly>{{ $data['data']->email }}</dd>
                                    </dl>
                                    <div class="col-sm-6">
                                        <label>Phone<span class="text-danger">*</span></label>
                                        <input class="form-control required numeric-input" type="text" id="phone" name="phone" maxlength="10" value="{{$data['data']->phone}}"><br/>
                                    </div>
                        			<div class="col-sm-6">
                        				<label>Address<span class="text-danger">*</span></label>
                        				<textarea class="form-control required" id="address" name="address">{{$data['data']->address}}</textarea><br/>
                                        <input type="hidden" name="id" value="{{$data['data']->id}}">
                        			</div>
                        		</div>
                        		<hr>
                        		<div class="row">
                        			<div class="col-sm-12">
                        				<div class="pull-right">
                        					<button type="button" class="btn btn-success" onclick="submitForm('updateStaffData','post')">Update</button>
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
