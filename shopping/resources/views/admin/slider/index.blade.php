@extends('layouts.admin')

@section('title')
    <title>SLIDER</title>
@endsection
@section('css')
    <link href="{{asset('admins/slider/index/list.css')}}" rel="stylesheet" />
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
                    <div class="col-md-12">
                        @can('slider-add')
                        <a href="{{route('sliders.create')}}" class="btn btn-success float-right m-2">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Desciption</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $sliderItem)
                                <tr>
                                    <th scope="row"></th>
                                    <td>{{$sliderItem->name}}</td>
                                    <td>{{$sliderItem->description}}</td>
                                    <td>
                                        <img class="slider_image_150_100" src="{{$sliderItem->image_path}}" alt="">
                                    </td>
                                    <td>
                                        @can('slider-edit')
                                        <a href="{{route('sliders.edit',['id'=>$sliderItem->id])}}" class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('slider-delete')
                                        <a href="" data-url="{{route('sliders.delete',['id'=>$sliderItem->id])}}" class="btn btn-danger action_delete">Delete</a>
                                            @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$sliders->links()}}
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
    <script src="{{asset('admins/slider/index/list.js')}}"></script>
@endsection
