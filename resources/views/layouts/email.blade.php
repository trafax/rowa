<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        body, html {
            font-family: Arial, Helvetica, sans-serif;
        }
        h2 {
            margin: 0 0 10px 0;
        }
        td {
            width: auto !important;
        }
    </style>
</head>
<body>
    <table cellpadding="0" cellspacing="0" border="0" style="table-layout: fixed;" align="center" width="700">
        <tr>
            <td style="padding: 20px 0;" width="100%">

                <table width="700">
                    <tr>
                        <td><a href="{{ url('/') }}"><img width="250" src="{{ url('img/logo.png') }}"></a></td>
                    </tr>
                </table>

                <div style="border-top: #CCC solid 1px; width: 100%; margin-top: 20px; width: 700px;"></div>

                @yield('content')

                <div style="border-top: #CCC solid 1px; width: 100%; margin-top: 60px; width: 700px;"></div>

                <table width="700" style="width: 700px !important;">
                    <tr>
                        <td style="text-align: center; padding: 10px 0;">
                            Rowa Druk & Media | Molenvaart 357a | 1764 AR Breezand | T 0223 52 1280
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>
