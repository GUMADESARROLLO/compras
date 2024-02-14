@extends('layouts.plantilla')
@section('metodosjs')
@include('jsViews.js_payrolls')
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
              <div class="d-flex mb-4"><span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-300"></i><i class="fa-inverse fa-stack-1x text-primary fas fa-donate"></i></span>
                <div class="col">
                  <h5 class="mb-0 text-primary position-relative"><span class="bg-200 dark__bg-1100 pe-3">Nóminas </span><span class="border position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span></h5>
                  <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing .</p>
                </div>|
              </div>
              <div class="card theme-wizard mb-5">
                <div class="card-header bg-light pt-2 pb-2">
                 
                </div>
                <div class="card-body ">
                  <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel"  id="id_tab_requests">

                      <div id="table" data-list='{"valueNames":["path"],"page":10,"pagination":true,"fallback":"pages-table-fallback"}'>
                        <div class="row flex-between-center">
                          <div class="col-auto col-sm-12 col-lg-12 mb-3">
                            <div class="input-group">
                              <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" />
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
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="path">Nóminas</th>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="dtIni">Desde</th>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="dtEnd">Hasta</th>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="vlVaca">Neto a Pagar</th>
                                  <th class="sort pe-1 align-middle white-space-nowrap" data-sort="vlEstatus">Estatus.</th>
                                  <th class="sort pe-card align-middle white-space-nowrap text-end" data-sort="exitRate">Acciones</th>
                                </tr>
                              </thead>
                              <tbody class="list">
                                
                                @foreach($Payrolls as $p)
                                <tr class="btn-reveal-trigger">                                  
                                  <td class="align-middle white-space-nowrap path">
                                      <div class="d-flex align-items-center position-relative">
                                     
                                      <div class="flex-1">
                                          <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900" href="EditPayrolls/{{$p->id_payrolls}}">1Q-Jun-00</a></h6>
                                          <p class="text-500 fs--2 mb-0">{{$p->Company->company_name}} |  {{$p->Type->payroll_type_name}}</p>
                                      </div>
                                      </div>
                                  </td>
                                  <td class="align-middle white-space-nowrap path">{{ Date::parse($p->start_date)->format('D, M d, Y')  }} </td>
                                  <td class="align-middle white-space-nowrap path">{{ Date::parse($p->end_date)->format('D, M d, Y')}} </td>
                                  <td class="align-middle white-space-nowrap path"><a class="text-primary fw-semi-bold" href="#!">C$ 500,000.00</a></td>
                                  <td>
                                    <span class="badge badge rounded-pill d-block p-2 {{$p->Status->status_color}}">{{$p->Status->payroll_status_name}}<span class="ms-1 {{$p->Status->status_icon}}" data-fa-transform="shrink-2"></span>
                                  </span>
                                  <td class="align-middle white-space-nowrap views text-end">
                                  <div>
                                      <button class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onClick="edit_request({{$p}})"><span class="text-500 fas fa-lock-open"></span></button>
                                      <button class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onClick="edit_request({{$p}})"><span class="text-500 fas fa-edit"></span></button>
                                      <button class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover"  onClick="Remover({{$p->id_playrolls}},3)"><span class="text-500 fas fa-trash-alt"></span></button>
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
                  <h5 class="modal-title">Nueva Nómina</h5>
                  <button class="btn-close me-n1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-card">
                   <div class="row g-3">
                    
                      <div class="col-md-12 mb-3">
                        <label class="fs-0" for="eventValDay">Unidad de negocio</label>
                        <div class="input-group"><span class="input-group-text "><span class="far fa-clipboard"></span></span>
                          <select class="form-select" id="payroll_commpany" name="label">                      
                              @foreach($Company as $c)
                              <option value="{{$c->id_compy}}"> {{$c->company_name}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div> 

                      <div class="col-md-12 mb-3">
                        <label class="fs-0" for="eventValDay">Tipo de Nóminas</label>
                        <div class="input-group"><span class="input-group-text "><span class="far fa-clipboard"></span></span>
                          <select class="form-select" id="payroll_type" name="label">                      
                            @foreach($PayRollType as $t)
                            <option value="{{$t->id_payroll_type}}"> {{$t->payroll_type_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>  
                      
                      <div class="col-md-12 mb-3">
                        <label class="fs-0" for="eventStartDate">Inicia</label>
                        <div class="input-group"><span class="input-group-text "><span class="far fa-calendar-alt"></span></span>
                          <input class="form-control datetimepicker" id="payroll_date_ini" type="text" required="required" name="startDate" placeholder="yyyy/mm/dd" data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                        </div>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label class="fs-0" for="eventEndDate">Termina</label>
                        <div class="input-group"><span class="input-group-text "><span class="far fa-calendar-alt"></span></span>
                          <input class="form-control datetimepicker" id="payroll_date_end" type="text" name="endDate" placeholder="yyyy/mm/dd" data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                        </div>
                      </div>
                      
                      <div class="col-md-6 mb-3">
                        <label class="fs-0 " for="eventValDay">INSS Patronal </label>                    
                        <div class="input-group"><span class="input-group-text "><span class="fas fa-donate"></span></span>
                            <input class="form-control" id="payroll_inss_patronal" type="text" name="cant_day" disabled="" placeHolder="0.00" value="{{$Inactec->inatec_value}}">
                          </div>
                      </div>
                      
                      <div class="col-md-6 mb-3">
                        <label class="fs-0 " for="eventValDay">INATEC</label>                    
                        <div class="input-group"><span class="input-group-text "><span class="fas fa-donate"></span></span>
                            <input class="form-control" id="payroll_inactec" type="text" name="cant_day" disabled="" placeHolder="0.00" value="{{$InssParonal->inss_patronal_value}}">
                          </div>
                      </div>

                      <div class="mb-3">
                        <label class="fs-0" for="eventDescription">Observacion:</label>
                        <textarea class="form-control" rows="3" name="description" id="payroll_observation" ></textarea>
                      </div>

                    </div>                  
                </div>
                <div class="card-footer d-flex justify-content-end align-items-center bg-light">
                  <button class="btn btn-primary px-4" type="text" id="btn_save_payroll">Crear</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </main>

        

@endsection('content')