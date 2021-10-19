@extends('layouts.admin')

@section('title')
    <title>Setting</title>
@endsection
@section('css')
    <link href="{{asset('admins/setting/add/add.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'Setting','key'=>'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('settings.update',['id'=>$setting->id]).'?type='.$setting->type}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>ConfigKey</label>
                                <input type="text" class="form-control " name="config_key" placeholder="Nhập config_key" value="{{$setting->config_key}}">

                            </div>
                            @if(request()->type==='Text')
                                <div class="form-group">
                                    <label>ConfigValue</label>
                                    <input type="text" class="form-control "  name="config_value" placeholder="Nhập config_value" value="{{$setting->config_value}}">

                                </div>
                            @elseif(request()->type==='Textarea')
                                <div class="form-group">
                                    <label>ConfigValue</label>
                                    <textarea type="text" class="form-control " name="config_value" placeholder="Nhập config_value" rows="5">{{$setting->config_value}}</textarea>

                                </div>
                            @endif

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
