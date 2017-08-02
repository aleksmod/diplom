@extends('layouts.admin_app')

   @section('title', 'Item Info')

@section('content')
   @if($item)
      <div class="row">
         <div class="col-md-6 col-md-offset-3">.
            <div class="thumbnail">
               <img src="/public/images/{{ $item->image }}" width="350">
               <div class="caption">
                  <h5><u>Brand: </u><b>{{ $item->name }}</b></h5>
                  <p><u>Model :</u><i><b>{{ $item->model }}</b></i></p>
                  <p><u>Slug: </u><i><b>{{ $item->slug }}</b></i></p>
                  <p><u>Desc: </u><i>{{ $item->description }}</i></p>
                  <p><u>Price: </u><strong>{{ $item->price }} UAH</strong></p>
                  <a href={{ url('admin/itemUpdate').'/'.$item->id }}><button class="btn btn-warning">Update</button></a>
                  <a href={{ url('admin/itemRemove').'/'.$item->id }}><button class="btn btn-danger">Dell</button></a>
               </div>
            </div>
         </div>
      </div>
   @endif
@endsection

