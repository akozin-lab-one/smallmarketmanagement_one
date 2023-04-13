<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.2.3/dist/cerulean/bootstrap.min.css">

</head>
<body>
    <section class="container-fluid">
        <div class="row align-items-center d-flex">
            <div class="col-md-6 offset-md-3 p-5">

                @yield('myContent')
            </div>
        </div>
    </section>
</body>
</html>
