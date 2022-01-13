@extends('layouts.app')
@section('title','輪播圖片和Solgan管理')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
    .modal-header h3 {
        font-size: 30px;
        position: absolute;
        top: 25px;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .modal-content {
        background-color: burlywood;
    }

    .form-control {
        margin: 20px;
        width: 90%;
        border-radius: 20px;
    }

    .btn-info {
        width: 100%;
        font-size: 25px;
        color: white;
    }

    /* 我是分隔線 */
    th,
    td {
        text-align: center;
        vertical-align: middle;
    }
</style>
@endsection

@section('main')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">輪播圖片和Slogan管理</h2>
                <div class="form-group pt-4 px-3 m-0">
                    <a href="{{route('carousels.create')}}" class="btn btn-success">新增輪播圖片和Slogan</a>
                </div>
                <hr>
                <div class="card-body">
                    <table id="my-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Slogan</th>
                                <th width="250">圖片</th>
                                <th width="120">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carousels as $carousel)
                            <tr>
                                <td>{{$carousel->slogan}}</td>
                                <td><img src="{{Storage::url($carousel->image_url)}}" alt="" width="200"></td>
                                <td>
                                    <a href="{{route('carousels.edit',['carousel'=>$carousel->id])}}"
                                        class="btn btn-primary">編輯</a>
                                    <button class="btn btn-danger delete-btn">刪除</button>
                                    <form class="d-none"
                                        action="{{route('carousels.destroy',['carousel'=>$carousel->id])}}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- 跳出視窗內容 -->
    <div class="modal fade" id="loginModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h3>聯絡我們</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Body -->
                <div class="modal-body">
                    <!-- 表單內容 -->
                    <form action="{{asset('/admin/contact')}}" method="POST">
                        @csrf                            
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="請填寫您的姓名">
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror                            
                            <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{old('phone')}}" placeholder="請填寫您的電話">
                            @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror                            
                            <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="請填寫您的Email">
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror                            
                            <textarea type="text" rows="3" class="form-control message_textarea @error('email') is-invalid @enderror" id="content"
                            name="content" placeholder="您想留言的訊息">{{old('content')}}</textarea>
                            @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            @error('g-recaptcha-response')                            
                                <strong class="text-danger">{{ $message }}</strong>                            
                            @enderror
                            {!! htmlFormSnippet() !!}
                        </div>
                        <button type="submit" class="btn btn-info feedback_btn">送出訊息</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#my-table').DataTable({
            "order":[],
            language:{
                url:"{{asset('js/datatable-zh.json')}}"
            }
        });
    });

    const deleteEles =document.querySelectorAll('.delete-btn');
    deleteEles.forEach(function(deleteEle){
        deleteEle.addEventListener('click',function(){
            if(confirm('你確定要刪除這筆資料嗎？')){
                this.nextElementSibling.submit();
            }
        })
    })
</script>
@endsection