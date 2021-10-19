<div class="category-tab">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach($categorys as $keyCategory => $categorytab)
            <li class="{{$keyCategory==0?'active':''}}"><a href="#category_tab{{$categorytab->id}}" data-toggle="tab">{{$categorytab->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
        @foreach($categorys as $keyCategoryProduct => $CategoryProduct)
        <div class="tab-pane fade {{$keyCategoryProduct==0?'active in':''}}" id="category_tab{{$CategoryProduct->id}}" >
            @foreach($CategoryProduct->Products as $productTab)
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{config('app.base_url').$productTab->feature_image_path}}" alt="" />
                            <h2>{{number_format($productTab->price)}}VNĐ</h2>
                            <p>{{$productTab->name}}</p>
                            <a href="#"
                               data-url="{{route('addToCart',['id'=>$productTab->id])}}"
                               class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
