<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.0/cerulean/bootstrap.min.css" integrity="sha512-PAOyjTswfBAZ1fUNWJ8Ct+5DJCTncB+7cLhppp88N9GCF7lZ4AIDmVTKVQFYIVZwH5Y0KAP/16+lsyFmhbc4Tg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>password-reset</title>
</head>
<body>
<main class="login-form d-flex align-items-center" style="height: 100vh">
  <div class="container">
      <div class="row justify-content-center" >
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header text-center">Reset Password</div>
                  <div class="card-body">

                    @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                      <form action="{{route('password.email')}}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">Email is Required</span>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Send Password Reset Link
                              </button>
                          </div>
                      </form>

                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
</body>
</html>
