@props(['subject'])
<!doctype html>

<head>
    <style>
        table{
            width: 85%;
            margin: auto;
        }
        body {
            background-color:#212121;
            font-family: Open Sans, sans-serif;
            color:#E0E0E0;
        }

        td {
            height: 100px;
            width: 160px;
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <title>Flashcards - {{ $subject }} </title>
</head>

<body>

        {{ $slot }}


</body>
