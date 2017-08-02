@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="text-center">
        <h3><b>Found items on request  - {{count($items)}}</b></h3>
    </div>

    @if (!empty($items))
        @foreach ($items as $item)
            <div class="col-sm-6 col-md-2">
                <div class="thumbnail">
                    <img src="/public/images/{{ $item->image }}">
                    <div class="caption">
                        <h5><b>{{ $item->name }} - {{ $item->model }}</b></h5>
                        <p>Price: <strong>{{ $item->price }} UAH</strong></p>
                        {{--<a href="{{ url('cart/add').'/'. $item->id}}" class="btn btn-success" role="button">Add to cart</a>--}}
                        <a href={{ url('item_info').'/'.$item->slug }} ><button class="btn btn-info">Detailed information</button></a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection

