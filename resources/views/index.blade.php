@extends("layouts.app")
@section("content")
    <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('{{asset("assets/img/bg2.jpg")}}');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <div class="brand">
                        <h1>DELIVERY SYSTEM</h1>
                        <h3>Welcome In Delivery System</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="title">Let's talk product</h2>
                        <h5 class="description">This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn't scroll to get here. Add a button if you want the user to see more.</h5>
                    </div>
                </div>
                <div class="features">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-info">
                                    <i class="material-icons">shopping_cart</i>
                                </div>
                                <h4 class="info-title">Delivery</h4>
                                <p>: After a user drops off a package, the staff has to make sure to enter it in the system and put it on its way.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="material-icons">verified_user</i>
                                </div>
                                <h4 class="info-title">Delivery Person </h4>
                                <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-danger">
                                    <i class="material-icons">code</i>
                                </div>
                                <h4 class="info-title">Barcode</h4>
                                <p>Post Master or the staff at the office receives the package and generates a unique barcode that contains information about the address its has to be sent</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
