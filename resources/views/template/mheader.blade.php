<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('/ico/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/mcustom.css') }}"/>
    
    <title>Nourishing Africa</title>

  </head>

  <body>

    <header>
      <div class="navbar navbar-dark bg-white shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="{{ route('userdash') }}" class="navbar-brand d-flex align-items-center">
            <strong class="text-dark">Nourishing Africa</strong>
          </a>
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My Menu
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalLong">Profile</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Change Password</a>
                <a class="dropdown-item" href="{{ route('logout') }}" >Log out</a>
            </div>
          </div>
        </div>
      </div>
    </header>
