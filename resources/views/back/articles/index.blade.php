@extends('back.layouts.master')
@section('title', 'Tum Makaleler')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            @yield('title')
            <span class="m-0 font-weight-bold float-right text-primary">
                {{$articles->count()}} makale bulundu.
                <a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Makaleler</a>
            </span>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotograf</th>
                        <th>Makale Basligi</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Olusturulma Tarihi</th>
                        <th>Durum</th>
                        <th>Islemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>
                            <img src="{{asset($article->image)}}" class="img-thumbnail" width="300">
                        </td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td>
                            <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif"
                                data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($article->status ==
                            1) checked @endif
                            data-toggle="toggle">
                        </td>
                        <td>
                        <a target="_blank" href="{{route('single', [$article->getCategory->slug, $article->slug])}}" title="Goruntule" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.makaleler.edit', $article->id)}}" title="Duzenle"
                                class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <form action="{{route('admin.makaleler.destroy', $article->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" title="Sil" class="btn btn-sm btn-danger"><i
                                        class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function () {
        $('.switch').change(function () {
            id = $(this)[0].getAttribute('article-id');
            statu = $(this).prop('checked');
            $.get("{{route('admin.switch')}}", {
                id: id,
                statu: statu
            }, function (data, status) {});
        })
    })

</script>
@endsection
