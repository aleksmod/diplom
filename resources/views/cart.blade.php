@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    @if($items)
        <div class="center-block"  style="width: 90%">
            <h3 align="center">Items in the cart</h3>
            <table class="table table-bordered">

                <thead class="bg-info">
                    <th>Item</th>
                    <th>Price</th>
                    <th>Count</th>
                    <th>Total</th>
                    <th>Remove</th>
                </thead>

                <tbody class="text-center">
                    @foreach($items as $item)
                        <tr>
                            <td><b>{{ $item['name'] }} </b>  {{ $item['model'] }} </td>
                            <td>{{ $item['price'] }} UAH</td>
                            <td>
                                <b>
                                    <a href="{{ url('cart/inc').'/'.$item['id'] }}"> + </a>
                                    {{ $item['count'] }}
                                    <a href="{{ url('cart/dec').'/'.$item['id'] }}"> - </a>
                                </b>
                            </td>
                            <td>{{ $item['count'] * $item['price'] }} UAH</td>
                            <td><a href="{{ url('cart/remove').'/'.$item['id']}}">
                                    <button class="btn btn-danger">Remove</button></a></td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

            <div class="pull-right">
                {{ csrf_field() }}
                <div><b>Total: {{ $total }} (UAH)</b> </div>
                <div><a href="{{ route('newOrder') }}"><button class="btn btn-success">Make order</button></a></div>
            </div>

        </div>
    @else
        <div class="text-center" >
            <h3 class="text-info">No items in the cart</h3>
        </div>
    @endif
@endsection




