
@php
$id= Auth::user()->type;	
@endphp
@if($id != 1)
<h2>Access Denied</h2>
@else
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mastercard</title>
</head>
<body>
    @php
        $widht= request("widht", '100%');
        $height= request("height", '800px');
    @endphp
    <iframe src="https://www.gamapp.in/games/mc/public/?sessionid=7972" frameborder="0" width="{{$widht}}" height="{{$height}}"></iframe>
</body>
</html>
@endif
