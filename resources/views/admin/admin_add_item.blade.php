@extends('layouts.admin_app')

@section('title', 'add new Item')

@section('content')
    <div class="center-block"  style="width: 90%">
        {{ Form::open(['class' => 'form-horizontal', 'files' => 'true', 'method' => 'post', 'route' => 'addNewItem']) }}
            {{ csrf_field() }}

        @if($categories)
            <div class="form-group">
                <label for="category" class="col-sm-3 control-label">Category</label>
                <div class="col-sm-6">
                    <select class="selectpicker form-control" style="width: 600px" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        @if($parent_categories)
                <div class="form-group">
                    <label for="category" class="col-sm-3 control-label">Parent Category</label>
                    <div class="col-sm-6">
                        <select class="selectpicker form-control" style="width: 600px" name="parent_id">
                            @foreach($parent_categories as $parent)
                                <option value="{{$parent->id}}">{{$parent->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Brand</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="name" style="width: 600px" placeholder="name">
                </div>
            </div>

            <div class="form-group">
                <label for="model" class="col-sm-3 control-label">Model</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="model" style="width: 600px" placeholder="model">
                </div>
            </div>

            <div class="form-group">
                <label for="slug" class="col-sm-3 control-label">Slug</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="slug" style="width: 600px" placeholder="slug">
                </div>
            </div>

            <div class="form-group">
                <label for="model" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-6">
                    <textarea class="form-control" type="text" name="description" rows="5" style="width: 600px" placeholder="description"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="price" class="col-sm-3 control-label">Price</label>
                <div class="col-sm-6">
                    <input class="form-control" type="number" name="price"  style="width: 600px" placeholder="price">
                </div>
            </div>

            <div class="form-group">
                <label for="InputFile" class="col-sm-3 control-label">File input</label>
                <div class="col-sm-6">
                    <input type="file" name="input_image" placeholder="image">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <br><button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>
            {{ Form::close() }}
    </div>


@endsection

