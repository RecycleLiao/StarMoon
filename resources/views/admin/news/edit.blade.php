@extends('layouts.app')
@section('css')

@endsection

@section('main')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{asset('/admin')}}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{route('news.index')}}">最新消息管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯消息</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">最新消息 - 編輯</h2>

                <div class="card-body">
                    <form method="POST" action="{{route('news.update',['news' => $news->id])}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row py-2">
                            <label for="title" class="col-sm-2 col-form-label">標題</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="date" class="col-sm-2 col-form-label">日期</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date" name="date" value="{{$news->date}}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="show" class="col-sm-2 col-form-label">是否顯示</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="show" name="show" value="{{$news->show}}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="orderby" class="col-sm-2 col-form-label">序號</label>
                            <div class="col-sm-10">
                                <input type="number" min="1" class="form-control" id="orderby" name="orderby" value="{{$news->orderby}}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="img" class="col-sm-2 col-form-label">圖片</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="img" name="image_url" value="{{$news->image_url}}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">描述/備註</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" rows="5" required>{{$news->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">更新</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
