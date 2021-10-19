@extends('layouts.admin')

@section('title')
    <title>Trang Chu</title>
@endsection
@section('css')

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'Role','key'=>'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

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
                        <form action="{{route('roles.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên Slider</label>
                                <input type="text" class="form-control " name="name" placeholder="Nhập tên slider" value="">

                            </div>
                            <div class="form-group">
                                <label>Mô tả Slider</label>
                                <textarea name="display_name" class="form-control " placeholder="" rows="5" >
                                </textarea>

                            </div>

                            <div class="col-md-12">
                                <div class="  bg-success ">
                                    <label>
                                        <input type="checkbox" class="checkbox_all"
                                               value="">
                                    </label>
                                    CheckAll
                                </div>
                                <div class="row">

                                    @foreach($permissionParents as $permissionParent)
                                        <div class="card bg-light mb-3 col-md-12">

                                            <div class="card-header bg-danger">
                                                <label>
                                                    <input type="checkbox" class="checkbox_parent"
                                                           value="{{$permissionParent->id}}">
                                                </label>
                                                Module {{$permissionParent->name}}
                                            </div>
                                            <div class="row">
                                                @foreach($permissionParent->permissionChildren as $permission)
                                                    <div class="card-body text-primary col-md-3">
                                                        <h5 class="card-title">
                                                            <label>
                                                                <input type="checkbox" class="checkbox_children"
                                                                       name="permission_id[]"
                                                                       value="{{$permission->id}}">
                                                            </label>
                                                            {{$permission->name}}
                                                        </h5>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="{{asset('admins/role/add.js')}}"></script>
@endsection
