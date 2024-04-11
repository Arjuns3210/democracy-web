<section class="users-list-wrapper">
	<div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6 col-sm-7">
                                    <h5 class="pt-2">Edit Location : {{$location->name}}</h5>
                                </div>
                                <div class="col-6 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{URL::previous()}}" class="btn btn-sm btn-primary px-3 py-1"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="mb-0"> -->
                    	<div class="card-body">
                            <form autocomplete="off" id="updateLocationData" method="post" action="location/update">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Title<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="name" name="name" maxlength="52" value="{{$location['name']}}"><br/>
                                        <input type="hidden" name="id" value="{{$location->id}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Google Address<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="google_address" name="google_address" value="{{$location['google_address']}}"><br/>
                                    </div>
                                    <div class="col-sm-6" hidden>
                                        <label>Latitude<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="latitude" name="latitude" value="{{$location['latitude']}}"><br/>
                                    </div>
                                    <div class="col-sm-6" hidden>
                                        <label>Longitude<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="longitude" name="longitude" value="{{$location['longitude']}}"><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="map" style="height:400px; width: 400px;" class="my-3"></div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-success" onclick="submitForm('updateLocationData','post')">Submit</button>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSrdDORoPiSFHR_XPUDEc8BNsLrfVhBeQ&callback=initMap" type="text/javascript"></script>