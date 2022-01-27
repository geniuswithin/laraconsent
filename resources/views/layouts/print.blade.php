<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('metaTitle')</title>

    <meta name="description" content="@yield('description')">
    <meta name="author" content="@yield('author')">
    <meta name="keywords" content="@yield('keywords')">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">

    <style>
		@font-face {
			font-family: "Tahoma";
			src: local("Tahoma"), url("{{ asset('fonts/Tahoma.ttf') }}") format("truetype");
			font-weight: normal;
			font-style: normal;
		}
    </style>
</head>

<body>
    @yield('content')
</body>
</html>