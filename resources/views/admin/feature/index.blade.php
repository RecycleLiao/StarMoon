@extends('layouts.master')
@section('title','園區特色管理')

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
                <h2 class="card-header pt-3 pb-2">園區特色管理</h2>
                <div class="form-group pt-4 px-3 m-0">
                    <a href="{{route('features.create')}}" class="btn btn-success">新增園區特色</a>
                </div>
                <hr>
                <div class="card-body">
                    <table id="my-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>標題</th>
                                <th>副標題</th>                                
                                <th width="250">主要圖片</th>
                                <th width="120">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($features as $feature)
                                <tr>
                                    <td>{{$feature->title}}</td>
                                    <td>{{$feature->subtitle}}</td>
                                    <td><img src="{{Storage::url($feature->image_url)}}" alt="" width="200"></td>
                                    <td>
                                        <a href="{{route('features.edit',['feature'=>$feature->id])}}" class="btn btn-primary">編輯</a>                                    
                                        <button class="btn btn-danger delete-btn">刪除</button> 
                                        <form class="d-none" action="{{route('features.destroy',['feature'=>$feature->id])}}" method="post">
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