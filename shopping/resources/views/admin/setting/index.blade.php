@extends('layouts.admin')

@section('title')
    <title>SETTINGS</title>
@endsection
@section('css')
    <link href="{{asset('admins/setting/index/index.css')}}" rel="stylesheet" />

@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'Slider','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="btn-group float-right m-2">
                        <button class="btn btn-primary">Add Settings</button>
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            @can('setting-list')
                            <li><a href="{{route('settings.create').'?type=Text'}}">Text</a></li>
                            <li><a href="{{route('settings.create').'?type=Textarea'}}">Textarea</a></li>
                            @endcan
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $settingItem)
                                <tr>
                                    <th scope="row">{{$settingItem->id}}</th>
                                    <td>{{$settingItem->config_key}}</td>
                                    <td>{{$settingItem->config_value}}</td>php
                                    <td>
                                        @can('setting-add')
                                        <a href="{{route('settings.edit',['id'=>$settingItem->id]).'?type='.$settingItem->type}}" class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('setting-delete')
                                        <a href="" data-url="{{route('settings.delete',['id'=>$settingItem->id]).'?type='.$settingItem->type}}" class="btn btn-danger action_delete">Delete</a>
                                            @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$settings->links()}}
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
    <script src="{{asset('admins/setting/index/list.js')}}"></script>
@endsection
