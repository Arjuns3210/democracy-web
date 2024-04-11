@extends('backend.layouts.app')
@section('content')
<div class="wrapper">
    <div class="main-panel">
        <div class="main-content">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <section id="minimal-statistics">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="content-header">
                                <b>Welcome to Democracy Staff Panel</b>
                            </h1>
                            <hr style="border: none; border-bottom: 1px solid black;">
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content" style="height:150px;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body text-left">
                                                <h3 class="mb-1 danger">{{ $users_total }}</h3>
                                                <span>Total Users</span><br><br><br>
                                            </div>
                                            <div class="media-right align-self-center">
                                                <i class="ft-users danger font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content" style="height:150px;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body text-left">
                                                <h3 class="mb-1 danger">{{ $question }}</h3>
                                                <span>Total Questions</span><br><br><br>
                                            </div>
                                            <div class="media-right align-self-center">
                                                <i class="fa fa-question danger font-large-2 float-right" ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content" style="height:150px;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body text-left">
                                                <h3 class="mb-1 danger">{{ $contest }}</h3>
                                                <span>Total Contests</span><br><br><br>
                                            </div>
                                            <div class="media-right align-self-center">
                                                <i class="fa fa-trophy danger font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content" style="height:150px;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body text-left">
                                                <h3 class="mb-1 danger">{{ $category }}</h3>
                                                <span>Total Category</span><br><br><br>
                                            </div>
                                            <div class="media-right align-self-center">
                                                <i class="fa fa-th-large danger font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label style="font-size:20px;border-bottom:1px solid #0c5aec;margin-bottom:7px;margin-top: 25px">Today's Added</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content" style="height:150px;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body text-left">
                                                <h3 class="mb-1 warning">{{ $users_total_todays }}</h3>
                                                <span>User</span><br><br><br>
                                            </div>
                                            <div class="media-right align-self-center">
                                                <i class="ft-users warning font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content" style="height:150px;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body text-left">
                                                <h3 class="mb-1 warning">{{ $question_todays }}</h3>
                                                <span>Questions</span><br><br><br>
                                            </div>
                                            <div class="media-right align-self-center">
                                                <i class="fa fa-question warning font-large-2 float-right" ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content" style="height:150px;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body text-left">
                                                <h3 class="mb-1 warning">{{ $contest_todays }}</h3>
                                                <span>Contests</span><br><br><br>
                                            </div>
                                            <div class="media-right align-self-center">
                                                <i class="fa fa-trophy warning font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content" style="height:150px;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body text-left">
                                                <h3 class="mb-1 warning">{{ $category_todays }}</h3>
                                                <span>Category</span><br><br><br>
                                            </div>
                                            <div class="media-right align-self-center">
                                                <i class="fa fa-th-large warning font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
