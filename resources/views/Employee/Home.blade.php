@extends('layouts.plantilla')
@section('metodosjs')
@include('jsViews.js_employee')
@endsection
@section('content')

<!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
    @include('layouts.nav-vertical')
      <div class="container-fluid mt-7" data-layout="container">
        <div class="content">
          
          <div class="card" >
            <div class="card-header">
            <div class="row flex-between-center">
                    <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0"></h5>
                    </div>
                    <div class="col-8 col-sm-auto text-end ps-2">
                        <div id="table-customers-replace-element">
                            <div class="input-group" >
                                <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" id="id_txt_buscar" />
                                <div class="input-group-text bg-transparent">
                                    <span class="fa fa-search fs--1 text-600"></span>
                                </div>
                                <div class="input-group-text bg-transparent" id="btn_upload">
                                    <span class="fas fa-upload fs--1 text-success" ></span>
                                </div>
                                <!-- <div class="input-group-text bg-transparent" id="btn_kardex">
                                    <span class="fas fa-boxes fs--1 text-success" ></span>
                                </div> -->
                                <div class="input-group-text bg-transparent" id="id_btn_new">
                                    <a  href="{{ route('AddEmployee') }}"> <span class="fa fa-plus fs--1 text-600"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive scrollbar">
                <table class="table table-hover table-striped overflow-hidden"  id="tbl_employee">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Contrato</th>
                        <th scope="col">Vacaciones</th>
                        <th class="text-end" scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($Employee as $e)
                        <tr class="align-middle">
                            <td class="align-middle white-space-nowrap path">
                                <div class="d-flex align-items-center position-relative">
                                <div class="avatar avatar-3xl">
                                    <img class="rounded-circle" src="{{ isset($e->path_image) ? Storage::disk('s3')->temporaryUrl($e->path_image, now()->addMinutes(5)) : '/images/user/avatar-4.jpg' }}" />

                                </div>
                                <div class="flex-1 ms-3">
                                    <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900" href="EditEmployee/{{$e->id_employee}}">{{$e->first_name }} {{$e->last_name}}</a></h6>
                                    <p class="text-500 fs--2 mb-0">{{$e->Position->Department->Company->company_name}} | {{$e->Position->Department->department_name}} | {{$e->Position->position_name}}</p>
                                </div>
                                </div>
                            </td>
                            <td class="text-nowrap">{{$e->email }}</td>
                            <td class="text-nowrap">{{$e->phone_number }}</td>
                            <td class="text-nowrap">{{$e->address }}</td>
                            <td><span class="badge badge rounded-pill d-block p-2 badge-soft-success">{{$e->Contract->contract_type_name }} <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                            </td>
                            <td class="text-end">{{number_format($e->vacation_balance,2) }}</td>
                            <td class="text-end">
                            <div>
                                <button class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onClick="Editar({{$e->id_employee}})"><span class="text-500 fas fa-edit"></span></button>
                                <button class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover" onClick="Remover({{$e->id_employee}})"><span class="text-500 fas fa-trash-alt"></span></button>
                            </div>
                            </td>
                        </tr>
                        @endforeach     
                    </tbody>
                </table>
                </div>


            </div>
            <div class="card-footer">
              
            </div>
          </div>
          @include('layouts.footer')
        </div>
        <div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-xl mt-6" role="document">
            <div class="modal-content border-0">
              <div class="modal-header px-5 position-relative modal-shape-header bg-shape-umk">
                <div class="position-relative z-index-1 light">
                  <h4 class="mb-0 text-white" id="id_titulo_modal"> Carga via excel.</h4>
                </div>
                <button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body py-4 px-5 ">
                <div class="row">
                  <div class="col-md-12">                    
                    <div class="input-group">
                        <input class="form-control" id="frm-upload" type=file  name="files[]"/>                    
                        <span class="input-group-text">
                            <a href="{{ asset('doc/plantilla.xlsx') }}"> <span class="fas fa-file-excel fs--1 text-success"></span></a>
                        </span>
                    </div>
                  </div>
                  <div class="row flex-between-center mt-3">
                    <div class="col-auto">
                        <div class="input-group" >                            
                            <div class="input-group-text bg-transparent">
                                <span class="fa fa-search fs--1 text-600"></span>
                            </div>
                            <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" id="id_txt_excel" />
                        </div>
                    </div>

                    <div class="col-auto ">
                        <div class="row g-sm-4">
                        <div class="col-12 col-sm-auto">
                            <div class="pe-4 border-sm-end border-200">
                            <h6 class="fs--2 text-600 mb-1">SKUs Total</h6>
                            <div class="d-flex align-items-center">
                                <h5 class="fs-0 text-900 mb-0 me-2" id="ttSKUs">-</h5><span class="badge rounded-pill badge-soft-primary"> 100%</span>
                            </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                            <div class="pe-4 border-sm-end border-200">
                            <h6 class="fs--2 text-600 mb-1">SKUs Validados</h6>
                            <div class="d-flex align-items-center">
                                <h5 class="fs-0 text-900 mb-0 me-2" id="ttSKUsValido">-</h5><span class="badge rounded-pill badge-soft-success" id="avgValido"> - </span>
                            </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                            <div class="pe-0">
                            <h6 class="fs--2 text-600 mb-1">SKUs Invalidos</h6>
                            <div class="d-flex align-items-center">
                                <h5 class="fs-0 text-900 mb-0 me-2" id="ttSKUsNotValido">-</h5><span class="badge rounded-pill badge-soft-danger" id="avgNotValido"> - </span>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                  <div class="col-md-12 mt-3">
                    <div class="border-table" >                        
                        <table class="table table-hover table-striped overflow-hidden" id="tbl_excel" >
                        <thead>
                            <tr>
                                <th>Articulo</th>
                                <th>Descripcion</th>
                                <th>Unidad</th>
                                <th>Fisica</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        </tbody>
                        </table>  
                    </div>
                  </div>
                  <button class="btn btn-bg-umk btn-primary d-block w-100 mt-3" id="id_send_data_excel" type="submit" name="submit">Cargar</button>
                </div>                                 
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <div class="modal fade" id="modal_kardex" tabindex="-1" >
          <div class="modal-dialog">
            <div class="modal-content border">
              <form autocomplete="off" method="POST" novalidate=""  action="{{ route('Home') }}">@csrf
                <div class="modal-header px-card bg-light border-bottom-0">
                  <h5 class="modal-title">Filtro de Kardex</h5>
                  <button class="btn-close me-n1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-card">
                  <div class="mb-3">
                    <label class="fs-0" for="eventStartDate">Fecha Inicio</label>
                    <input class="form-control datetimepicker" required="" id="eventStartDate" type="text" required="required" name="startDate" value="{{date('Y-m-d', strtotime(date('Y-m-01')))}}" placeholder="{{date('Y/m/d')}}" data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventEndDate">Fecha de Fin</label>
                    <input class="form-control datetimepicker" required="" id="eventEndDate" type="text" name="endDate" value="{{date('Y-m-d')}}" placeholder="{{date('Y/m/d')}}" data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-end align-items-center bg-light">
                  <button class="btn btn-primary px-4" type="submit">Crear</button>
                </div>
              </form>
            </div>
          </div>
        </div>

    <!--OPEN MODALS -->
    <div class="modal fade" id="modal_new_product" tabindex="-1" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header px-5 position-relative modal-shape-header bg-shape-umk">
                    <div class="position-relative z-index-1 light">
                        <h4 class="mb-0 text-white" id="id_lbl_modal_kardex">KARDEX</h4>
                    </div>
                    <button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-card bg-light ">
                    
                    <div class="row">
                        <div class="row flex-between-center">
                            <div class="col-auto">
                                <div class="d-flex align-items-center position-relative mt-0">
                                    <div class="avatar avatar-xl ">
                                        <img class="rounded-circle" src="{{ asset('images/item.png') }}"   />
                                    </div>
                                    <div class="flex-1 ms-3">
                                        <h6 class="mb-0 fw-semi-bold">
                                            <a class="stretched-link text-900 fw-semi-bold" href="#!" >
                                                <div class="stretched-link text-900" id='articulos_header'>Cargando ...</div>
                                            </a>
                                        </h6>
                                        <p class="text-500 fs--2 mb-0"id='articulos_footer'>Cargando ... </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row g-sm-4">
                                    <div class="col-12 col-sm-auto">
                                        <div class="mb-3 pe-4 border-sm-end border-200">
                                            <h6 class="fs--2 text-600 mb-1">Existencia Fisica</h6>
                                            <div class="d-flex align-items-center">
                                                <h5 class="fs-0 text-900 mb-0 me-2" id="id_existencia_actual"> 0.00</h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                
                                
                                <div class="col-12 col-sm-auto">
                                    <div class="mb-3 pe-0">
                                        <h6 class="fs--2 text-600 mb-1">Ultima Modificacion</h6>
                                        <div class="d-flex align-items-center">
                                            <h5 class="fs-0 text-900 mb-0 me-2" id="id_created_at"> --- </h5>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>                
                    
                    <div class="card ms-3">                        
                        <div class="card-body ">
                        <form class="row g-2 needs-validation" novalidate="" method="POST" action="{{ route('Home') }}">
                        @csrf
                        <div class="col-md-12 d-none">
                            <input class="form-control"  type="text" id='art_code' name="art_code" >
                            <input class="form-control"  type="text" id='id_event' name="id_event" >
                            <input class="form-control"  type="text" id='exist_actual' name="exist_actual" >
                        </div>  
                        <div class="row gx-2">
                          <div class="mb-2 col-sm-4">  
                            <label class="form-label" for="art_cant_ingreso">Cantidad</label>                          
                            <input class="form-control" id="art_cant_ingreso" type="text" name='art_cant_ingreso' size=20 maxlength=12 onkeypress='return isNumberKey(event)' required="" placeholder="0.00"/>
                            <div class="invalid-feedback">Ingrese una Cantidad.</div>
                          </div>
                          <div class="mb-2 col-sm-4">
                            <label class="form-label" for="art_cant_ingreso">Jumbos</label>
                            <input class="form-control" id="id_jumbos" type="text" name='cant_jumbos' size=20 maxlength=12 onkeypress='return isNumberKey(event)' required="" placeholder="0.00"/>
                            <div class="invalid-feedback">Ingrese una Cantidad.</div>
                          </div>
                          <div class="mb-2 col-sm-4"> 
                          <label class="form-label" for="art_cant_ingreso">Fecha.</label>                           
                            <div class="input-group" >
                                <input class="form-control" id="id_jumbos" type="date" name='dateEvent' value="{{date('Y-m-d')}}" placeholder="{{date('Y/m/d')}}" />
                            
                                <button class="btn btn-bg-umk btn-primary" type="submit">Guardar</button>
                            </div>
                          </div>
                            <div class="mb-3">
                                <label class="fs-0" for="eventDescription">Observaciones</label>
                                <textarea class="form-control" rows="3" name="observaciones" id="eventDescription"></textarea>
                            </div>
                        </div>
                       
                        
                      </form>
                                                     
                        </div>                        
                    </div>
                    <div class="card mt-3 ms-3" >
                        <div class="card-header">
                            <div class="row flex-between-center">
                                <div class="col-auto col-sm-6 col-lg-7">
                                <h6 class="mb-0 text-nowrap py-2 py-xl-0">Registro de Ingreso & Egresos.</h6>
                                </div>
                                <div class="col-auto col-sm-6 col-lg-5">
                                
                                    <div class="input-group">
                                        <input id="id_range_select" class="form-control form-control-sm datetimepicker ps-4" type="text" data-options='{"mode":"range","dateFormat":"Y-m-d","disableMobile":true}'/>
                                        <div class="input-group-text bg-transparent"><span class="fas fa-calendar-alt text-primary fs--1 "></span></div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row flex-between-center">
                                <div class="col-12">
                                    
                                </div>
                                <div class="col-12">                    
                                    <div class="">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="scrollbar">
                                <table class="table table-bordered table-striped fs--1 mb-0" id="tblRegkardex" style="width:100%">
                                    <thead class="bg-200 text-900">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Ingreso</th>
                                            <th>Egreso</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody ></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    
        <!--CLOSE MODALS -->

        

@endsection('content')