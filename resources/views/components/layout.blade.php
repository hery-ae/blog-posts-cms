<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@if (auth()->check() && auth()->user()->exists)
    <meta name="api-token" content="{{ auth()->user()->createToken('api-token')->plainTextToken }}">
@endif
    <title>{{ config('app.name') }}</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/datatables/datatables.min.css" rel="stylesheet">
    <link rel="icon" href="/favicon.ico" />
    <style>
      body {
        width: 960px;
      }

      header h1 {
        font-family: \"Playfair Display\", Georgia, \"Times New Roman\", serif
      }

      .pointer {
          cursor: pointer;
      }

    </style>
  </head>
  <body class="mw-100 mx-auto">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between gap-2 py-3">
      <div class="col-auto col-md-3 my-auto">
        <h1 class="h2 my-0 fw-bold"><a href="{{ config('app.url') }}" class="link-dark text-decoration-none">{{ config('app.name') }}</a></h1>
      </div>
      <div class="col-auto col-md-3 text-end d-none d-md-block">
        <a href="{{ route('logout') }}" class="link-secondary">
          Sign out
        </a>
      </div>
    </header>
    <main class="container-fluid mt-3 mb-5">
      <div class="row mb-3">
        <div class="col-12 position-relative px-0">
{{ $slot }}
        </div>
      </div>
    </main>
    <footer class="py-1 bg-body-tertiary position-relative">
      <p class="text-center text-body-tertiary my-2 small">&copy; 2023 {{ config('app.name') }}</p>
    </footer>
  </body>
</html>