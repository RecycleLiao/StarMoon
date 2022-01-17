@extends('layouts.master')
@section('css')

@endsection

@section('main')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{asset('/home')}}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{route('carousels.index')}}">輪播圖片和Slogan管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增輪播圖片和Slogan</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">輪播圖片和Slogan - 新增</h2>

                <div class="card-body">
                    <form method="POST" action="{{route('carousels.store')}}" enctype="multipart/form-data">
                        @csrf                        
                        <div class="form-group row py-2">
                            <label for="slogan" class="col-sm-2 col-form-label">Slogan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="slogan" name="slogan">
                            </div>
                        </div>                                                
                        <div class="form-group row py-2">
                            <label for="image-url" class="col-sm-2 col-form-label">圖片</label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="image-url" name="image_url">
                            </div>
                        </div>                                                
                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">新增</button>
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
