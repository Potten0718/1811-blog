<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品添加</title>

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
                <p><b>商品名称：</b><input type="text" name="brand_name"></p>
                <p><b>商品LOGO：</b><input type="file" name="brand_logo"></p>
                <p><b>商品网址：</b><input type="text" name="brand_url"></p>
                <p><b>商品详情：</b><textarea type="text" name="brand_desc"></textarea></p>
                <button>提交</button>
            </form>
            </div>
        </div>
    </body>
</html>
