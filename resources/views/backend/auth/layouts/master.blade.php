<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title') | Blog</title>
    <link href="{{ asset('backend/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('auth/style.css') }}" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="container-fluid g-0 main-body">
      <div class="auth-section">
      <div class="card">
        <div class="card-header">
          <h4>@yield('page_title')</h4>
        </div>
        <div class="card-body">
          @yield('content')
        </div>
      </div>
    </div>
    </div>

    {{-- <section class="vh-100 gradient-custom wrapper">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              @yield('content')
            </div>
          </div>
        </div>
    </section> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>