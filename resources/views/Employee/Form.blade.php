@extends('layouts.plantilla')
@section('metodosjs')
@include('jsViews.js_employee')
@endsection
@section('content')
<main class="main" id="top">
@include('layouts.nav-vertical')
    <div class="container-fluid mt-7" data-layout="container" method="POST">
        <div class="content">
          <div class="card mb-3">
            
            <div class="row g-0">
              <div class="col-lg-8 pe-lg-2">
                <div class="card mb-3">
                  <div class="card-header">
                  <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ (isset($Employee)) ? route('UpdateEmployee') : route('SaveEmployee') }}" enctype="multipart/form-data">
                    <div class="d-flex"><a href="#!"> <img class="rounded-circle img-thumbnail shadow-sm" src="{{ isset($Employee->path_image) ? Storage::disk('s3')->temporaryUrl($Employee->path_image, now()->addMinutes(5)) : '/images/user/avatar-4.jpg' }}"  alt="" width="100" /></a>
                      <div class="flex-1 position-relative ps-3">
                        <div class="d-flex flex-between-center">
                          <h4 class="mb-1"> {{ $Employee->first_name ?? 'Nuevo Colaborador' }}  {{ $Employee->last_name ?? '' }}</h4>
                          <button class="btn btn-sm btn-success px-4 ms-2" type="submit"><span>Guardar</span></button>
                        </div>
                        <h5 class="fs-0 fw-normal">{{ $Employee->Position->position_name ?? 'Posicion' }}  en {{ $Employee->Position->Department->department_name ?? 'Departamento' }}</h5>
                        <p class="text-500">{{ $Employee->Position->Department->Company->company_name ?? 'UNIDAD' }} | Antig.: {{$date_in ?? ' - ' }} 
                          
                        </p>
                        
                      </div>
                    </div>
                  </div>
                  <div class="card-body bg-light">
                      @csrf
                      @if(session('message_success')) 
                      <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                        <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span></div>
                        <p class="mb-0 flex-1">{{ session('message_success') }}</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                      @if(isset($Employee)) 
                        <div class="col-12 mb-3" style="display:none">
                          <input class="form-control" type="text" id="txt_employee" name="id_employee" value="{{ $Employee->id_employee ?? '' }}" />
                        </div>
                      @endif
                      <div class="row gx-2">
                        <div class="col-sm-6 mb-3">
                          <label class="form-label" for="event-name">Nombres</label>
                          <div class="input-group"><span class="input-group-text "><span class="fas fa-user"></span></span>
                            <input class="form-control" type="text" name="nombres" placeholder="Nombres de la persona" required="" value="{{ $Employee->first_name ?? '' }}" />
                            <div class="invalid-feedback">Campo Requerido.</div>
                          </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                          <label class="form-label" for="event-name">Apellidos</label>
                          <div class="input-group"><span class="input-group-text "><span class="fas fa-user"></span></span>
                            <input class="form-control" type="text" name="apellidos" placeholder="Apellidos de la persona" required="" value="{{ $Employee->last_name ?? '' }}" />
                            <div class="invalid-feedback">Campo Requerido.</div>
                          </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                          <label class="form-label" for="event-name">Fecha Entrada</label>
                          <div class="input-group"><span class="input-group-text "><span class="far fa-calendar-check"></span></span>
                            <input class="form-control datetimepicker" id="start-date" type="text" name="date_in" placeholder="y/m/d" data-options='{"dateFormat":"Y-m-d","disableMobile":true}' required="" value="{{ $Employee->date_in ?? '' }}" />
                            <div class="invalid-feedback">Campo Requerido.</div>
                          </div>
                        </div>
                        
                        <div class="col-sm-6 mb-3">
                          <label class="form-label" for="event-name">Fecha Salida</label>
                          <div class="input-group"><span class="input-group-text "><span class="far fa-calendar-times"></span></span>
                            <input class="form-control datetimepicker" id="end-date" type="text" name="date_out" placeholder="y-m-d" data-options='{"dateFormat":"Y-m-d","disableMobile":true}' value="{{ $Employee->date_out ?? '' }}"/>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label" for="event-name">EMail</label>
                          <div class="input-group"><span class="input-group-text "><span class="far fa-envelope"></span></span>
                            <input class="form-control" id="txt_email" type="text" name="email" placeholder="email@ejemplo.com" value="{{ $Employee->email ?? '' }}" />
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <label class="form-label" for="time-zone">Nacionalidad</label>
                          <select class="js-example-basic-single form-select" size="1" name="nacionalidad" data-options='{"removeItemButton":true,"placeholder":true}'>
                            @foreach($Paises as $p => $v)                     
                            <option value="{{ $p }}" @if(isset($Employee) && $p === $Employee->nationality) selected @endif>  
                                {{ $v }}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12">
                          <div class="border-dashed-bottom my-3"></div>
                        </div>
                        <div class="col-sm-4 mb-3">
                          <label class="form-label" for="event-name">Numero INSS</label>
                          <div class="input-group"><span class="input-group-text "><span class="far fa-address-card"></span></span>
                          <input class="form-control" id="event-name" type="text" name="num_inss" placeholder="0000000-0" data-inputmask="'mask': ['9999999-9']" data-mask value="{{ $Employee->inss_number ?? '' }}" />
                          </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                          <label class="form-label" for="event-name">Cedula</label>
                          <div class="input-group"><span class="input-group-text "><span class="far fa-address-card"></span></span>
                            <input class="form-control" id="event-name" type="text" name="cedula" placeholder="000-000000-0000A" data-inputmask="'mask': ['999-999999-9999A']" data-mask required="" value="{{ $Employee->cedula_number ?? '' }}"/>
                            <div class="invalid-feedback">Campo Requerido.</div>
                          </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                          <label class="form-label" for="event-name">Telefono</label>
                          <div class="input-group"><span class="input-group-text "><span class="fas fa-phone-alt"></span></span>
                            <input class="form-control" id="event-name" type="text" name="telefono" placeholder="+505-0000-000" data-inputmask="'mask': ['+505-9999-9999']" data-mask value="{{ $Employee->phone_number ?? '' }}" />
                          </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                          <label class="form-label" for="event-name">Vacaciones Acumuladas</label>
                          <div class="input-group"><span class="input-group-text "><span class="fas fa-child"></span></span>
                            <input class="form-control" type="text" name="Vacaciones" placeholder="0.00"  value="{{ $Employee->vacation_balance ?? '' }}" />
                          </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                          <label class="form-label" for="event-name">Talla Camisa</label>
                          <div class="input-group"><span class="input-group-text "><span class="fas fa-user-tag"></span></span>
                            <input class="form-control" type="text" name="talla_camisa" placeholder="Ej. "  value="{{ $Employee->shirt_size ?? '' }}"/>
                          </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                          <label class="form-label" for="event-name">Talla Pantalon</label>
                          <div class="input-group"><span class="input-group-text "><span class="fas fa-user-tag"></span></span>
                            <input class="form-control" type="text" name="talla_pantalon" placeholder="Ej. "  value="{{ $Employee->pants_size ?? '' }}" />
                          </div>
                        </div>
                        <div class="col-12">
                          <label class="form-label" for="event-description">Direccion</label>
                          <textarea class="form-control" rows="6" required="" name="direccion" >
                            {{ $Employee->address ?? '' }}
                          </textarea>
                        </div>
                      </div>
                      
                  </div>
                </div>
              </div>
              <div class="col-lg-4 ps-lg-2">
             
                <div class="sticky-sidebar">
                  <div class="card mb-lg-0">
                    <div class="card-header">
                    <h5 class="mb-0">Experience</h5>
                    </div>
                    <div class="card-body bg-light">
                      <div class="mb-3">
                        <div class="d-flex flex-between-center">
                          <label class="form-label" for="organizer">Posicion</label>
                        </div>
                        <select class="js-example-basic-single form-select" size="1" name="posicion" data-options='{"removeItemButton":true,"placeholder":true}' required="">
                        @foreach($Position as $p)
                        <option value="{{ $p->id_position }}" @if(isset($Employee) && $p->id_position == $Employee->position_id) selected @endif>
                            {{ $p->position_name }}
                        </option>
                        @endforeach
                      </select>
                      </div>
                      <div class="mb-3">
                        <div class="d-flex flex-between-center">
                          <label class="form-label" for="sponsors">Contrato</label>
                        </div>
                        <select class="form-select " size="1" name="contrato"  required="">
                          @foreach($Contract as $c)
                          <option value="{{$c->id_contract_type}}" @if(isset($Employee) && $c->id_contract_type == $Employee->contract_type_id) selected @endif>  
                            {{$c->contract_type_name}} 
                          </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="event-type">Genero</label>
                        <select class="form-select " size="1" name="genero">
                          <option value="1" @if(isset($Employee) && $Employee->gender == 1) selected @endif>Masculino</option>
                          <option value="2" @if(isset($Employee) && $Employee->gender == 2) selected @endif>Femenino</option>
                          <option value="3" @if(isset($Employee) && $Employee->gender == 3) selected @endif>Otros</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="event-topic">Activo</label>
                        <select class="form-select" size="1" name="activo" data-options='{"removeItemButton":true,"placeholder":true}'>
                        <option value="1" @if(isset($Employee) && $Employee->active == 1) selected @endif>Activo</option>
                        <option value="0" @if(isset($Employee) && $Employee->active == 2) selected @endif>Inactivo</option>
                      </select>
                      </div>
                 
                      <div class="mb-3">
                        <label class="form-label" for="photo_employee">Fotos de la persona Maximo permitdo 2MB</label>
                        <input class="form-control" id="photo_employee" name="photo_employee" type="file" />
                      </div>
                      @if(isset($Employee))                     
                        <div class="border-dashed-bottom my-3"></div>
                        <h6>Planillas que pertenece </h6>
                        @foreach($PayrollTypes as $t)
                          <div class="form-check custom-checkbox mb-0">
                            <input class="form-check-input" type="checkbox" data-payroll-type="{{$t->id_payroll_type}}" 
                                  @if(isset($Employee->ListPayrollType))
                                      @php
                                        $found = false;
                                        foreach ($Employee->ListPayrollType as $payrollType) {
                                          if ($payrollType['payrolls_id'] == $t->id_payroll_type) {
                                            $found = true;
                                            break;
                                          }
                                        }
                                      @endphp
                                      @if($found) checked="checked" @endif
                                  @endif />
                            <label class="form-label mb-0"><strong>{{$t->payroll_type_name}}</strong></label>
                            <div class="form-text mt-0">UNIDAD DE NEGOCIO</div>
                          </div>
                        @endforeach
                      @endif
                      

            
              
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                          <div class="pagination d-none"></div>
                          <div class="col">
                            <p class="mb-0 fs--1"><span class="d-none d-sm-inline-block me-2" data-list-info="data-list-info"></span></p>
                          </div>
                          <div class="col-auto d-flex">
                            
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          
          
        </div>
      </div>
</main>
@endsection('content')