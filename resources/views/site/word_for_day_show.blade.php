@extends('layouts.homeLayout')

@section('title', 'Word For Day | L.A. BROOKINS MINISTRIES')

@section('content')




<section class="container section_line">
  <p>
    {!! $word_for_day_show->long_description !!}
    </p>
  </section>

@endsection
