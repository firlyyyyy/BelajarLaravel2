<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpustakaan Sekolah</title>

    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/js/bootstrap.js"></script>
</head>

<body>
    <div class="container" style="background: #ccc">
        <div class="alert alert-info text-center">
            <h4 style="margin-bottom: 0px"><b>Selamat Datang</b> di Perpustakaan Sekolah</h4>
        </div>
        @include('menu')
        @include('banner')
        @include('sidebar')
        @include('konten')
        @include('footer')
    </div>
</body>

</html>
