@extends('layouts')
@section('content')
    <section id="main">
        <header>
            <span class="avatar">
                <img src="{{\Illuminate\Support\Facades\Storage::url('users/'.$user->id.'.jpg')}}"
                     alt=""/>
            </span>
            <h1>{{$user->name}}</h1>
            <h3>Comments:</h3>
            @foreach($user_comments as $comments)
                <p>{{nl2br($comments)}}</p>
            @endforeach
        </header>
        @include('form')
    </section>
@endsection
