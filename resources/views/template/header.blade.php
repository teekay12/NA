<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="{{ asset('/css/ico/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/custom.css') }}"/>
    </head>
    <body class="text-center">
        <div class="cover-container d-flex h-200 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                <h3 class="masthead-brand">Nourishing Africa</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link {{ $page == 'home' ? 'active' : '' }}" href="/">Home</a>
                    <a class="nav-link {{ $page == 'userlogin' ? 'active' : '' }}" href="{{ route('userlogin') }}">User Login</a>
                    <a class="nav-link {{ $page == 'userregister' ? 'active' : '' }}" href="{{ route('userregister') }}">User Signup</a>
                </nav>
                </div>
            </header>