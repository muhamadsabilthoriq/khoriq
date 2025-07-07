@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $chapter->title }}</h2>
    @foreach ($chapter->pages as $page)
        <img src="{{ asset('storage/' . $page->image_path) }}" class="img-fluid mb-4" alt="Page {{ $loop->iteration }}">
    @endforeach
</div>
@endsection
    