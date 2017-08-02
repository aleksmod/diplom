@extends('layouts.app')

@section('title', 'Home')

@section('content')
        <div class="col-sm-3 col-lg-2">
            <h3>Categories</h3>

            @if($categories)
                <ul id="menu">
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
                <h3>ALL Items</h3>

                @if (!empty($items))
                    @foreach ($items as $item)
                        <div class="col-sm-9 col-md-3">
                            <div class="thumbnail">
                                <img src="/public/images/{{ $item->image }}">
                                <div class="caption">
                                    <h5><b>{{ $item->name }} - {{ $item->model }}</b></h5>
                                    <p>Price: <strong>{{ $item->price }} UAH</strong></p>
                                    <a href="{{ url('cart/add').'/'. $item->id}}" class="btn btn-success" role="button">Add to cart</a>
                                    <a href={{ url('item_info').'/'.$item->slug }} ></a>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#itemInfo">Info</button>
                            </div>
                            </div>
                        </div>
                    @endforeach

                @endif
        </div>

        <div class="navbar-fixed-bottom">
            <div class="navbar-inner">
                <div class="container">
                    <div class="center-block" style="width: 40%">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="itemInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        @if($item)
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">.
                                    <div class="thumbnail">
                                        <img src="/public/images/{{ $item->image }}" width="350">
                                        <div class="caption">
                                            <h5><u>Brand: </u><b>{{ $item->name }}</b></h5>
                                            <p><u>Model :</u><i><b>{{ $item->model }}</b></i></p>
                                            <p><u>Desc: </u><i>{{ $item->description }}</i></p>
                                            <p><u>Price: </u><strong>{{ $item->price }} UAH</strong></p>
                                            <a href="{{ url('cart/add').'/'. $item->id}}" class="btn btn-success" role="button">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

@endsection

