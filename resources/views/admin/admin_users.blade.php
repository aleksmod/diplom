@extends('layouts.admin_app')

@section('title', 'Users')

@section('content')

   @if($users)
       <div class="center-block"  style="width: 90%">
           <div class="form-group">
               <h3 align="center">Users</h3>

               <table class="table table-bordered">
                   <thead class="bg-primary">
                   <th>id</th>
                   <th>name</th>
                   <th>email</th>
                   <th>password</th>
                   </thead>
                   <tbody >
                   @foreach($users as $user)
                       <tr class="
                       @if ($user->name === 'Admin')
                               success
                       @endif
                               ">
                           <td>{{ $user->id }}</td>
                           <td>{{ $user->name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>{{ $user->password }}</td>
                        </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       </div>

       {{--<div class="navbar-fixed-bottom row-fluid">--}}
           {{--<div class="navbar-inner">--}}
               <div class="center-block" style="width: 10%">
                   {{ $users->links() }}
               </div>
           {{--</div>--}}
       {{--</div>--}}

   @endif

@endsection

