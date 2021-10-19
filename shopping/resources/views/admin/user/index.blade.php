@extends('layouts.admin')

@section('title')
    <title>User</title>
@endsection
@section('css')

@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'User','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('user-add')
                        <a href="{{route('users.create')}}" class="btn btn-success float-right m-2">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $userItem)
                                <tr>
                                    <th scope="row">{{$userItem->id}}</th>
                                    <td>{{$userItem->name}}</td>
                                    <td>{{$userItem->email}}</td>
                                    <td>
                                        @can('user-edit')
                                        <a href="{{route('users.edit',['id'=>$userItem->id])}}" class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('user-delete')
                                        <a href="" data-url="{{route('users.delete',['id'=>$userItem->id])}}" class="btn btn-danger action_delete">Delete</a>
                                            @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$users->links()}}
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/user/index/delete.js')}}"></script>

@endsection
