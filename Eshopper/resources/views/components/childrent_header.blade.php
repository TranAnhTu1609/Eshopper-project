@if($categoryParent->categoryChilldren->count())
    <ul role="menu" class="sub-menu">
        @foreach($categoryParent->categoryChilldren as $categoryChil)
            <li><a href="shop.html">{{$categoryChil->name}}</a></li>
            @include('components.childrent_header',['categoryParent'=>$categoryChil])
        @endforeach
    </ul>
@endif
