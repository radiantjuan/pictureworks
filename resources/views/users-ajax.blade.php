@extends('layouts')
@section('content')
    <section id="main">
        <header>
            <div class="js-loading">
                loading...
            </div>
            <div class="js-content hidden">
                <span class="avatar">
                <img class="js-image" src=""
                     alt=""/>
                </span>
                <h1 class="js-name"></h1>
                <h3>Comments:</h3>
                <div class="js-comment-lists">
                </div>
            </div>
        </header>
        @include('form')
    </section>

@endsection
