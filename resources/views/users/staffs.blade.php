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
                    <a href="{{route("admin.staffs.create")}}" class="btn btn-primary btn-round text-white mb-5">
                        <i class="material-icons">note_add</i>
                        Create Staff
                    </a>
                    <div class="row">

                        <div class="col-lg-12">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>
                                      Edit / Delete
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)

                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td><span class="badge badge-{{$user->role =="admin" ? "success" : "danger"}}">
                                                {{ucfirst($user->role)}}
                                            </span></td>
                                        <td>
                                            <a href="{{route("admin.staffs.edit",$user->id)}}" class="btn btn-primary btn-fab btn-fab-mini btn-round text-white">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a href="{{route("admin.staffs.delete",$user->id)}}" class="btn btn-primary btn-fab btn-fab-mini btn-round text-white">
                                                <i class="material-icons">delete_sweep</i>
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
