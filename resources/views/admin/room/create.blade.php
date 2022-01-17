@extends('layouts.master')
@section('css')
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<style>
    .note-btn.dropdown-toggle:after {
        content:none;
    }
</style>
@endsection

@section('main')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{asset('/home')}}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{route('rooms.index')}}">房間管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增房間</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">房間 - 新增</h2>

                <div class="card-body">
                    <form method="POST" action="{{route('rooms.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="room-type" class="col-sm-2 col-form-label">類別<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="room-type" name="home_type_id" required>
                                <option value="" hidden>請選擇類別</option>
                                    @foreach ($roomTypes as $roomType )
                                    <option value="{{$roomType->id}}">{{$roomType->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">房間名<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="subtitle" class="col-sm-2 col-form-label">副標題</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subtitle" name="subtitle">
                            </div>
                        </div>                        
                        <div class="form-group row py-2">
                            <label for="img" class="col-sm-2 col-form-label">主要圖片<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="img" name="image_url" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="price" class="col-sm-2 col-form-label">價格<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="nmber" min="0" class="form-control" id="price" name="price" required>
                            </div>
                        </div>                        
                        <div class="form-group row py-2">
                            <label for="image-urls" class="col-sm-2 col-form-label">其它圖片</label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="image-urls" name="image_urls[]" multiple>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">描述<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="room-facility" class="col-sm-2 col-form-label">房間設備<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="room_facility" id="room-facility" required></textarea>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#room-facility').summernote();
    });
</script>
@endsection
