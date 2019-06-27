<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('includes.header')
<style>
html,
body {
    height: 100%;
}

body {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
}
</style>
<body>
  <div class="splash-container">
      <div class="card ">
          <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="{{asset('images/sunweb.png')}}" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
          <div class="card-body">
              <form action="{{ route('login') }}"  method="POST">
                @csrf
                  <div class="form-group">
                      <input class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" id="username" type="email" placeholder="Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-group">
                      <input class="form-control form-control-lg  @error('password') is-invalid @enderror" name="password" id="password" type="password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-group">
                      <label class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                      </label>
                  </div>
                  <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
              </form>
          </div>
          <div class="card-footer bg-white p-0  ">
              <div class="card-footer-item card-footer-item-bordered">
                  <a href="{{url('register')}}" class="footer-link">Create An Account</a></div>
              <div class="card-footer-item card-footer-item-bordered">
                  <a href="#" class="footer-link">Forgot Password</a>
              </div>
          </div>
      </div>
  </div>
</body>
</html>
