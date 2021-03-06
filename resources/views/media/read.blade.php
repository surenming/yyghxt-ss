@extends('layouts.base')

@section('content')
    @include('layouts.tip')
    <link type="text/css" href="/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">列表</h3>
            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 80px;">
                    @ability('superadministrator', 'create-medias')
                        <a href="{{route('medias.create')}}" class="btn-sm btn-info">新增媒体</a>
                    @endability
                </div>
            </div>
        </div>
        <div class="box-body">
            <form action="" method="post" class="medias-form">
                {{method_field('DELETE')}}
                {{csrf_field()}}
            <table id="medias-list-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Media</th>
                    <th>名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($medias as $media)
                    <tr>
                        <td>{{$media->id}}</td>
                        <td>{{$media->name}}</td>
                        <td>{{$media->display_name}}</td>
                        <td>
                            @if($enableUpdate)
                                <a href="{{route('medias.edit',$media->id)}}"  alt="编辑" title="编辑"><i class="fa fa-edit"></i></a>
                            @endif
                            @if($enableDelete)
                                <a href="javascript:void(0);" data-id="{{$media->id}}"  alt="删除" title="删除" class="delete-operation"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/asset/layer/layer.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#media-list-table').DataTable({
                "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
                "language": {
                    "url": "/datables-language-zh-CN.json"
                }
            });
            $(".delete-operation").on('click',function(){
                var id=$(this).attr('data-id');
                layer.open({
                    content: '你确定要删除吗？',
                    btn: ['确定', '关闭'],
                    yes: function(index, layero){
                        $('form.medias-form').attr('action',"{{route('medias.index')}}/"+id);
                        $('form.medias-form').submit();
                    },
                    btn2: function(index, layero){
                        //按钮【按钮二】的回调
                        //return false 开启该代码可禁止点击该按钮关闭
                    },
                    cancel: function(){
                        //右上角关闭回调
                        //return false; 开启该代码可禁止点击该按钮关闭
                    }
                });
            });
        } );
    </script>
@endsection
