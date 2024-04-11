<section class="users-list-wrapper">
    <div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <h5 class="pt-2">View Question : {!! toolTipInfo($data->question,$data->question_code)!!}</h5>
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
                                                    <td><strong>Category Name</strong></td>
                                                    <td>{{$data->category->category_name}}</td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Question</strong></td>
                                                    <td>{{$data->question}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Options</strong></td>
                                                    <td>
                                                        <ol>
                                                        @foreach ($data->option as $option)
                                                            <li> {{$option->option}}</li>
                                                        @endforeach
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status</strong></td>
                                                    <td>{{displayStatus($data->status)}}</td>
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $('.select2').select2();
</script>
