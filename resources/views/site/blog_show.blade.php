@extends('layouts.homeLayout')

@section('title', 'Blog Details')

@section('content')




<section class="container mb-5 section_line">

  <p class="" >
    {!! $blog_show->long_description !!}
    </p>
  </section>

@endsection
