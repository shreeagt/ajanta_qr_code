@extends('layouts.app-master')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .form-label {
        font-size: 14px;
    }

    canvas {
        max-width: 600px;
        margin: 20px;
    }

    .panel-primary>.panel-heading {
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
    }

    .panel-footer {
        padding: 10px 15px;
        background-color: #f5f5f5;
        border-top: 1px solid #ddd;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px
    }

    h1.page-header {
        padding-bottom: 9px;
        margin: 40px 0 20px;
        border-bottom: 1px solid #eee;
    }

    .panel {
        font-size: 14px;
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .text-right {
        text-align: right;
    }


    .huge {
        font-size: 40px;
    }

    .panel-green {
        border-color: #5cb85c;
    }

    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .panel-green .panel-heading {
        border-color: #5cb85c;
        color: #fff;
        background-color: #5cb85c;
    }

    .panel-green a {
        color: #5cb85c;
    }

    .panel-green a:hover {
        color: #3d8b3d;
    }

    .panel-red {
        border-color: #d9534f;
    }

    .panel-red .panel-heading {
        border-color: #d9534f;
        color: #fff;
        background-color: #d9534f;
    }

    .panel-red a {
        color: #d9534f;
    }

    .panel-red a:hover {
        color: #b52b27;
    }

    .panel-yellow {
        border-color: #f0ad4e;
    }

    .panel-orange .panel-heading {
        border-color: #f95f08;
        color: #fff;
        background-color: #f95f08;
    }

    .panel-orange {
        border-color: #f95f08;
    }

    .panel-orange a {
        color: #f95f08;
    }

    .panel-yellow .panel-heading {
        border-color: #f0ad4e;
        color: #fff;
        background-color: #f0ad4e;
    }

    .panel-yellow a {
        color: #f0ad4e;
    }

    .panel-yellow a:hover {
        color: #df8a13;
    }
</style>
{{-- <div class="bg-light p-5 rounded"> --}}
<div class="bg-light  rounded">
    @auth
    {{-- <h1><span class="d-inline-block auth-title">{{auth()->user()->name}}</span></h1> --}}

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{auth()->user()->name}} Dashboard</h1>
        </div>
        <!-- /.col-lg-12-->
    </div>
    <!-- /.row-->

    <div class="row my-3 align-items-center">

        <div class="col-md-5">
            <label for="fromtime" class="form-label">From </label>
            <input type="time" class="form-control" id="fromtime">
        </div>
        <div class="col-md-5">
            <label for="fromtime" class="form-label">To </label>
            <input type="time" class="form-control" id="endtime">
        </div>
        <div class="col-md-2">
            <label for="fromtime" class="form-label"> </label>
            <button class="btn btn-primary">Filter</button>
        </div>

    </div>
    @if(Auth::user()->hasRole('admin'))
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-orange">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-envelope fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">6</div>
                            <div>Total Request</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-tasks fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">12</div>
                            <div>Approved</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-print fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">18</div>
                            <div>Printer History</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-ban fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">24</div>
                            <div>Rejected Order</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @elseif(Auth::user()->hasRole('so') )
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-orange">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-envelope fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">7</div>
                            <div>Total Request</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-tasks fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">14</div>
                            <div>Approved</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-print fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">21</div>
                            <div>Printer History</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-ban fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">28</div>
                            <div>Rejected Order</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @elseif(Auth::user()->hasRole('rsm') )
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-orange">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-envelope fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">8</div>
                            <div>Total Request</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-tasks fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">16</div>
                            <div>Approved</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-print fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">24</div>
                            <div>Printer History</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-ban fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">32</div>
                            <div>Rejected Order</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @elseif(Auth::user()->hasRole('team_lead') )
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-orange">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-envelope fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">9</div>
                            <div>Total Request</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-tasks fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">18</div>
                            <div>Approved</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-print fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">27</div>
                            <div>Printer History</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-ban fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">36</div>
                            <div>Rejected Order</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @elseif(Auth::user()->harRole('rsm'))
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-orange">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-envelope fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">10</div>
                            <div>Total Request</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-tasks fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">20</div>
                            <div>Approved</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-print fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">30</div>
                            <div>Printer History</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-ban fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">40</div>
                            <div>Rejected Order</div>
                        </div>
                    </div>
                </div><a href="#">
                    <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @endif

    <div class="row align-items-center">
        <div class="col-lg-8">
            <canvas id="orderChart"></canvas>
        </div>
        <div class="col-lg-4">


            <div class="panel panel-orange">
                <div class="panel-heading">
                    <div class="row d-flex align-items-center ">
                        <div class="col-3"><i class="fa fa-envelope fa-4x"></i></div>
                        <div class="col-9 text-right">
                            <div class="huge">50</div>
                            <div>Qr Code Batch Request</div>
                        </div>
                    </div>
                </div>
                {{-- <a href="#">
                        <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                        </div></a> --}}
            </div>


        </div>
    </div>
    {{-- <img src="https://images.klipfolio.com/website/public/22b133bc-124d-44f4-85f8-9170b08d3ce9/dashboard-examples-hero.png" /> --}}
    @endauth

    @guest
    {{-- <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p> --}}


    <!-- <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p> -->
    <div class="">
        <div class=" landing-dark-bg">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Heading-->
                <div class="text-center py-10 py-lg-20">
                    <!--begin::Title-->
                    <h1 class="text-white  lh-base fw-bold fs-2x fs-lg-3x mb-15">The Scanner
                        <br />
                        <!--end::Title-->
                        <!--begin::Action-->
                        <a href="/scanner" class="btn btn-primary">Scan</a>
                        <!--end::Action-->
                </div>
                <!--end::Heading-->

                <!--end::Author-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Wrapper-->

    </div>
    @endguest


</div>




<script>
    // Sample data
    var data = {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
                label: 'Total Orders',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: [50, 65, 80, 45, 60],
            },
            {
                label: 'Accepted Orders',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: [40, 55, 70, 35, 50],
            },
            {
                label: 'Rejected Orders',
                backgroundColor: 'rgba(255, 255, 0, 0.2)',
                borderColor: 'rgba(255, 255, 0, 1)',
                borderWidth: 1,
                data: [10, 10, 10, 10, 10],
            },
        ],
    };

    // Chart configuration
    var config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                },
            },
        },
    };

    // Create the chart
    var ctx = document.getElementById('orderChart').getContext('2d');
    var myChart = new Chart(ctx, config);
</script>
@endsection