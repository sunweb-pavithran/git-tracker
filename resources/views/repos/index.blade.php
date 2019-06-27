@extends('layouts.app')

@section('content')
  <h4>List of all your repositories</h4>
  <hr>
  <div class="row repo-display">
    {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="mb-0">Card Header</h4>
                <div class="dropdown ml-auto">
                    <a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-dots-vertical"></i>  </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div> --}}
    <img id="loading" width="50" height="50" src="{{asset('images/spinner.gif')}}" alt="" style="display:none;">
  </div>

  <script type="text/javascript">
  $(document).ready(function(){
    getRepos()
    function getRepos(){
      $('#loading').css('display', 'inline')
      var name = '{{Auth()->user()->git_username}}'
      $.ajax({
        url: '{{url('get-user-repos')}}',
        type: 'POST',
        data: {'_token':'{{csrf_token()}}','name':name},
        success: function(data){
          $('#loading').css('display', 'none')
          $.each(data, function(k,v){
            $('.repo-display').append('<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">'
                                        +'<div class="card">'
                                          +'<div class="card-header d-flex">'
                                            +'<h4 class="mb-0">'+v.full_name+'</h4>'
                                            +'<div class="dropdown ml-auto">'
                                              +'<a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-dots-vertical"></i>  </a>'
                                              +'<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">'
                                                +'<a class="dropdown-item" href="#">Action</a>'
                                              +'</div>'
                                            +'</div>'
                                          +'</div>'
                                          +'<div class="card-body">'
                                            +'<p class="card-text">'+v.description+'</p>'
                                            +'<a href="#" class="btn btn-primary">Go somewhere</a>'
                                          +'</div>'
                                        +'</div>'
                                      +'</div>')
          })

        }
      })
    }
  })
  </script>
@endsection
