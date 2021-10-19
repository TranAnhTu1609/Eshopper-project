@extends('layouts.master')
@section('title')
    <title>Home | E-Shopper</title>
@endsection
@section('css')
    <link href="{{asset('Eshopper/home/home.css')}}" rel="stylesheet">
@endsection

@section('content')
    <!--/slider-->
    @include('home.components.slider')
    <!--/slider-->
    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')
                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                    @include('home.components.features_product')
                    <!--features_items-->

                    <!--category-tab-->
                    @include('home.components.category_tab')
                    <!--/category-tab-->

                    <!--recommended_items-->
                    @include('home.components.recommended_items')
                    <!--/recommended_items-->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{asset('Eshopper/cart/cart.js')}}"></script>
@endsection

