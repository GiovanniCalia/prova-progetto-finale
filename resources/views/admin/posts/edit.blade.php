@extends('layouts.admin')

@section('pageTitle', 'Edit post')

@section('Pagecontent')
<main>
    <div class="container">
      <div class="row">
          <div class="col-8 offset-2">
              <h1 class="text-center">Add a post</h1>
              <form method="POST" action="{{ route('admin.posts.update', $post->slug) }}" class="mb-3" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label for="title" class="form-label"><h4>{{ __('title') }}</h4></label>
                    <input type="text" name="title" class="form-control" id="text" value="{{ old('title', $post->title) }}">
                  </div>
                  @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="mb-3">
                    <label for="slug" class="form-label"><h4>{{ __('slug') }}</h4></label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug', $post->slug) }}">
                  </div>
                  @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <label for="category_id" class="form-label"><h4>{{ __('category') }}</h4></label>
                  <select name="category_id" id="category" class="form-control">
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" @if ($category->id == old('category_id', $post->category->id)) selected @endif>{{ $category->name }}</option>
                    @endforeach
                  </select>
                  @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  <fieldset>
                    <legend>tags</legend>
                    @foreach ($tags as $tag)
                      <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                      @if (in_array($tag->id, old('tags', $post->tags->pluck('id')->all()))) checked @endif>
                      <label for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    @endforeach
                    @error('tags')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </fieldset>

                  <div class="mb-3">
                    <label for="creator" class="form-label"><h4>{{ __('creator') }}</h4></label>
                    <input type="text" name="creator" class="form-control" id="creator" value="{{ old('creator', $post->creator) }}">
                  </div>
                  @error('creator')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="mb-3">
                    <label for="description" class="form-label"><h4>{{ __('description') }}</h4></label>
                    <input type="text" name="description" class="form-control" id="description" value="{{ old('description', $post->description) }}">
                  </div>
                  @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror


                 {{--<div class="mb-3">
                    <label for="image" class="form-label"><h4>{{ __('image') }}</h4></label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image', $post->image) }}">
                  </div>
                  @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror--}}

                  <div class="mb-3">
                    <label for="image" class="form-label"><h4>{{ __('image') }}</h4></label>
                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                  </div>
                  <img src="{{ asset('storage/' . $post->image) }}" alt="" class="img-fluid">
                  @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror


                  <div class="mb-3">
                    <label for="date_creation" class="form-label"><h4>{{ __('date_creation') }}</h4></label>
                    <input type="date" name="date_creation" class="form-control" id="date_creation" value="{{ old('date_creation', $post->date_creation) }}">
                  </div>
                  @error('date_creation')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              <div class="text-center links my-4">
                <a class="btn btn-primary" href="{{ url()->previous()}}" id="gray">Back</a>
              </div>
          </div>
      </div>
  </div>
  </main>
@endsection