@extends('back.layouts.master')
@section('title', 'Ayarlar')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            @yield('title')
        </h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.config.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Site Basligi</label>
                    <input type="text" name="title" required class="form-control" value="{{$config->title}}">
                </div>
                <div class="col-md-6 form-group">
                    <label>Site Aktiflik Durumu</label>
                    <select name="active" class="form-control">
                        <option @if ($config->active == 1) selected @endif value="1">Acik</option>
                        <option @if ($config->active == 0) selected @endif value="0">Kapali</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Site Logo</label><br>
                    <img src="{{asset($config->logo)}}" alt="logo" width="300" class="img-thumbnail rounded"><br><br>
                    <input type="file" name="logo" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label>Site Favicon</label><br>
                    <img src="{{asset($config->favicon)}}" alt="favicon" width="300" class="img-thumbnail rounded"><br><br>
                    <input type="file" name="favicon" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label>Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{$config->facebook}}">
                </div>
                <div class="col-md-6 form-group">
                    <label>Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="{{$config->twitter}}">
                </div>
                <div class="col-md-6 form-group">
                    <label>Github</label>
                    <input type="text" name="github" class="form-control" value="{{$config->github}}">
                </div>
                <div class="col-md-6 form-group">
                    <label>LinkIn</label>
                    <input type="text" name="linkedin" class="form-control" value="{{$config->linkedin}}">
                </div>
                <div class="col-md-6 form-group">
                    <label>Youtube</label>
                    <input type="text" name="youtube" class="form-control" value="{{$config->youtube}}">
                </div>
                <div class="col-md-6 form-group">
                    <label>Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="{{$config->instagram}}">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-md btn-success">Guncelle</button>
            </div>
        </form>
    </div>
</div>
@endsection
