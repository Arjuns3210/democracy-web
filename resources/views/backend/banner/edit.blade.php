<section class="users-list-wrapper">
	<div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6 col-sm-7">
                                    <h5 class="pt-2">Edit Banner </h5>
                                </div>
                                <div class="col-6 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{URL::previous()}}" class="btn btn-sm btn-primary px-3 py-1"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="mb-0"> -->
                    	<div class="card-body">
                            <form autocomplete="off" id="updateContestData" method="post" action="banner/update">
                                @csrf
                                <input type="hidden" name="id" value="{{$data['id']}}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Name<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="name" maxlength="52"  name="name" value="{{$data['name']}}"><br/>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-6 col-lg-12 col-sm-6 text-center file-input-div">

                                            <label>Image<span class="text-danger">*</span></label>
                                            <p style="color:blue;">Note : Upload file size {{config('global.dimensions.banner_width')}}X{{config('global.dimensions.banner_height')}} pixel and .jpg, .png, or jpeg format image</p>
                                            <div class="shadow bg-white rounded d-inline-block mb-2">
                                                <div class="input-file">
                                                    <label class="label-input-file">Choose Files &nbsp;&nbsp;&nbsp;<i class="ft-upload font-medium-1"></i>
                                                        <input type="file" name="image" class="cover-images" id="image" accept=".jpg, .jpeg, .png" onchange="handleFileInputChange('image', 'image')">
                                                    </label>
                                                </div>
                                            </div>
                                            <p id="files-area">
                                                <span id="imagesLists">
                                                    <span id="images-names"></span>
                                                </span>
                                            </p>
                                        </div>
                                        @if(!empty($media))
                                        <div class="d-flex mb-1  media-div-{{$media->id}}">
                                            <input type="text"
                                                    class="form-control input-sm bg-white document-border"
                                                    value="{{ $media->file_name }}"
                                                    readonly style="color: black !important;">
                                                    <a href="{{ $media->getFullUrl() }}"
                                                    class="btn btn-primary mx-2 px-2" target="_blank"><i
                                                    class="fa ft-eye"></i></a>
                                        </div><br>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-success" onclick="submitForm('updateContestData','post')">Submit</button>
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
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $('.select2').select2();
    handleImagesAttachmentChange();
    hidePastDate();
</script>

