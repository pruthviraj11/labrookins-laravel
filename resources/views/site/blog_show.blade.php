@extends('layouts.homeLayout')

@section('title', 'Blog Details')

@section('content')




<div class="container mb-5">
  <p class="">
    {!! $blog_show->long_description !!}
    </p>
</div>

@endsection
