<section class="users-list-wrapper">
    <div class="users-list-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <h5 class="pt-2">View Suggested Question</h5>
                                </div>
                                <div class="col-12 col-sm-5 d-flex justify-content-end align-items-center">
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary px-3 py-1"><i
                                            class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#contest">Suggested
                                                Question</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <tr>
                                                            <td><strong>Question</strong></td>
                                                            <td>{{ $data->question }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Options</strong></td>
                                                            <td>
                                                                <ol>
                                                                    @foreach ($data->suggestedQuestionOptions as $option)
                                                                        <li> {{ $option->option }}</li>
                                                                    @endforeach
                                                                </ol>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Submitted By</strong></td>
                                                            <td>{{ $data->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Submitted On</strong></td>
                                                            <td>{{ $data->created_at->format('d-m-Y')}}</td>
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
    </div>
</section>
