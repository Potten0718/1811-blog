<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>文章添加</title>

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
            <form action="{{route('doadd')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <p><b>文章标题：</b><input type="text" name="news_name"></p>
                <p><b>文章分类：</b><select name="ncate_id">
                        <option value="0">请选择...</option>
                        @foreach($ncate as $v)                    
                        <option value="{{$v->ncate_id}}">{{$v->ncate_name}}</option>            
                        @endforeach
                </select></p>
                <p><b>文章重要性：</b><input type="radio" name="news_zyx" value="普通">普通
                    <input type="radio" name="news_zyx" value="置顶">置顶</p>
                <p><b>是否显示：</b><input type="radio" name="news_show" value="是">是
                    <input type="radio" name="news_show" value="否">否</p>
                <p><b>文章作者：</b><input type="text" name="news_zuozhe"></p>
                <p><b>作者email：</b><input type="text" name="news_email"></p>
                <p><b>关键字：</b><input type="text" name="news_gjz"></p>
                <p><b>网页描述：</b><textarea type="text" name="news_content"></textarea></p>
                <p><b>上传文件：</b><input type="file" name="news_photo"></p>
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
