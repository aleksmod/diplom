@extends('layouts.admin_app')

@section('title', 'All Items')

@section('content')

        <div class="col-sm-3 col-lg-2">
                <ul>
                    <a href={{ route('items') }}><b><li class="list-group-item">All items</li></b></a>

                    @if($categories)
                        @foreach($categories as $category)
                            <a href="/admin/category/{{ $category->slug }}"><li class="list-group-item"> {{ $category->name }}</li></a>
                            <ul>
                                @foreach ($category->subCategory as $sub)
                                    <a href="/admin/category/{{$sub->slug }}"><li class="list-group-item-info"> {{ $sub->name }}</li></a>
                                @endforeach
                            </ul>
                        @endforeach
                    @endif
                </ul><br>

                <a href="{{ route('addItemsForm') }}"> <button class="btn btn-success">New Item</button></a>
        </div>

        <div class="col-sm-9 col-lg-10">

            @if (!empty($items))

                <div class="center-block">
                    <div class="container-fluid">
                        <table class="table">
                            <thead>
                            <th>Image</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Action</th>
                            </thead>

                            <tbody>
                            <tbody id="row_holder">
                            @foreach($items as $item)
                                <tr>
                                    <td style="width: 10%"><img src="/public/images/{{ $item->image }}" height="100" {{--width="350"--}}></td>
                                    <td style="width: 15%">
                                        <b>{{ $item->name }}  <i>{{ $item->model }}</i></b><br>
                                        <b>Price: </b> {{ $item->price }} UAH <br>
                                        <b>Slug: </b>{{ $item->slug }}<br>
                                        <b>Category: </b>{{ $item->category_id }}
                                        <b>Parent: </b>{{ $item->parent_id }}
                                    </td>
                                    <td style="width: 65%">
                                        {{ $item->description }}</td>
                                    <td style="width: 10%">
                                        <a href={{ url('admin/itemUpdate').'/'.$item->id }}><button class="btn btn-warning">Edit</button></a>
                                        <a href={{ url('admin/itemRemove').'/'.$item->id }}><button class="btn btn-danger">Dell</button></a>
                                    </td>
                                    {{--<td><a href={{ url('item_info').'/'.$item->slug }} ><button class="btn btn-info">Info</button></a></td>--}}
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
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


        </div>



@endsection
