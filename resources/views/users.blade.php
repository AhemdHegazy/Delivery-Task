@extends("layouts.app")
@section("content")
    <br>
    <br>
    <div class="main main-raised mt-5">
        <div class="container">
            <div class="section text-center ">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="title">Users</h2>
                    </div>
                </div>
                <div class="features">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th style="width: 29%">Code</th>
                                    <th>
                                      Show
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)

                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->address}}</td>
                                        <td><b>{{$user->tracking_code ?? "-"}}</b></td>
                                        <td>
                                            <a href="{{route("admin.users.show",$user->id)}}" class="btn btn-primary btn-fab btn-fab-mini btn-round text-white">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


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
