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
        <a class="navbar-brand" href="/" style="color:#EC5341!important;font-size: 24px;" style="font-family: cursive;"> <img src="/images/logo.PNG" width="50px" /> GED ENSIAS</a>
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
                      
                      <h4>
                        {{ __('REQUEST PASSWORD RESET') }}
                      </h4>
                     <br>
                       <!-- Session Status -->
                     <x-auth-session-status class="mb-4" :status="session('status')" />

                      <!-- Validation Errors -->
                     <x-auth-validation-errors class="mb-4" :errors="$errors" />

                     <form method="POST" action="{{ route('users.login') }}">
                      @csrf
                     
                        
                       
      
      
                      <div class="form-outline mb-4">
                        <input type="email" name="email" id="form3Example8" class="form-control form-control-lg" :value="old('email')" required autofocus />
                        <label class="form-label" for="form3Example8">E-Mail</label>
                      </div>           
                     
                     
                          

                            <button type="submit" class="btn btn-dark" style="background-color: #EC5341!important"  ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                              <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                            </svg> SEND</button>
                          
    
                      
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