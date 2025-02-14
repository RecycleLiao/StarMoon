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
            <li class="breadcrumb-item"><a href="{{route('features.index')}}">園區特色管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯園區特色</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">園區特色 - 編輯</h2>

                <div class="card-body">
                    <form method="POST" action="{{route('features.update',['feature'=>$feature->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')                        
                        <div class="form-group row py-2">
                            <label for="title" class="col-sm-2 col-form-label">標題<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" value="{{$feature->title}}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="subtitle" class="col-sm-2 col-form-label">副標題</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{$feature->subtitle}}">
                            </div>
                        </div>                        
                        <div class="form-group row py-2">
                            <label for="image-url" class="col-sm-2 col-form-label">主要圖片</label>
                            <div class="col-sm-10">
                                <img src="{{Storage::url($feature->image_url)}}" alt="" width="200">                                
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image-url" class="col-sm-2 col-form-label">主要圖片(重新上傳)</label>
                            <div class="col-sm-10">                                
                                <input type="file" accept="image/*" class="form-control" id="image-url" name="image_url">
                            </div>
                        </div>
                        <hr>                        
                        <div class="form-group row py-2">
                            <label for="image-urls" class="col-sm-2 col-form-label">其它圖片</label>
                            <div class="col-sm-10 row">
                                @foreach ($feature->featureImages as $feature_image)
                                <div class="img" style="background-image:url({{Storage::url($feature_image->image_url)}})" alt="" width="200">
                                    <div class="delete-btn" data-id="{{$feature_image->id}}">X</div>
                                </div>                                    
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image-urls" class="col-sm-2 col-form-label">其它圖片(上傳)</label>
                            <div class="col-sm-10">                                
                                <input type="file" accept="image/*" class="form-control" id="image-urls" name="image_urls[]" multiple>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">描述<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" rows="3" required>{{$feature->description}}</textarea>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
    let deleteBtns =document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(function (deleteBtn){
        deleteBtn.addEventListener('click',function(e){
            // 獲取要刪除的image id
            let imageId = e.target.getAttribute('data-id');
            let formData = new FormData();
            formData.append('_token','{{csrf_token()}}');
            formData.append('_method','delete');
            formData.append('id',imageId);
            // 送出請求至後端刪除檔案及資料
            let url = '{{route('feature.image-delete')}}';
            fetch(url,{
                'method':'post',
                'body':formData
            }).then(function(response){
                return response.text();
            }).then(function(data){
                if(data == 'success'){
            // 刪除畫面上圖片
                    e.target.parentElement.remove();
                }
            })
        });
    });
</script>
@endsection
