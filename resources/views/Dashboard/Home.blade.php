@extends('layouts.plantilla')
@section('metodosjs')
@include('jsViews.js_dashboard')
@endsection
@section('content')

<!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
    @include('layouts.nav-vertical')
      <div class="container-fluid mt-7" data-layout="container">
        <div class="content">
        <div class="row g-3 mb-3">
            <div class="col-xxl-12">       
              <div class="row g-3">
                <div class="col-sm-6 col-md-3">
                  <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card" style="background-image:url(images/theme_gumadesk/spot-illustrations/corner-1.png);">
                    </div>
                    <div class="card-body position-relative">
                      <h6>Indicador<span class="badge badge-soft-warning rounded-pill ms-2">0.00%</span></h6>
                      <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning" >0.00</div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card" style="background-image:url(images/theme_gumadesk/spot-illustrations/corner-2.png);">
                    </div>
                    <div class="card-body position-relative">
                      <h6>Indicador<span class="badge badge-soft-info rounded-pill ms-2">0.0%</span></h6>
                      <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info">0.00</div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card" style="background-image:url(images/theme_gumadesk/spot-illustrations/corner-3.png);">
                    </div>
                    <div class="card-body position-relative">
                      <h6>Indicador<span class="badge badge-soft-success rounded-pill ms-2">0.00%</span></h6>
                      <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif">0.00</div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card" style="background-image:url(images/theme_gumadesk/spot-illustrations/corner-2.png);">
                    </div>
                    <div class="card-body position-relative">
                      <h6>Indicador<span class="badge badge-soft-info rounded-pill ms-2">0.0%</span></h6>
                      <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info">0.00</div>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
     
            <div class="col-xxl-3 col-md-6 col-lg-3">
                <div class="card shopping-cart-bar-min-height h-100">
                    <div class="card-header d-flex flex-between-center">
                    <h6 class="mb-0">Acumulacion por Departamento</h6>
                    <div class="dropdown font-sans-serif btn-reveal-trigger invisible">
                        <button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-shopping-cart-bar" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-shopping-cart-bar"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                        </div>
                    </div>
                    </div>
                    <div class="card-body py-0 d-flex align-items-top h-100">
                    <div class="flex-1">

                        @foreach($Department as $d)

                        <div class="row g-0 align-items-center pb-3">
                          <div class="col pe-4">
                            <div class="d-flex position-relative">
                                <div class="flex-1">
                                  <a class="stretched-link" href="#!">
                                    <h6 class="text-800 mb-0">{{$d->department_name}}</h6>
                                  </a>
                                  <p class="mb-0 fs--2 text-500">{{$d->Company->company_name}}</p>
                                </div>
                            </div>
                            
                            <div class="progress" style="height:5px">
                              <div class="progress-bar rounded-3 bg-primary" 
                                  role="progressbar" 
                                  style="width: 5% " 
                                  aria-valuenow="5" 
                                  aria-valuemin="0" 
                                  aria-valuemax="100">
                              </div>
                            </div>
                          </div>

                          <div class="col-auto text-end">
                            <p class="mb-0 text-900 font-sans-serif"><span class="me-1 fas fa-caret-up text-success"></span>{{number_format($d->sumVacationBalance(),2)}}</p>
                            <p class="mb-0 fs--2 text-500 fw-semi-bold"><span class ="text-600">0.00</span> % </p>
                          </div>
                        </div>
                        @endforeach

                        

                        
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-md-6 col-lg-9">
               <div class="card h-100" id="table" data-list='{"valueNames":["path"],"page":5,"pagination":true,"fallback":"pages-table-fallback"}'>
                <div class="card-header">
                  <div class="row flex-between-center">
                    <div class="col-auto col-sm-6 col-lg-7">
                      <h6 class="mb-0 text-nowrap py-2 py-xl-0">Solicitudes generales</h6>
                    </div>
                    <div class="col-auto col-sm-6 col-lg-5">
                      <div class="h-100">
                        <form>
                          <div class="input-group">
                            <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar" aria-label="search" />
                            <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body px-0 py-0">
                  <div class="table-responsive scrollbar">
                    <table class="table fs--1 mb-0 overflow-hidden">
                      <thead class="bg-200 text-900">
                        <tr>
                          <th class="sort pe-1 align-middle white-space-nowrap" data-sort="path">Colaborador</th>
                          <th class="sort pe-1 align-middle white-space-nowrap text-end" data-sort="views">Inicia</th>
                          <th class="sort pe-1 align-middle white-space-nowrap text-end" data-sort="time">Finaliza</th>
                          <th class="sort pe-card align-middle white-space-nowrap text-end" data-sort="int">Reintegra</th>
                          <th class="sort pe-card align-middle white-space-nowrap text-end" data-sort="stado">Estado</th>
                          <th class="sort pe-card align-middle white-space-nowrap text-end" data-sort="exitRate">Dias</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                      @foreach($RequestsVacation as $rv)
                        <tr class="btn-reveal-trigger">
                          <td class="align-middle white-space-nowrap path">
                            <div class="d-flex align-items-center position-relative">
                              
                              <div class="avatar avatar-3xl">
                                <img class="rounded-circle" src="{{ isset($rv->Employee->path_image) ? Storage::disk('s3')->temporaryUrl($rv->Employee->path_image, now()->addMinutes(5)) : '/images/user/avatar-4.jpg' }}" />

                              </div>
                              <div class="flex-1 ms-3">
                                <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900" href="EditEmployee/{{$rv->employee_id}}">{{$rv->Employee->first_name}} {{$rv->Employee->last_name}}</a></h6>
                                <p class="text-500 fs--2 mb-0">{{$rv->Employee->Position->Department->Company->company_name}} | {{$rv->Employee->Position->Department->department_name}} | {{$rv->Employee->Position->position_name}}</p>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle white-space-nowrap path">{{ Date::parse($rv->start_date)->format('D, M d, Y')  }} </td>
                          <td class="align-middle white-space-nowrap path">{{ Date::parse($rv->end_date)->format('D, M d, Y')}} </td>
                          <td class="align-middle white-space-nowrap path">{{Date::parse($rv->return_date)->format('D, M d, Y')}} </td>
                          <td class="align-middle white-space-nowrap text-end">
                            <span class="badge badge rounded-pill d-block p-2 {{$rv->Status->status_color}}">{{$rv->Status->status_name}}<span class="ms-1 {{$rv->Status->status_icon}}" data-fa-transform="shrink-2"></span></span>
                        </td>
                          <td class="align-middle text-end ">{{$rv->requested_days}}</td>
                        </tr>
                        @endforeach 
                      </tbody>
                    </table>
                  </div>
                  <div class="text-center d-none" id="pages-table-fallback">
                    <p class="fw-bold fs-1 mt-3">Sin Resultado</p>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row align-items-center">
                    <div class="pagination d-none"></div>
                    <div class="col">
                      <p class="mb-0 fs--1"><span class="d-none d-sm-inline-block me-2" data-list-info="data-list-info"></span></p>
                    </div>
                    <div class="col-auto d-flex">
                      <button class="btn btn-sm btn-primary" type="button" data-list-pagination="prev"><span>Anterior</span></button>
                      <button class="btn btn-sm btn-primary px-4 ms-2" type="button" data-list-pagination="next"><span>Siguiente</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        
          
      
        
      </div>
    </main>

        

@endsection('content')