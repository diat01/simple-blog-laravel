@extends('back.layouts.master')
@section('title', 'Sayfa Olustur')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            @yield('title')
        </h6>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>
        @endif
        <form method="POST" action="{{route('admin.page.post')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Sayfa Basligi</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Sayfa Fotografi</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Sayfa Icerigi</label>
                <textarea name="content" id="editor" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Sayfayi Olustur</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@endsection
@section('js')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script>
    $(document).ready(function () {
        $('#editor').summernote({
            'height': 300
        });
    });

</script>
@endsection
