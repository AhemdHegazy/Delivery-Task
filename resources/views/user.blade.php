@extends("layouts.app")
@section("content")
    <br>
    <br>
    <div class="main main-raised mt-5">
        <div class="container">
            <div class="section ">
                <div class="row">
                    <div class="col-lg-1">
                        <i class="material-icons text-primary" style="font-size: 100px">person</i>
                    </div>
                    <div class="col-md-5 ml-auto mr-auto">
                        <h2 class="title mt-0">{{$user->name}}</h2>
                        <h6>{{$user->email}}</h6>
                        <h6>{{$user->phone}}</h6>
                    </div>

                    <div class="col-md-6 ml-auto mr-auto">
                        <h6 class="m-0 p-0">{{$user->address}}</h6>
                        <h3 class="title p-0 mt-0">{{$user->tracking_code}}</h3>
                        <h6 class="m-0 p-0">{!! $user->status_tags !!}</h6>

                    </div>
                    <div class="col-lg-12">
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
                    </div>
                </div>
                <div class="features">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4>Traking Information</h4>
                                            {!! $user->status_tag !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <h4>Update Status</h4>
                                        {!! QrCode::size(450)->generate("https://www.google.com/maps/dir/".urlencode($user->address)."/@".$user->lat.",".$user->lng.",17.25z"); !!}
                                    </div>
                                    <form class="col-lg-12" method="POST" action="{{route("admin.users.update")}}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        @if(auth()->user()->role == "admin")
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" {{$user->status == "new" ? "checked" : ""}} type="radio" name="status" id="new" value="new" >
                                                New
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>

                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" {{$user->status == "approved" ? "checked" : ""}} type="radio" name="status" id="approved" value="approved" >
                                                Approved
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        @endif
                                        @if(auth()->user()->role == "admin" || auth()->user()->role == "delivery")
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" {{$user->status == "shipped" ? "checked" : ""}} type="radio" name="status" id="shipped" value="shipped" >
                                                Shipped
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>

                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" {{$user->status == "outForDelivery" ? "checked" : ""}} type="radio" name="status" id="outForDelivery" value="outForDelivery" >
                                                Out For Delivery
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" {{$user->status == "delivered" ? "checked" : ""}} type="radio" name="status" id="delivered" value="delivered" >
                                               Delivered
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        @endif
                                        @if(auth()->user()->role == "admin")
                                        <hr>
                                        <div>
                                            <label for="delivery_id" class="form-check-label">
                                                Delivery
                                            </label>
                                                <select name="delivery_id" id="delivery_id" class="form-control">
                                                @foreach(\App\Models\User::where("role","delivery")->get() as $delivery)
                                                    <option value="{{$delivery->id}}" {{$user->delivery_id == $delivery->id ? "selected" : ""}}>{{$delivery->name}}</option>
                                                @endforeach
                                        </select>
                                        </div>
                                        @endif
                                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
@section("scripts")
    <script src="http://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection
