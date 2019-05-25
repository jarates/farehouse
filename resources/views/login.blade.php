
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link href="{{asset('/')}}/theme/2018/login/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        
                        <h5 class="font-medium mb-3">Happy Warehouse</h5>

                        @if($errors->any())
                            <div class="alert alert-danger text-center">
                              {{{$errors->first()}}}
                            </div>
                        @endif

                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3" method="post" id="loginform" action="{{url('login')}}">
                                <div class="input-group mb-3">
 
                                    <input name="user_name" type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="admin1">
                                </div>
                                <div class="input-group mb-3">

                                    <input name="user_pass" type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" value="admin@1">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                                            <label class="custom-control-label" for="customCheck1">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 pb-3">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                                    </div>
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
 
            </div>
        </div>

    </div>

    <script src="{{asset('/')}}/theme/2018/bootstrap/dist/js/jquery.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/login/assets/libs/popper.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
        //$(".preloader").fadeOut();
        $('form').append('{!! csrf_field() !!}');
    </script>

</body>

</html>