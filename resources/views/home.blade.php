@extends('layouts.app')

@section('content')
<div class="container pt-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            <div class="container">
                                <div class="alert-icon">
                                    <i class="material-icons">check</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <b>Success</b>
                                Delivery Submitted Successfully
                            </div>
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="material-icons">check</i>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                    </button>
                                    <b>Success</b>
                                    {{session('success')}}
                                </div>
                            </div>
                        @endif

                    <h6><b>Welcome {{auth()->user()->name}}</b></h6>
                    {{ __('You are logged in!') }}
                        <hr>
                    @if(auth()->user()->role == "user")
                    <p>Are you ready to submit your delivery

                    </p>
                        @if(auth()->user()->tracking_code == null)
                        <ul>
                            <li>Please click the button below and wait delivery process</li>
                            <li>You can check for delivery status</li>
                        </ul>

                        <a href="{{route("user.submit")}}" class="btn btn-primary btn-round text-white"><span class="material-icons">
                            done_all
                            </span> Submit Delivery
                            <div class="ripple-container"></div></a>
                        @else
                            <h4><b>Tracking Code</b></h4>
                            <h3><b>{{auth()->user()->tracking_code}}</b></h3>
                            <hr>
                            <h4><b>Tracking Status</b></h4>
                            <h3><b>{!! auth()->user()->status_tag !!}</b></h3>
                        @endif
                        @elseif(auth()->user()->role == "admin")
                        <div class="row mt-5">
                            <div class="col-lg-3">

                                 <div class="card ">
                                     <div class=" card-header card-header-primary">
                                         <h5 class="text-center p-0 m-0"><b>Users</b></h5>
                                     </div>
                                     <div class="card-body text-center bg-gray">
                                         <h1><b>{{\App\Models\User::where("role","user")->count()}}</b></h1>
                                     </div>
                                 </div>

                            </div>

                            <div class="col-lg-3">

                                <div class="card ">
                                    <div class=" card-header card-header-primary">
                                        <h5 class="text-center p-0 m-0"><b>New Deliveries</b></h5>
                                    </div>
                                    <div class="card-body text-center bg-gray">
                                        <h1><b>{{\App\Models\User::where("status","new")->count()}}</b></h1>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3">

                                <div class="card ">
                                    <div class=" card-header card-header-primary">
                                        <h5 class="text-center p-0 m-0"><b>Approved Deliveries</b></h5>
                                    </div>
                                    <div class="card-body text-center bg-gray">
                                        <h1><b>{{\App\Models\User::where("status","approved")->count()}}</b></h1>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3">

                                <div class="card ">
                                    <div class=" card-header card-header-primary">
                                        <h5 class="text-center p-0 m-0"><b>Shipped Deliveries</b></h5>
                                    </div>
                                    <div class="card-body text-center bg-gray">
                                        <h1><b>{{\App\Models\User::where("status","shipped")->count()}}</b></h1>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3">

                                <div class="card ">
                                    <div class=" card-header card-header-primary">
                                        <h5 class="text-center p-0 m-0"><b>Out For Deliveries</b></h5>
                                    </div>
                                    <div class="card-body text-center bg-gray">
                                        <h1><b>{{\App\Models\User::where("status","outForDelivery")->count()}}</b></h1>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3">

                                <div class="card ">
                                    <div class=" card-header card-header-primary">
                                        <h5 class="text-center p-0 m-0"><b>Deliveried</b></h5>
                                    </div>
                                    <div class="card-body text-center bg-gray">
                                        <h1><b>{{\App\Models\User::where("status","delivered")->count()}}</b></h1>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @else
                            <div class="row mt-5">
                                <div class="col-lg-3">
                                    <div class="card ">
                                        <div class=" card-header card-header-primary">
                                            <h5 class="text-center p-0 m-0"><b>Out For Deliveries</b></h5>
                                        </div>
                                        <div class="card-body text-center bg-gray">
                                            <h1><b>{{\App\Models\User::where("status","outForDelivery")->count()}}</b></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                    <div class="card ">
                                        <div class=" card-header card-header-primary">
                                            <h5 class="text-center p-0 m-0"><b>Delivered</b></h5>
                                        </div>
                                        <div class="card-body text-center bg-gray">
                                            <h1><b>{{\App\Models\User::where("status","delivered")->count()}}</b></h1>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
