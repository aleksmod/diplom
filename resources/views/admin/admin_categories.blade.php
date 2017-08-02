@extends('layouts.admin_app')

@section('title', 'Categories')

@section('content')

    <div class="center-block"  style="width: 90%">
        <div class="container-fluid">
            <table class="table">
                <thead>
                <th>ID</th>
                <th>Parent_ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Update</th>
                <th>Delete</th>
                </thead>

                <tbody>
                @if($categories)
                    <tbody id="row_holder">
                    @foreach($categories as $category)
                            <tr id="row_{{$category->id}}">
                                <td>{{$category->id}}</td>
                                <td id="parent_{{$category->id}}">{{ $category->parent_id }}</td>
                                <td id="name_{{$category->id}}">{{ $category->name }}</td>
                                <td id="slug_{{$category->id}}">{{ $category->slug }}</td>
                                <td id="update_{{$category->id}}"><button class="btn btn-warning" onclick="updateStart({{$category->id}})">Update</button></td>
                                <td id="remove_{{$category->id}}"><button class="btn btn-danger" onclick="categoryRemove({{$category->id}})">Delete</button></td>
                            </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

                <button class="btn btn-success" data-toggle="modal" data-target="#addCategory">Add New Category</button>

        </div>
    </div>

    <div class="navbar-fixed-bottom">
        <div class="navbar-inner">
            <div class="container">
                <div class="center-block" style="width: 40%">
        {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('modals.addCategory')

    <script src="/public/js/categories.js"></script>


@endsection
