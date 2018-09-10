@extends('layouts.app')

@section('content')

    @if (count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="my-4" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="title" placeholder="{{__('Title')}}" value="{{ request('id') ? old('title', $product->title) : old('title') }}">
        </div>

        <div class="form-group">
            <textarea class="form-control" rows="5" type="text" name="description" placeholder="{{__('Description')}}">{{ request('id') ? old('description', $product->description) : old('description') }}</textarea>
        </div>


        <div class="form-group">
            <input class="form-control" type="text" name="price" placeholder="{{__('Price')}}" value="{{ request('id') ? old('price', $product->price) : old('price') }}">
        </div>


        <div class="form-group">
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="validatedCustomFile">
                <label class="custom-file-label" for="validatedCustomFile">{{ __('Choose file...') }}</label>
                <div></div>
            </div>
        </div>

        <div class="form-group text-right">
            <input class="btn btn-dark" type="submit" name="save" value="{{__('Save')}}">
        </div>
    </form>

@endsection
