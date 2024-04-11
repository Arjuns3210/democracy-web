<section class="users-list-wrapper">
	<div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6 col-sm-7">
                                    <h5 class="pt-2">Edit Question : {!! toolTipInfo($question->question,$question->question_code)!!}</h5>
                                </div>
                                <div class="col-6 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{URL::previous()}}" class="btn btn-sm btn-primary px-3 py-1"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="mb-0"> -->
                    	<div class="card-body">
                            <form autocomplete="off" id="updateQuestionData" method="post" action="question/update">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Question<span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" id="question" name="question" value="{{ $question->question}}"><br/>
                                        <input type="hidden" name="id" value="{{$question->id}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Category<span class="text-danger">*</span></label>
                                        <select class="required select2" id="category" name="category" style="width: 100% !important;">
                                            <option value="">Select</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$question['category_id']== $category['id']?"selected":""}}>{{$category->category_name ?? ''}}</option>
                                            @endforeach
                                        </select><br/>
                                    </div>
                                </div>
                                <div class="options-container">
                                    @php
                                        $hidden = count($question->option) == 7 ?'hidden' : '';
                                    @endphp
                                    @foreach ($question->option as $key =>$option)
                                    @if ($key == 0)
                                        <div class="row">
                                            <div class="col-md-5 col-sm-4 col-10">
                                                <input type="hidden" name="opID[]" value="{{$option->id}}">
                                                <label>Possible Options  {!!toolTipInfo("Click + to add more option")!!}<span class="text-danger">*</span></label>
                                                <input class="form-control form-control-sm required option" type="text" name="option[]" value="{{$option->option }}"><br/>
                                            </div>
                                            <div class="col-md-1 col-sm-2 col-2" {{$hidden}}>
                                                <label>&nbsp;</label><br/>
                                                <a href="javascript:void(0)" class="btn btn-info btn-sm add_option"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row option-row">
                                            <input type="hidden" name="opID[]" value="{{$option->id}}">
                                            <div class="col-md-5 col-sm-4 col-10">
                                                <input class="form-control form-control-sm required" type="text" name="option[]" value="{{$option->option }}"><br/>
                                            </div>
                                            <div class="col-md-1 col-sm-2 col-2">
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm delete_option" onclick="remove_option(${i})">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-success" onclick="submitForm('updateQuestionData','post')">Submit</button>
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
