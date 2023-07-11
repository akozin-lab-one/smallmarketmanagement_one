<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.0/cerulean/bootstrap.min.css" integrity="sha512-PAOyjTswfBAZ1fUNWJ8Ct+5DJCTncB+7cLhppp88N9GCF7lZ4AIDmVTKVQFYIVZwH5Y0KAP/16+lsyFmhbc4Tg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main>
        <div class="container">
            <h1 class="text-center">Forget Password Email</h1>

            <p class="text-center">You can reset password from bellow link:</p>
            <a href="{{ route('reset.password.get', $token) }}" class="btn btn-success text-decoration-none">Reset Password</a>
        </div>
    </main>
</body>
</html>
