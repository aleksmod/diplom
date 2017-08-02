@extends('layouts.app')

@section('title', 'Items')

@section('content')

    <div class="col-sm-3 col-lg-2">
        <h3>Categories</h3>

        @if($categories)
            <ul>
                @foreach ($categories as $category)
                    <a href="{{ url('category').'/'.$category->slug }}"><li class="list-group-item"> {{ $category->name }}</li></a>
                    <ul>
                        @foreach ($category->subCategory as $sub)
                            <a href="{{ url('category').'/'.$sub->slug }}"><li class="list-group-item-info"> {{ $sub->name }}</li></a>
                        @endforeach
                    </ul>
                @endforeach
            </ul>
        @endif

    </div>


    <div class="col-sm-9 col-lg-10">
        <h3>{{ $title }}</h3>

        @if (!empty($items))
            @foreach ($items as $item)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="/public/images/{{ $item->image }}">
                        <div class="caption">
                            <h5><b>{{ $item->name }} - {{ $item->model }}</b></h5>
                            <p>Price: <strong>{{ $item->price }} UAH</strong></p>
                            <a href="{{ url('cart/add').'/'. $item->id}}" class="btn btn-success" role="button">Add to cart</a>
                            <a href={{ url('item_info').'/'.$item->slug }} ><button class="btn btn-info">Info</button></a>
                        </div>
                    </div>
                </div>
            @endforeach
                <div class="navbar-fixed-bottom">
                    <div class="navbar-inner">
                        <div class="container"><div class="center-block" style="width: 40%">
                    {{ $items->links() }}
                        </div>
                    </div>
                </div>
        @else
            No items in this category (
        @endif

    </div>

@endsection