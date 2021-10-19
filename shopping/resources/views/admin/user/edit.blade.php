@extends('layouts.admin')

@section('title')
    <title>Add User</title>
@endsection
@section('css')

@endsection
<link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet">
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'User','key'=>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        {{--<div class="col-md12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>--}}
                        <form action="{{route('users.update',['id'=>$users->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên User</label>
                                <input type="text" class="form-control " name="name" placeholder="Nhập tên user" value="{{$users->name}}">

                            </div>
                            <div class="form-group">
                                <label>Tên Email</label>
                                <input type="text" class="form-control " name="email" placeholder="Nhập tên email" value="{{$users->email}}">

                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control " name="password" placeholder="Nhập password" value="{{$users->password}}">
                            </div>
                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select name="role_id[]" class="form-control select2_int" multiple>
                                    @foreach($roles as $role)
                                        <option
                                            {{$roleOfUser->contains('id',$role->id) ? 'selected':''}}
                                            value="{{$role->id}}" >{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
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
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('admins/user/add/add.js')}}"></script>
@endsection
