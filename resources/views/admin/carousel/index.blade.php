@extends('layouts.master')
@section('title','輪播圖片和Solgan管理')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
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

    .popup-wrap {
        width: 100%;
        height: 100%;
        display: none;
        position: fixed;
        top: 0px;
        left: 0px;
        content: '';
        background: rgba(0, 0, 0, 0.85);
    }

    .popup-box {
        width: 50%;
        padding: 50px 75px;
        transform: translate(-50%, -50%) scale(0.5);
        position: absolute;
        top: 50%;
        left: 50%;
        box-shadow: 0px 2px 16px rgba(0, 0, 0, 0.5);
        border-radius: 3px;
        background: #fff;
        text-align: center;
    }

    h2 {
        font-size: 32px;
        color: #1a1a1a;
    }

    h3 {
        font-size: 24px;
        color: #888;
    }

    .close-btn {
        width: 50px;
        height: 50px;
        display: inline-block;
        position: absolute;
        top: 10px;
        right: 10px;
        border-radius: 100%;
        background: #d75f70;
        font-weight: bold;
        text-decoration: none;
        color: #fff;
        line-height: 40px;
        font-size: 32px;
    }

    .transform-in,
    .transform-out {
        display: block;
        -webkit-transition: all ease 0.5s;
        transition: all ease 0.5s;
    }

    .transform-in {
        -webkit-transform: translate(-50%, -50%) scale(1);
        transform: translate(-50%, -50%) scale(1);
    }

    .transform-out {
        -webkit-transform: translate(-50%, -50%) scale(0.5);
        transform: translate(-50%, -50%) scale(0.5);
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
    <a class="btn popup-btn" href="#letmeopen">聯絡我們</a>

    <div class="popup-wrap" id="letmeopen">
        <div class="popup-box transform-out">
            <div class="img"></div>
            <form action="{{asset('/admin/contact')}}" method="POST">
                @csrf
                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{old('name')}}" placeholder="請填寫您的姓名">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone" name="phone"
                    value="{{old('phone')}}" placeholder="請填寫您的電話">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{old('email')}}" placeholder="請填寫您的Email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <textarea type="text" rows="3"
                    class="form-control message_textarea @error('email') is-invalid @enderror" id="content"
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
                <button type="submit" class="btn btn-info feedback_btn">送出訊息</button>
            </form>
            <a class="close-btn popup-close" href="#">x</a>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    

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

    $(".popup-btn").click(function() {
        var href = $(this).attr("href")
        $(href).fadeIn(250);
        $(href).children$("popup-box").removeClass("transform-out").addClass("transform-in");
        e.preventDefault();
        });

        $(".popup-close").click(function() {
        closeWindow();
        });
        // $(".popup-wrap").click(function(){
        //   closeWindow();
        // })
        function closeWindow(){
        $(".popup-wrap").fadeOut(200);
        $(".popup-box").removeClass("transform-in").addClass("transform-out");
        event.preventDefault();
        }
</script>
@endsection