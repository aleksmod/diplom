@extends('layouts.app')

@section('title', 'Orders')

@section('content')
    @if($orders)
        <div class="center-block"  style="width: 90%">
            <table class="table">
                <thead class="bg-info">
                    <th>date</th>
                    <th>order</th>
                    <th>total price</th>
                </thead>
                    @foreach ($orders as $order)
                        <tbody>
                            <tr>
                                <td>{{ $order->date }}</td>
                                <td>
                                    <table class="table">
                                        <thead>
                                            <th>item</th>
                                            <th>price</th>
                                            <th>count</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $item)
                                                <tr>
                                                    <td>{{$item->name}} - {{$item->model}}</td>
                                                    <td>{{$item->price}} UAH</td>
                                                    <td>{{$item->count}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td><b>{{ $order->total_price }} UAH </b></td>
                            </tr>
                        </tbody>
                    @endforeach
            </table>
        </div>
    @endif
@endsection




