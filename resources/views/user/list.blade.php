<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
            <table border="1">
                <h3>管理员列表</h3>
                <tr>
                    <td>ID</td>
                    <td>管理员姓名</td>
                    <td>管理员电话</td>
                    <td>管理员邮箱</td>
                </tr>
                @if($data)
                @foreach($data as $v)
                <tr>
                    <td>{{$v->admin_id}}</td>
                    <td>{{$v->admin_name}}</td>
                    <td>{{$v->admin_tel}}</td>
                    <td>{{$v->admin_email}}</td>
                </tr>
                @endforeach
                @endif
            </table>    
            </div>
        </div>
    </body>
</html>
