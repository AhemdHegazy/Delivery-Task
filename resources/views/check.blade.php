@extends('layouts.app')

@section('content')
    <div class="container  mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">{{ __('Check Delivery') }}</div>


                    <div class="card-body">
                        <form method="GET" action="{{ route('check') }}">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <div class="container">
                                        <div class="alert-icon">
                                            <i class="material-icons">error_outline</i>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                        </button>
                                        <b>Error</b>
                                        {{session('error')}}
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
                            <div class="form-group bmd-form-group">
                                <label for="code"  class="bmd-label-floating">{{ __('Tracking Code') }}</label>
                                <input id="code"  type="text" class="form-control @error('email') is-invalid @enderror" name="code" value="{{ old('email') }}" required autocomplete="code" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="row mb-0">
                                <div class="col-md-12 text-center ">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Check') }}
                                    </button>

                                </div>
                            </div>

                            <hr>
                            @if(isset($user))

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4>User Information</h4>
                                                <ul>
                                                    <li><b>Name : </b>{{$user->name}}</li>
                                                    <li><b>Email : </b>{{$user->email}}</li>
                                                    <li><b>Phone : </b>{{$user->phone}}</li>
                                                    <li><b>Address : </b>{{$user->address}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 pt-3">
                                                <i class="material-icons text-primary" style="font-size: 100px">person</i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Delivery Information</h4>
                                        <ul>
                                            <li><b>Code : </b>{{$user->tracking_code}}</li>
                                        </ul>
                                        <h6><b>Status</b> <br> <span class="text-danger">{!! $user->status !!}</span></h6>
                                        {!! $user->status_tag !!}
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
