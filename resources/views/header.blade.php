<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Movie library</title>


<script src="{{ App::make('url')->to('/') }}/js/main.js"></script>

<link rel='stylesheet'   href='{{ URL::asset('css/style.css')}}' type='text/css' media='all' />
</head>

<body>
