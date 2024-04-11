<section class="users-list-wrapper">
	<div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6 col-sm-7">
                                    <h5 class="pt-2">Add Question</h5>
                                </div>
                                <div class="col-6 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{URL::previous()}}" class="btn btn-sm btn-primary px-3 py-1"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="mb-0"> -->
                    	<div class="card-body">
                            <form autocomplete="off" id="saveQuestionData" method="post" action="question/save">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Question<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="question" name="question"><br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Category<span class="text-danger">*</span></label>
                                        <select class="required select2" id="category" name="category" style="width: 100% !important;">
                                            <option value="">Select</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category_name ?? ''}}</option>
                                            @endforeach
                                        </select><br/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-4 col-10">
                                        <label>Possible Options  {!!toolTipInfo("Click + to add more option")!!}<span class="text-danger">*</span></label>
                                        <input class="form-control required option form-control-sm" type="text" name="option[]"><br/>
                                    </div>
                                    <div class="col-md-1 col-sm-2 col-2">
                                        <label>&nbsp;</label><br/>
                                        <a href="javascript:void(0)" class="btn btn-info btn-sm add_option"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="options-container">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-success" onclick="submitForm('saveQuestionData','post')">Submit</button>
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
</script>
