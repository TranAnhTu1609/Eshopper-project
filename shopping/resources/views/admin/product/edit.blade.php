@extends('layouts.admin')

@section('title')
    <title>Edit Product</title>
@endsection
@section('css')
    <link  href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link  href="{{asset('admins/product/edit/edit.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'category','key'=>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('products.update',['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên Sản phẩm</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{$product->name}}">
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text" class="form-control" name="price" placeholder="Nhập giá sản phẩm" value="{{number_format($product->price)}}">
                            </div>
                            <div class="form-group">
                                <label>Ânh đại diện</label>
                                <input type="file" class="form-control-file" name="feature_image_path" value="">
                            </div>
                            <div class="col-md-4 feature_image_container">
                                <img src="{{$product->feature_image_path}}" class="feature_image">
                            </div>
                            <div class="form-group">
                                <label>Ânh chi tiết</label>
                                <input type="file" class="form-control-file" multiple name="image_path[]">
                                <div class="col-md-6 container_image_detail">
                                    <div class="row">
                                        @foreach($product->productImages as $productItem)
                                        <div class="col-md-3">
                                            <img class="image_detail_product" src="{{$productItem->image_path}}">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select_int" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tagsItem)
                                        <option value="{{$tagsItem->name}}" selected>{{$tagsItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập nội dung</label>
                                <textarea name="contents" class="form-control my-editor" rows="5">{{$product->content}}</textarea>
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('admins/product/edit/edit.js')}}"></script>
    <script>
    </script>
@endsection

