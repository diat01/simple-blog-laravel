@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',asset($article->image))
@section('content')

<div class="col-md-9 mx-auto">
    {!!$article->content!!}
    <br>
    <span class="text-danger float-right">Okunma sayisi : <b>{{$article->hit}}</b></span>
</div>

@include('front.widgets.categoryWidget')
@endsection
