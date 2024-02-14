@extends('layouts.plantilla')
@section('metodosjs')
@include('jsViews.js_requests')
@endsection
@section('content')

<!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
    @include('layouts.nav-vertical')
      <div class="container-fluid mt-7" data-layout="container">
        <div class="content">
          
        <div class="col-lg-12 col-xl-12 col-xxl-12 h-100">
              <div class="d-flex mb-4"><span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-300"></i><i class="fa-inverse fa-stack-1x text-primary fas fa-capsules"></i></span>
                <div class="col">
                  <h5 class="mb-0 text-primary position-relative"><span class="bg-200 dark__bg-1100 pe-3">Solicitudes </span><span class="border position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span></h5>
                  <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing .</p>
                </div>
              </div>
              <div class="card theme-wizard mb-5">
                <div class="card-header bg-light pt-2 pb-2">
                  @if(Auth::User()->role_id == 1)
                  <ul class="nav nav-pills mb-3" role="tablist" id="pill-tab1">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#id_tab_requests" type="button" role="tab"  aria-selected="true"><span class="fas fa-dollar-sign me-2" data-fa-transform="shrink-2"></span><span class="d-none d-md-inline-block fs--1">Solicitudes</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" data-bs-toggle="pill" data-bs-target="#id_tab_tipo" type="button" role="tab" aria-selected="false"><span class="fas fa-building me-2" data-fa-transform="shrink-2"></span><span class="d-none d-md-inline-block fs--1">Tipos</span></button>
                    </li>
                    <li class="nav-item" role="presentation" style="display:none">
                      <button class="nav-link" data-bs-toggle="pill" data-bs-target="#id_tab_estados" type="button" role="tab" aria-selected="false"><span class="fas fa-user-friends me-2" data-fa-transform="down-2 shrink-2"></span><span class="d-none d-md-inline-block fs--1">Estados</span></button>
                    </li>                    
                  </ul>
                  @endif
                </div>
                <div class="card-body ">
                  <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel"  id="id_tab_requests">

                      <div id="table" data-list='{"valueNames":["path"],"page":5,"pagination":true,"fallback":"pages-table-fallback"}'>
                        
                    
                        <div class="row flex-between-center">
                          <div class="col-auto col-sm-12 col-lg-12 mb-3">
                            <div class="input-group">
                              <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" />
                              
                              <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                              

                              <span class="input-group-text"><span class="far fa-calendar-alt"></span></span>
                              <input class="form-control datetimepicker " id="date_ini" type="text" 
                              required="required" name="startDate" 
                              placeholder="yyyy/mm/dd" 
                              data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />

                              <span class="input-group-text "><span class="far fa-calendar-alt"></span></span>
                              <input class="form-control datetimepicker" id="date_ini" type="text" 
                              required="required" name="startDate" 
                              placeholder="yyyy/mm/dd" 
                              data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                              <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                              <div class="input-group-text bg-transparent" id="btn_open_modal_request"><span class="fa fa-plus fs--1 text-600" ></span></div>
                            </div>
                          </div>
                        </div>
                        <div class="px-0 py-0">
                          <div class="table-responsive scrollbar">
                            <table class="table fs--1 mb-0 overflow-hidden">
                              <thead class="bg-200 text-900">
                                <tr>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="path">Nombre</th>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="dtIni">Desde</th>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="dtEnd">Hasta</th>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="dtInte">Integra</th>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="vlVaca">Dias Soli.</th>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="vlEstatus">Estatus.</th>
                                  <th class="sort pe-card align-middle white-space-nowrap text-end" data-sort="exitRate">Acciones</th>
                                </tr>
                              </thead>
                              <tbody class="list">

                                @foreach($RequestsVacation as $rv)
                                <tr class="btn-reveal-trigger">                                  
                                  <td class="align-middle white-space-nowrap path">
                                      <div class="d-flex align-items-center position-relative">
                                      <div class="avatar avatar-3xl ">
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
                                  <td class="align-middle white-space-nowrap path"><a class="text-primary fw-semi-bold" href="#!">{{$rv->requested_days}}</a></td>
                                  <td>
                                    <span class="badge badge rounded-pill d-block p-2 {{$rv->Status->status_color}}">{{$rv->Status->status_name}}<span class="ms-1 {{$rv->Status->status_icon}}" data-fa-transform="shrink-2"></span>
                                  </span>
                                  <td class="align-middle white-space-nowrap views text-end">
                                  <div>
                                      <button class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onClick="edit_request({{$rv}})"><span class="text-500 fas fa-edit"></span></button>
                                      <button class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover"  onClick="Remover({{$rv->id_vacation_request}},3)"><span class="text-500 fas fa-trash-alt"></span></button>
                                  </div>
                                  </td>
                                </tr>
                                @endforeach    
                              </tbody>
                            </table>
                          </div>
                          <div class="text-center d-none" id="pages-table-fallback">
                            <p class="fw-bold fs-1 mt-3">Sin resultado</p>
                          </div>
                        </div>
                        <div class="row mt-3">
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
                    <div class="tab-pane " role="tabpanel"  id="id_tab_tipo">
                      
                      <div id="table" data-list='{"valueNames":["path"],"page":5,"pagination":true,"fallback":"pages-table-fallback"}'>
                        <div class="row flex-between-center">
                          <div class="col-auto col-sm-12 col-lg-12 mb-3">
                            <div class="input-group">
                              <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" />
                              <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                              <div class="input-group-text bg-transparent"><span class="fa fa-plus fs--1 text-600" onClick="MSG('Tipos')"></span></div>
                            </div>
                          </div>
                        </div>
                        <div class="px-0 py-0">
                          <div class="table-responsive scrollbar">
                            <table class="table fs--1 mb-0 overflow-hidden">
                              <thead class="bg-200 text-900">
                                <tr>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="path">Tipos</th>
                                  <th class="sort pe-card align-middle white-space-nowrap text-end" data-sort="exitRate">Acciones</th>
                                </tr>
                              </thead>
                              <tbody class="list">
                                @foreach($RequestTypes as $rt)
                                <tr class="btn-reveal-trigger">
                                  <td class="align-middle white-space-nowrap path"><a class="text-primary fw-semi-bold" href="#!">{{$rt->type_name}}</a></td>
                                  <td class="align-middle white-space-nowrap views text-end">
                                  <div>
                                      <button class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onClick="edit({{$rt}})"><span class="text-500 fas fa-edit"></span></button>
                                      <button class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover" onClick="Remover({{$rt->id_request_type}},1)"><span class="text-500 fas fa-trash-alt"></span></button>
                                  </div>
                                  </td>
                                </tr>
                                @endforeach     
                              </tbody>
                            </table>
                          </div>
                          <div class="text-center d-none" id="pages-table-fallback">
                            <p class="fw-bold fs-1 mt-3">Sin resultado</p>
                          </div>
                        </div>
                        <div class="row mt-3">
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
                    <div class="tab-pane" role="tabpanel"  id="id_tab_estados">

                      <div id="table" data-list='{"valueNames":["path"],"page":5,"pagination":true,"fallback":"pages-table-fallback"}'>
                        <div class="row flex-between-center">
                          <div class="col-auto col-sm-12 col-lg-12 mb-3">
                            <div class="input-group">
                              <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" />
                              <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                              <div class="input-group-text bg-transparent"><span class="fa fa-plus fs--1 text-600" onClick="MSG('Estados')"></span></div>
                            </div>
                          </div>
                        </div>
                        <div class="px-0 py-0">
                          <div class="table-responsive scrollbar">
                            <table class="table fs--1 mb-0 overflow-hidden">
                              <thead class="bg-200 text-900">
                                <tr>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="path">Estados</th>
                                  <th class="sort pe-card align-middle white-space-nowrap text-end" data-sort="exitRate">Acciones</th>
                                </tr>
                              </thead>
                              <tbody class="list">
                                @foreach ($RequestStatus as $rs)
                                <tr class="btn-reveal-trigger">
                                  <td class="align-middle white-space-nowrap path"><a class="text-primary fw-semi-bold" href="#!">{{$rs->status_name}}</a></td>
                                  <td class="align-middle white-space-nowrap views text-end">
                                  <div>
                                      <button class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onClick="edit({{$rs}})"><span class="text-500 fas fa-edit"></span></button>
                                      <button class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover" onClick="Remover({{$rs->id_request_status}},2)"><span class="text-500 fas fa-trash-alt"></span></button>
                                  </div>
                                  </td>
                                </tr>
                                @endforeach     
                              </tbody>
                            </table>
                          </div>
                          <div class="text-center d-none" id="pages-table-fallback">
                            <p class="fw-bold fs-1 mt-3">Sin resultado</p>
                          </div>
                        </div>
                        <div class="row mt-3">
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
                
              </div>
            </div>
        </div>
        <div class="modal fade" id="modal_new_request" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content border">
                <div class="modal-header px-card bg-light border-bottom-0">
                  <h5 class="modal-title">Solicitud de Permiso</h5>
                  <button class="btn-close me-n1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-card"> 
                  
                  <div class="mb-3">
                    <label class="fs-0" for="eventStartDate">Colaborador</label><span id="id_form" class="invisible">0</span>
           
                    <div class="input-group">
                      <select class="js-example-basic-single form-select" id="list_employee" size="1" data-options='{"removeItemButton":true,"placeholder":true}'>
                        <option value="">Lista de Colaboradores...</option> 
                        @foreach($Employee as $e)
                        <option value="{{$e->id_employee}}"> 
                          {{$e->Position->Department->Company->company_name}} | {{$e->first_name}} {{$e->last_name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>    
                               
                  <div class="mb-3">
                    <label class="fs-0" for="eventStartDate">Inicia</label>
                    <div class="input-group"><span class="input-group-text "><span class="far fa-calendar-alt"></span></span>
                      <input class="form-control datetimepicker" id="date_ini" type="text" required="required" name="startDate" placeholder="yyyy/mm/dd" data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventEndDate">Termina</label>
                    <div class="input-group"><span class="input-group-text "><span class="far fa-calendar-alt"></span></span>
                      <input class="form-control datetimepicker" id="date_end" type="text" name="endDate" placeholder="yyyy/mm/dd" data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventReturnDate">Regresa</label>
                    <div class="input-group"><span class="input-group-text "><span class="far fa-calendar-alt"></span></span>
                      <input class="form-control datetimepicker" id="date_return" type="text" name="retunrDate" placeholder="yyyy/mm/dd" data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventValDay">Tipo de Solicitud</label>
                    <div class="input-group"><span class="input-group-text "><span class="far fa-clipboard"></span></span>
                      <select class="form-select" id="list_type" name="label">                      
                        @foreach($RequestTypes as $rt)
                        <option value="{{$rt->id_request_type}}"> {{$rt->type_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <label class="fs-0 " for="eventValDay">Cantidad de dias Solicitados</label>                    
                    <div class="input-group"><span class="input-group-text "><span class="fas fa-hospital-alt"></span></span>
                        <input class="form-control" id="cant_day" type="text" name="cant_day" disabled="" placeHolder="0.00">
                      </div>
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventDescription">Observacion:</label>
                    <textarea class="form-control" rows="3" name="description" id="observation" ></textarea>
                  </div>
                  
                </div>
                <div class="card-footer d-flex justify-content-end align-items-center bg-light">
                <a class="me-3 btn badge-soft-success btn-sm" href="#!"><span class="fas fa-calendar me-2"></span>1 Dia = 1.18</a>
                  <button class="btn btn-primary px-4" type="text" id="btn_save_request">Solcitar</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </main>

        

@endsection('content')