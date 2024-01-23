<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}' dir='{{ config('app.direction') }}'>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <link href="{{ asset('css/font-cairo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    <link href='{{ asset('css/invoice.css') }}' rel='stylesheet'/>
    
</head>

<body>
    <h1 class='header-invoice'>{{ __('site.invoice_product_title') }}</h1>
</body>

</html>
