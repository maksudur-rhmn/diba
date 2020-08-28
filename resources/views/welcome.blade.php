<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ centralSettings()->title }}</title>

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

            #banner{
                width: 100%;
                height: 1000px;
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
                color: #fff;
                font-weight: bold;
            }

            .links > a {
                color: #fff;
                font-weight: bold;
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
            p {
                color : #fff;
                margin-bottom : 30px;
            }
            .description a {
                border : 2px solid #fff;
                color : #fff;
                padding : 10px 25px;
                border-radius : 10px;
                text-decoration : none;
                transition :  0.8s all linear;
                -webkit-box-shadow: 0px 3px 5px 0px rgba(138,166,164,1);
                -moz-box-shadow: 0px 3px 5px 0px rgba(138,166,164,1);
                box-shadow: 0px 3px 5px 0px rgba(138,166,164,1);
            }
            .description a:hover {
                background : #fff;
                color : #3E0085;
            }
        </style>
    </head>
    <body>
        <section id="banner" style="background: url({{ asset('uploads/settings/banner.jpg') }})no-repeat center">
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
    
                <div class="content">
                    <div class="title">
                        <h1>ANA</h1>
                    </div>
                    <div class="description m-b-md">
                        <p>Laravel Login & Role Management System</p>
                        <a href="">Documentations</a>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
