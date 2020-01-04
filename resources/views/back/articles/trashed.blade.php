@extends('back.layouts.master')
@section('title', 'Silinen Makaleler')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            @yield('title')
            <span class="m-0 font-weight-bold float-right text-primary">
                {{$articles->count()}} makale bulundu.
                <a href="{{route('admin.makaleler.index')}}" class="btn btn-primary btn-sm"><i
                        class="fas fa-undo fa-sm"></i>
                    Aktif Makaleler</a>
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
                            <a href="{{route('admin.recover.article', $article->id)}}" title="Geri Yukle"
                                class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{route('admin.hard.delete.article', $article->id)}}" title="Sil"
                                class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
