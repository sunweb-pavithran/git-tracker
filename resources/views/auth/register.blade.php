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
.git-name{
  cursor: pointer;
}
.git-name:hover{
  background: #d3d3d3;
}
.search-results{
  max-width: 300px;
  width: 100%;
  max-height: 300px;
  overflow-y: scroll;
}
</style>
<body>
  <form class="splash-container"  method="POST" action="{{ route('register') }}">
    @csrf
      <div class="card">
          <div class="card-header">
              <h3 class="mb-1">Registrations Form</h3>
              <p>Please enter your user information.</p>
          </div>
          <div class="card-body">
              <div class="form-group">
                  <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" required="" placeholder="Name" autocomplete="off">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="form-group">
                  <input id="git_username" class="form-control form-control-lg @error('git_username') is-invalid @enderror" type="text" name="git_username" required="" placeholder="Github username" autocomplete="off">
                    @error('git_username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <img width="20" height="20" id="loading" src="{{asset('images/spinner.gif')}}" alt="" style="display:none;">
                    <div class="search-results" style="display:none;border: 1px solid #d3d3d3;position:absolute;background: #fff;">
                      <button class="btn btn-light btn-close btn-xs" type="button" name="button">X</button>
                    </div>
              </div>
              <div class="form-group">
                  <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" required="" placeholder="E-mail" autocomplete="off">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="form-group">
                  <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="pass1" type="password" name="password" required="" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="form-group">
                  <input class="form-control form-control-lg" required="" name="password_confirmation" placeholder="Confirm">
              </div>
              <div class="form-group pt-2">
                  <button class="btn btn-block btn-primary" type="submit">Register My Account</button>
              </div>
              {{-- <div class="form-group">
                  <label class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox"><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
                  </label>
              </div> --}}
          </div>
          <div class="card-footer bg-white">
              <p>Already member? <a href="{{url('login')}}" class="text-secondary">Login Here.</a></p>
          </div>
      </div>
  </form>
  <script type="text/javascript">
  //setup before functions
  var typingTimer;                //timer identifier
  var doneTypingInterval = 1000;  //time in ms (5 seconds)

  //on keyup, start the countdown
  $('#git_username').keyup(function(){
      clearTimeout(typingTimer);
      if ($('#git_username').val()) {
          typingTimer = setTimeout(doneTyping, doneTypingInterval);
      }else{
        clearField()
        loading(0)
      }
  });

  //user is "finished typing," do something
  function doneTyping () {
    var text = $('#git_username').val()
    loading(1)
    $.ajax({
      url: '{{url('get-usernames')}}',
      type: 'POST',
      data: {'_token':'{{csrf_token()}}', 'text': text},
      success: function(data){
        loading(0)
        $('.search-results').empty()
        if(text !== ''){
          $.each(data.users, function(k,v){
            $('.search-results').append('<p class="git-name" data-name="'+v.login+'">'+v.login+'</p>')
          })
          $('.search-results').css('display', 'inline')
        }else{
          $('.search-results').css('display', 'none')
        }
      }
    })
  }
  function clearField(){
    $('.search-results').empty()
    $('.search-results').css('display', 'none')
  }
  $('.btn-close').on('click', function(){
      clearField()
  })

  $('.search-results').on('click', '.git-name', function(){
    var name = $(this).data('name')
    $('#git_username').val(name)
    clearField()
  })

  function loading(status){
    switch (status) {
      case 1:
        $('#loading').css('display', 'inline')
        break;
      case 0:
        $('#loading').css('display', 'none')
        break;
      default:

    }
  }
  </script>
</body>
</html>
