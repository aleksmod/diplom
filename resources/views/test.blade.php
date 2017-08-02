@extends('layouts.app')

@section('title', 'Home')

@section('content')
        @if ($categories)
        <ul>
            @foreach ($categories as $category)
                <li>
                    {{ $category->name }} //выводим основное меню
                    <ul>
                        @foreach ($category->subCategory as $sub)
                            <li>
                                {{ $sub->name }} //выводим подменю
                            </li>
                        @endforeach
                    </ul>
                </li>

            @endforeach
        </ul>
    @endif
@endsection

