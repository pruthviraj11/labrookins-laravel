@extends('layouts.homeLayout')

@section('title', 'Word For Day')

@section('content')




<div class="container">
  <p>
    {!! $word_for_day_show->long_description !!}
    </p>
</div>

@endsection
