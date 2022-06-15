@extends('layouts.admin')

@section('pageTitle', 'Show post')

@section('Pagecontent')
<main>
    <div class="container">
      <div class="row">
          <div class="col-8 offset-2">
              <h1 class="text-center">Add a post</h1>
              <form method="post" action="{{ route('admin.posts.store') }}" class="mb-3" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="title" class="form-label"><h4>{{ __('title') }}</h4></label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                  </div>
                  @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="mb-3">
                    <label for="slug" class="form-label"><h4>{{ __('slug') }}</h4></label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}">
                  </div>
                  <input type="button" value="Generate slug" id="btn-slugger">
                  @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="my-3">
                    <label for="category_id" class="form-label"><h4>{{ __('category') }}</h4></label>
                    <select name="category_id" id="category" class="form-control">
                      <option value="">Select category</option>
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <fieldset>
                    <legend>tags</legend>
                    @foreach ($tags as $tag)
                      <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                      @if (in_array($tag->id, old('tags', []))) checked @endif>
                      <label for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    @endforeach
                    @error('tags')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </fieldset>

                  <div class="mb-3">
                    <label for="creator" class="form-label"><h4>{{ __('creator') }}</h4></label>
                    <input type="text" name="creator" class="form-control" id="creator" value="{{ old('creator') }}">
                  </div>
                  @error('creator')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="mb-3">
                    <label for="description" class="form-label"><h4>{{ __('description') }}</h4></label>
                    <input type="text" name="description" class="form-control" id="description" value="{{ old('description') }}">
                  </div>
                  @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  {{--<div class="mb-3">
                    <label for="image" class="form-label"><h4>{{ __('image') }}</h4></label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image') }}" accept="image/*">
                  </div>
                  @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror--}}

                  <div class="mb-3">
                    <label for="image" class="form-label"><h4>{{ __('image') }}</h4></label>
                    <input class="form-control" type="file" id="image" name="image" accept="image/*" value="{{ old('image') }}">
                  </div>
                  @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  <div class="mb-3">
                    <label for="date_creation" class="form-label"><h4>{{ __('date_creation') }}</h4></label>
                    <input type="date" name="date_creation" class="form-control" id="date_creation" value="{{ old('date_creation') }}">
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