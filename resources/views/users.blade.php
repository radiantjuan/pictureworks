@extends('layouts')
@section('content')
    <section id="main">
        <header>
            <span class="avatar">
                <img src="{{\Illuminate\Support\Facades\Storage::url('users/'.$user->id.'.jpg')}}"
                     alt=""/>
            </span>
            <h1>{{$user->name}}</h1>
            <h2>Comments:</h2>
            @foreach($user_comments as $comments)
                <p>{{nl2br($comments)}}</p>
            @endforeach
        </header>
        @include('form')
    </section>
@endsection
