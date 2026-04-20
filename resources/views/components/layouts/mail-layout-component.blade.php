<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <title>{{ env('APP_NAME') }}</title>
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            body {
                background-color: #f2f4f4;
                color: #565454;
                font-family: 'Nunito', sans-serif;
                font-weight: 400;
                font-style: normal;
                font-size: 1.5rem;
            }

            .container {
                width: 100%;
                padding: 0 15px;
                float: left;
            }

            .wrapper {
                width: 100%;
                float:left;
            }

            .content {
                width: 80%;
                margin: 0 auto;
            }

            .text-center {
                text-align: center;
            }

            #sitename {
                font-size: 2.5rem;
                font-weight: 700;
                color: #FF2D20; /* vermelho laravel */
                padding: 25px 0 25px 0;
            }

            #footer {
                text-align: center;
                padding: 25px 0;
                margin-top: 50px;
                border-top: 1px solid #565454;
            }
        </style>
    </head>
    <body>
        <div class="container" >
            <div class="wrapper" >
                <div class="content text-center" >
                    <h1 id="sitename" >LARAVEL BLOG</h1>
                </div>
                {{ $slot }}
                <div id="footer" class="content" >
                    <p>Laravel Blog - Free & Open Source</p>
                </div>
            </div>
        </div>
    </body>
</html>
