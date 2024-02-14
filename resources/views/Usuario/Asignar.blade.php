@extends('layouts.plantilla')
@section('metodosjs')
@include('jsViews.js_asignar')
@endsection
@section('content')

<!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
    @include('layouts.nav-vertical')
      <div class="container-fluid mt-7" data-layout="container">
        <div class="content">
          <!-- INICIO DEL FORM DE AGREGAR -->
          <div class="col-lg-12 col-xl-12 col-xxl-12 h-100">
              <div class="d-flex mb-4"><span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-300"></i><i class="fa-inverse fa-stack-1x text-primary fas fa-user"></i></span>
                <div class="col">
                  <h5 class="mb-0 text-primary position-relative"><span class="bg-200 dark__bg-1100 pe-3">Asignar </span><span class="border position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span></h5>
                  <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing . <span id="Id_User" class="invisible"> {{$id_employee}} </span></p>
                </div>
              </div>
          </div>
          <!-- FIN DEL FORM DE AGREGAR -->
          <div class="row mt-3">
            <div class="col">
              <div class="card overflow-hidden">
                <div class="card-header d-flex flex-between-center bg-light py-2">
                  <h6 class="mb-0">Colaboradores asignados</h6>
                  <div class="dropdown font-sans-serif btn-reveal-trigger">
                    <div class="input-group">
                      <select class="js-example-basic-single form-select" id="edtEmployee" size="1" data-options='{"removeItemButton":true,"placeholder":true}'>
                        <option value="">Lista de Colaboradores...</option> 
                        @foreach($Employee as $e)
                        <option value="{{$e->id_employee}}"> 
                          {{$e->Position->Department->Company->company_name}} | {{$e->first_name}} {{$e->last_name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-body py-0">
                  <div class="table-responsive scrollbar">
                    <table class="table table-dashboard mb-0 fs--1">
                      @foreach($Assigned as $a)
                      <tr>
                        <td class="align-middle ps-0 text-nowrap">
                          <div class="d-flex position-relative align-items-center">
                            <img class="d-flex align-self-center me-2" src="{{ isset($a->path_image) ? Storage::disk('s3')->temporaryUrl($a->path_image, now()->addMinutes(5)) : '/images/user/avatar-4.jpg' }}" alt="" width="70" />
                            <div class="flex-1"><a class="stretched-link" href="#!">
                                <h6 class="mb-0">{{$a->first_name}} {{$a->last_name}}</h6>
                              </a>
                              <p class="mb-0">{{$a->Position->Department->Company->company_name}}</p>
                            </div>
                          </div>
                        </td>                        
                        <td class="align-middle ps-4 pe-1" style="width: 130px; min-width: 130px;">
                          <div>
                              <button class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover" onClick="Remover({{$a->id_employee}})"><span class="text-500 fas fa-trash-alt"></span></button>
                          </div>
                        </td>
                      @endforeach
                    </table>
                  </div>
                </div>
                <div class="card-footer bg-light py-2">
                  <div class="row flex-between-center">
                    <div class="col-auto">
                      
                    </div>
                    <div class="col-auto">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
      </div>
    </main>

        

@endsection('content')