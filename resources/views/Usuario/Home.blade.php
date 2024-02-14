@extends('layouts.plantilla')
@section('metodosjs')
@include('jsViews.js_usuario')
@endsection
@section('content')

<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main" id="top">
@include('layouts.nav-vertical')
    <div class="container-fluid mt-7" data-layout="container">
        <div class="content">
            

            <div class="col-xxl-12">
              <div class="card h-100">
              <div class="card-header bg-light">
                <div class="row flex-between-center">
                    <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Listas de Usuarios ( {{count($Usuarios)}} )</h5>
                    </div>
                    <div class="col-8 col-sm-auto text-end ps-2">
                        <div id="table-customers-replace-element">
                            <div class="input-group" >
                                <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" id="id_txt_buscar" />
                                <div class="input-group-text bg-transparent">
                                    <span class="fa fa-search fs--1 text-600"></span>
                                </div>
                                <div class="input-group-text bg-transparent" id="id_btn_new">
                                    <span class="fa fa-plus fs--1 text-600"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="card-body p-0">
                  <div class="scrollbar">
                    <table class="table table-dashboard mb-0 table-borderless fs--1 border-200 overflow-hidden rounded-3 table-member-info" id="tbl_usuarios">
                      <thead style="display:none">
                        <tr>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                    
                       
                        @foreach ($Usuarios as $usuario)
                        
                        <tr class="border-bottom border-200">
                          <td>
                              <div class="row justify-content-between">
                                <div class="col">
                                  <div class="d-flex">
                                    <div class="avatar avatar-2xl status-online">
                                      <img class="rounded-circle" src="images/user/avatar-4.jpg" alt="" />

                                    </div>
                                    <div class="flex-1 align-self-center ms-2">
                                      <p class="mb-1 lh-1"><a class="fw-semi-bold" href="#!" onclick="OpenModal({{$usuario}})" >{{ strtoupper($usuario->nombre) }}</a> permisos de  <a href="#!" onclick="AsginarRuta({{$usuario}})">{{$usuario->rol->role_name}}</a></p>
                                      <p class="mb-0 fs--1">11 hrs &bull; Asignados &bull; <span class="fas fa-user"></span> 0 </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

           
           
        </div>
    </div>
</main>
<div class="modal fade" id="modal_new_product" tabindex="-1">
          <div class="modal-dialog modal-xl">
            <div class="modal-content border-0">
            <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                <div class="position-relative z-index-1 light">
                    <h4 class="mb-0 text-white" id="authentication-modal-label">Informacion del Usuario</h4>                    
                    <p class="fs--1 mb-0 text-white invisible" id="id_modal_state"> New </p>
                </div>
                <button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                <div class="modal-body p-card">
                    <div class="row g-2">
                        <div class="col-md-4 col-sm-12 col-xxl-4">
                            <div class="mb-3">
                                <label class="fs-0" for="id_nombre_usuario">Usuario</label>
                                <input class="form-control" id="id_nombre_usuario" type="text" name="title" required="required" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xxl-4">
                            <div class="mb-3">
                                <label class="fs-0" for="id_nombre_completo">Nombre Completo</label>
                                <input class="form-control" id="id_nombre_completo" type="text" name="title" required="required" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xxl-4">
                            <div class="mb-3">
                                <label class="fs-0" for="id_tipo_usuaro">Tipo de Usuario</label>
                                <select class="form-select" id="id_tipo_usuaro" name="label" required="required">
                                    <option value="">None</option>
                                    @foreach ($Roles as $Rol)
                                    <option value="{{$Rol->id}}">{{strtoupper($Rol->role_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                    
                    </div>
                    <div class="mb-3">
                        <label class="fs-0" for="id_password">Contraseña</label>
                        <input class="form-control" id="id_password" type="password" name="title" required="required" />
                    </div>
                </div>
                
               
                <div class="card-footer d-flex justify-content-end align-items-center bg-light">
                    <button class="btn btn-danger px-4" id="id_remover" type="submit">Eliminar</button>
                    <button class="btn btn-primary px-4 ms-3" id="id_send_frm_produc" type="submit">Guardar</button>
                    <a class="btn btn-success px-4 ms-3 " href="#!" id="btn_asignar">Asignar</a>
                </div>
            </div>
          </div>
        </div>
@endsection('content')