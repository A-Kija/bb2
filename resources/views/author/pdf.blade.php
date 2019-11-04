<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$author->surname}}</title>
    <style>
        @font-face {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: 400;
        src: url({{ asset('fonts/Roboto-Regular.ttf') }});
        }
        @font-face {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: bold;
        src: url({{ asset('fonts/Roboto-Thin.ttf') }});
        }
        body {
            margin: 30px 0 -20px 36px;
        }
        @page { margin: 30px 0 -20px 36px }

        h1 {
            font-family: 'Roboto';
        }
    
        
    </style>
</head>
<body>
    {{$author->name}}
    {{$author->surname}}
    <h1>ĄČĘĖĮŠŲŪ</h1>
</body>
</html>