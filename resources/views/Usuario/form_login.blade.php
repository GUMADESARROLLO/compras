@extends('layouts.plantilla')
@section('content')    
<main class="main" id="top">
      <div class="container-fluid">
       
        <div class="row min-vh-100 bg-100">
          <div class="col-6 d-none d-lg-block position-relative">
            <div class="bg-holder" style="background-image:url(images/bg-03.jpg);background-position: 50% 20%;">
            </div>
            <!--/.bg-holder-->
            
          </div>
          <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
            <div class="row justify-content-center g-0">
              <div class="col-lg-9 col-xl-8 col-xxl-6">
                <div class="card">
                  <div class="card-header bg-circle-shape bg-shape-umk text-center p-2">
                    <a class="font-sans-serif fw-bolder fs-4 z-index-1 position-relative link-light light" href="!#"> COMPRAS</a></div>
                  <div class="card-body p-4">
                    <div class="row flex-between-center">
                      <div class="col-auto">
                        <h3>Acceso</h3>
                      </div>
                      <div class="col-auto fs--1 text-600"><span class="mb-0 fw-semi-bold">developed by </span> <span><a href="#!">TI 2024</a></span></div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                      <div class="mb-3">
                        <label class="form-label" for="username">Usuario</label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Usuario del sistema">
                        @error('username')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                      </div>
                      <div class="mb-3">
                      <div class="d-flex justify-content-between">
                            <label class="form-label" for="card-password">Contraseña</label>
                          </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                      </div>
                      <div class="row flex-between-center invisible">
                        <div class="col-auto">
                          <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" id="split-checkbox" />
                            <label class="form-check-label mb-0" for="split-checkbox">Remember me</label>
                          </div>
                        </div>
                        <div class="col-auto"><a class="fs--1" href="../../../pages/authentication/split/forgot-password.html">Forgot Password?</a></div>
                      </div>
                      <div class="mb-3">
                        <button class="btn  btn-bg-umk btn-primary d-block w-100 mt-3" type="submit" name="submit">{{ __('ACCEDER') }}</button>
                      </div>
                    </form>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection
