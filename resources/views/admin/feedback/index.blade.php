@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
th,td{
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
                <h2 class="card-header pt-3 pb-2">評價管理</h2>
                <div class="form-group pt-4 px-3 m-0">
                    <a href="{{route('feedbacks.create')}}" class="btn btn-success">新增評價</a>
                </div>
                <hr>
                <div class="card-body">
                    <table id="my-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>標題</th>
                                <th>日期</th>
                                <th>內容</th>
                                <th width="120">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <td>{{$feedback->title}}</td>
                                    <td>{{$feedback->date}}</td>
                                    <td>{!!$feedback->content!!}</td>
                                    <td>                                        
                                        <a href="{{route('feedbacks.edit',['feedback'=>$feedback->id])}}" class="btn btn-primary">編輯</a>                                    
                                        <button class="btn btn-danger delete-btn">刪除</button> 
                                        <form class="d-none" action="{{route('feedbacks.destroy',['feedback'=>$feedback->id])}}" method="post">
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