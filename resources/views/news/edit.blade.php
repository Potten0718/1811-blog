<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>文章修改</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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

 /*           .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
*/
            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: left;
                padding:25px;
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
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
            <b>商品添加</b></br>

            @if ($errors->any())     
            <div class="alert alert-danger">         
            <ul>             
            @foreach ($errors->all() as $error)                 
            <li>{{ $error }}</li>            
            @endforeach         
            </ul>     
            </div> 
            @endif 
            <form action="{{url('/news/update/'.$data->news_id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <p><b>文章标题：</b><input type="text" value="{{$data->news_name}}" name="news_name"></p>
                <p><b>文章分类：</b><select name="ncate_id">
                        <option value="0">请选择...</option>
                        @foreach($ncate as $v)                    
                        <option value="{{$v->ncate_id}}" @if($v->ncate_id ==$data->ncate_id)selected @endif />{{$v->ncate_name}}</option>            
                        @endforeach
                </select></p>
                <p><b>文章重要性：</b><input type="radio" name="news_zyx" value="普通" @if($data->news_zyx =='普通') checked @endif />普通
                    <input type="radio" name="news_zyx" value="置顶" @if($data->news_zyx =='置顶') checked @endif />置顶</p>
                <p><b>是否显示：</b><input type="radio" name="news_show" value="是" @if($data->news_show =='是') checked @endif />是
                    <input type="radio" name="news_show" value="否" @if($data->news_show =='否') checked @endif />否</p>
                <p><b>文章作者：</b><input type="text" name="news_zuozhe" value="{{$data->news_zuozhe}}"></p>
                <p><b>作者email：</b><input type="text" name="news_email" value="{{$data->news_email}}"></p>
                <p><b>关键字：</b><input type="text" name="news_gjz" value="{{$data->news_gjz}}" ></p>
                <p><b>网页描述：</b><textarea type="text" name="news_content" >{{$data->news_content}}</textarea></p>
                <p><b>上传文件：</b><img src="{{config('app.img_url')}}{{$data->news_photo}}" width="200"><input type="file" name="news_photo"></p>
                <!-- <p><input type="button" value="提交" id="btn"></p> -->
                <p><button>提交</button></p>
            </form>
            </div>
        </div>
    </body>
</html>
<script scr="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">

</script>
