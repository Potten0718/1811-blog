<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>商品列表</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('css/page.css')}}" rel="stylesheet">
        <script type="text/javascript" src="/admin/js/jquery-3.3.1.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <meta name="csrf-token" content="{{csrf_token()}}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <q>访问量：{{$num}}</q>
            <div class="content">
                <h3>商品列表</h3>
             
                <table border="1">
                <tr>
                    <td>编号</td>
                    <td>文章标题</td>
                    <td>文章分类</td>
                    <td>文章重要性</td>
                    <td>文章显示</td>
                    <td>添加日期</td>
                    <td>图片</td>
                    <td>操作</td>
                </tr>
                @if($data)
                @foreach($data as $v)
                <tr id="tr2">
                    <td>{{$v->news_id}}</td>
                    <td>{{$v->news_name}}</td>
                    <td>{{$v->ncate_name}}</td>
                    <td>{{$v->news_zyx}}</td>
                    <td>{{$v->news_show}}</td>
                    <td>{{$v->create_time}}</td>
                    <td><img src="{{config('app.img_url')}}{{$v->news_photo}}" width="200" ></td>
                    <td>[<a href="javascript:void(0);" class="del" news_id="{{$v->news_id}}">删除</a>][<a href="/news/edit/{{$v->news_id}}">修改</a>]</td>
                </tr>
                @endforeach
                @endif
                </table>
            </div>
        </div>
  
    </body>
</html>
<!-- <script scr="{{asset('js/jquery-3.3.1.min.js')}}"></script> -->
<script type="text/javascript">
    $('.del').click(function(){
        var news_id=$(this).attr('news_id');
        alert(news_id);
        if(!news_id){
            alert('请选择一个文章进行删除！');
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('/news/del/'+news_id,'',function(msg){
            alert(msg.msg);
            if(msg.code=1){
                $('#tr2').remove();
            }
            window.location.reload();
        },'json');
        
    });
</script>
