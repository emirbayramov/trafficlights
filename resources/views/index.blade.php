<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Traffic Lights</title>
    <script>
        var start_at = '{{ $start_at }}';
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<div class="container">
    <div class="container">
        <div class="red light selected">
        </div>
        <div class="yellow light">
        </div>
        <div class="green light">
        </div>
        <div >
            <button id="button">Вперед!</button>
        </div>
        <div class="message">

        </div>
    </div>
</div>
</body>
</html>
