<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品列表</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('css/page.css')}}" rel="stylesheet">
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
    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <h3>商品列表</h3>
                <form>
                <input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="根据关键字搜索" >
                <input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="根据网址搜索" >
                <button>搜索</button>
                </form>
                <table border="1">
                <tr>
                    <td>ID</td>
                    <td>商品名称</td>
                    <td>商品网址</td>
                    <td>商品详情</td>
                    <td>添加时间</td>
                    <td>商品LOGO</td>
                </tr>
                @if($data)
                @foreach($data as $v)
                <tr>
                    <td>{{$v->brand_id}}</td>
                    <td>{{$v->brand_name}}</td>
                    <td>{{$v->brand_url}}</td>
                    <td>{{$v->brand_desc}}</td>
                    <td>{{$v->create_time}}</td>
                    <td><img src="{{config('app.img_url')}}{{$v->brand_logo}}" width="100" alt="暂无图片"></td>
                </tr>
                @endforeach
                @endif
                </table>
            </div>
        </div>
         {{$data->appends($query)->links()}}
    </body>
</html>
