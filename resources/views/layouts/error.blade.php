<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') </title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pages/error.css')}}">
</head>

<body>
    <div id="error">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2 text-center">
                <img class="img-error" src="@yield('img-url')" alt="@yield('error-title')">
                <div class="text-center">
                    <h1 class="error-title">@yield('error-title')</h1>
                    <p class='fs-5 text-gray-600'>@yield('error-desc')</p>
                    <a href="{{url()->previous()}}" class="btn btn-lg btn-outline-primary mt-3 mb-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>