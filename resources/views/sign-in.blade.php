<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name') }}</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="/favicon.ico" />
    <style>
        html, body {
          height: 100%;
        }

		.sign-in {
          border: 1px solid #e8e8e8;
		  border-radius: 4px;
		  overflow: hidden;
		  width: 28em;
		  min-width: 300px;
		  margin: 100px auto;
		  height: auto;
		}

        .form-signin {
          max-width: 330px;
          padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
          z-index: 2;
        }

        .form-signin input[type="email"] {
          margin-bottom: -1px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
        }

    </style>
  </head>
  <body class="bg-body-tertiary sign-in">
    <header class="mt-3 mb-4 text-center">
      <img src="/logo-black.svg" alt="{{ config('app.name') }}" width="72" height="57" />
    </header>
    <main class="bg-body py-3">
      <div class="container-fluid">
        <div class="row mb-2">
          <h4>Please sign in</h4>
        </div>
        <div class="row">
          <form method="post">
            @csrf
            <input type="email" name="email" class="form-control mb-2" placeholder="E-mail">
            <input type="password" name="password" class="form-control mb-2" placeholder="Password">
            <button class="btn btn-primary w-100 my-4" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </main>
    <footer>
      <p class="m-0 p-3 pt-2 bg-body text-body-secondary">&copy; 2023 {{ config('app.name') }}</p>
    </footer>
  </body>
</html>