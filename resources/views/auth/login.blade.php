<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/register.css">
    <link rel="stylesheet" href="/css/style.css">
    
</head>
<body>
    
    <section class="h-100 bg-light">
        
          <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="/" style="color: #EC5341; font-weight:600;font-size: 24px;"> <img src="/images/logo.PNG" width="50px"/> GED ENSIAS</a>
          </nav>
          
         

        <div class="container">

            
          <div class="row d-flex justify-content-center align-items-center ">
            <div class="col">
              <div class="card card-registration my-4">
                <div class="row g-0">
                  <div class="col-xl-5 d-none d-xl-block">
                    <img src="/images/login.jpg"
                      alt="Sample photo" class="img-fluid"
                      style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                     
                  </div>
                  <div class="col-xl-6">
                    <div class="card-body p-md-5 text-black">
                      
                      
                      <h3 class="mb-5 text-uppercase">LOGIN</h3>
                     
                     <p>Une nouvelle manière de gérer vos documents</p>

                     <x-auth-session-status class="mb-4" :status="session('status')" />
                     <x-auth-validation-errors class="mb-4" :errors="$errors" />


                     <form method="POST" action="{{ route('login') }}">
                      @csrf
                     
                    
      
      
                      <div class="form-outline mb-4">
                        <input type="email" name="email" id="form3Example8" class="form-control form-control-lg" :value="old('email')" required autofocus />
                        <label class="form-label" for="form3Example8">E-Mail</label>
                      </div>


                      <div class="form-outline mb-4">
                        <input type="password" name="password" id="form3Example8" class="form-control form-control-lg" required autocomplete="current-password" />
                        <label class="form-label" for="form3Example8">Mot de passe </label>
                      </div>                 
                     
                      


                      <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <div class="d-flex justify-content-end pt-3">
                            <button type="submit" style="background-color: #EC5341" class="btn btn-dark" >LOGIN</button>
                          </div>
                    </div>
                </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>