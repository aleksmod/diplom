@extends('layouts.admin_app')

@section('title', 'Orders')

@section('content')
   @if($orders)

       <div class="center-block"  style="width: 90%">
           <h1> This is last {{ count($orders) }} orders </h1>
           <table class="table" >
               <thead class="bg-success">
                   <th>Date</th>
                   <th>User ID</th>
                   <th>Order ID</th>
                   <th>Order</th>
               </thead>
               <tbody>
               @foreach ($orders as $order)
                       <tr>
                           <td>{{$order->date}}</td>
                           <td>{{$order->user_id}}</td>
                           <td>{{$order->id}}</td>
                           <td>
                               <table class="table">
                                   <thead>
                                       <th>id</th>
                                       <th>item</th>
                                       <th>price</th>
                                       <th>count</th>
                                   </thead>

                                   <tbody>
                                       @foreach ($order->items as $item)
                                           <tr>
                                               <td>{{$item->id}}</td>
                                               <td>{{$item->name}} - {{$item->model}}</td>
                                               <td>{{$item->price}}</td>
                                               <td>{{$item->id}}</td>
                                           </tr>
                                       @endforeach
                                    </tbody>
                               </table>
                           </td>
                        </tr>
               @endforeach
               </tbody>
           </table>
       </div>

      {{-- <div class="navbar-fixed-bottom row-fluid">
           <div class="navbar-inner">
               <div class="center-block" style="width: 10%">
                   {{ $orders->links() }}
               </div>
           </div>
       </div>--}}
   @endif

@endsection

