@extends('layouts.admin')

@section('pageTitle', 'Index home')

@section('Pagecontent')
<main class="background_post container">
    <h1>Boolpress</h1>
    {{--<form action="" method="get" class="row  g-3 mb-3 mt-3">
        <div>
            <select class="form-select" aria-label="Default select example" name="category" id="category">
                <option value="" selected>Select a category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == $request->category) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <select class="form-select" aria-label="Default select example" name="author" id="author">
                <option value="" selected>Select an author</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @if($user->id == $request->author) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <label for="search-string" class="form-label">{{ __('Stringa di ricerca') }}</label>
            <input type="text" class="form-control" id="search-string" name="s" value="{{ $request->s }}">
        </div>

        <div class="col-12">
            <button class="btn btn-primary">Applica filtri</button>
        </div>
    </form>--}}
    <ol class="d-flex flex-wrap justify-content-around cards_main">
        @foreach ($posts as $post)
            <li class="text-center d-flex flex-column" data-id="{{ $post->slug }}">
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid">
                <h3><a href="{{ route('admin.posts.show', $post->slug) }}">{{ $post->title }}</a></h3>
                <div>Created by: <strong>{{ $post->creator }}.</strong></div>
                <div>{{ $post->tags->pluck('name')->join(', ') }}</div>
                <div class="d-flex flex-column mt-auto mx-5">
                    @if (Auth::user()->id === $post->user_id)
                        <a class="btn btn-primary mb-2" href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a>
                    @endif
                    @if (Auth::user()->id === $post->user_id)
                        <button class="btn btn-danger btn-delete">Delete</button>
                    @endif
                </div>   
            </li> 
         @endforeach
    </ol>
     
    {{ $posts->links() }}

    <section id="confirmation-overlay" class="overlay d-none">
        <div class="popup">
            <h1>Sei sicuro di voler eliminare?</h1>
            <div class="d-flex justify-content-center">
                <button id="btn-no" class="btn btn-primary me-3">NO</button>
                <form method="POST" data-base="{{ route('admin.posts.destroy', '*****') }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">SI</button>
                </form>
            </div>
        </div>
    </section>
</main>

@endsection