@extends('front.layouts.master')
@section('title', 'Iletisim')
@section('bg', 'http://blackrockdigital.github.io/startbootstrap-clean-blog/img/contact-bg.jpg')
@section('content')

<div class="col-md-8">
    @if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <p>Bizimle iletisime gecebilirsiniz.</p>
    <form method="post" action="{{route('contact.post')}}">
        @csrf
        <div class="control-group">
            <div class="form-group controls">
                <label>Ad Soyad</label>
                <input type="text" class="form-control" value="{{old('name')}}" placeholder="Ad Soyadiniz" name="name"
                    required>
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="control-group">
            <div class="form-group controls">
                <label>Email Adresi</label>
                <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email Adresiniz"
                    name="email" required>
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="control-group">
            <div class="form-group col-xs-12 controls">
                <label>Konu</label>
                <select name="topic" class="form-control">
                    <option @if(old('topic')=='Bilgi' ) selected @endif>Bilgi</option>
                    <option @if(old('topic')=='Destek' ) selected @endif>Destek</option>
                    <option @if(old('topic')=='Genel' ) selected @endif>Genel</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <div class="form-group controls">
                <label>Mesajiniz</label>
                <textarea rows="5" class="form-control" placeholder="Mesajiniz"
                    name="message">{{old('message')}}</textarea>
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <br>
        <div id="success"></div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Gonder</button>
        </div>
    </form>
</div>
<div class="col-md-4">
    <div class="card card-default">
        <div class="card-body">Panel Content</div>
        Adres : bla bla bla
    </div>
</div>

@endsection
