@extends('layouts.plantilla')
@section('metodosjs')
@include('jsViews.js_edit_payrolls')
@endsection

@section('content')
<main class="main" id="top">
  @include('layouts.nav-vertical')
  <div class="container-fluid mt-7" data-layout="container">
    <div class="content">
      <div class="card mb-3">
        <div class="card-body">
          <div class="row flex-between-center">
            <div class="col-md">
              <div class="d-flex align-items-center position-relative">
                <div class="avatar avatar-2xl">
                  <img class="rounded-circle" src="{{ isset($Employee->path_image) ? Storage::disk('s3')->temporaryUrl($Employee->path_image, now()->addMinutes(5)) : '/images/user/avatar-4.jpg' }}"  alt="" />

                </div>
                <div class="flex-1 ms-3">
                  <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900" href="../pages/user/profile.html">{{$Employee->first_name}} {{$Employee->last_name}}</a></h6>
                  <p class="text-500 fs--2 mb-0">{{$Employee->Position->Department->Company->company_name}} | {{$Employee->Position->Department->department_name}} | {{$Employee->Position->position_name}}</p>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <button class="btn btn-falcon-default btn-sm me-2" role="button">Guardar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-0">

        <div class="col-lg-3 pe-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <div class="row justify-content-between">
                <div class="col-auto">
                  <h6>Total de Ingresos C$.:</h6>
                </div>
                <div class="col-auto">
                  <div class="d-flex align-items-center">
                    <h4 class="text-success mb-0">C$ 0.00</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body bg-light">
              <form>
                <div class="row gx-2">
                  
                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Cant. horas ext</label>
                    <input class="form-control" id="XXXXXXX" type="text" placeholder="0.00" />
                  </div>
                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-address">Monto</label>
                    <input class="form-control" id="XXXXXXX" type="text" placeholder="0.00" />
                  </div>
                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-city">Ing. gravable</label>
                    <input class="form-control" id="XXXXXXX" type="text" placeholder="0.00" />
                  </div>
                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-state">Ing. no gravable</label>
                    <input class="form-control" id="XXXXXXX" type="text" placeholder="0.00" />
                  </div>
                </div>
              </form>
            </div>
          </div>
          
        </div>

        <div class="col-lg-4 pe-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <div class="row justify-content-between">
                <div class="col-auto">
                  <h6>Total de deducciones C$.:</h6>
                </div>
                <div class="col-auto">
                  <div class="d-flex align-items-center">
                    <h4 class="text-danger mb-0">C$ 0.00</h4>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="card-body bg-light">
              <form>
                <div class="row gx-2">                     
                  <div class="col-sm-4 mb-3">
                    <label class="form-label" for="event-city">Cant. horas deducir</label>
                    <input class="form-control" id="event-city" type="text" placeholder="City" />
                  </div>
                  <div class="col-sm-4 mb-3">
                    <label class="form-label" for="event-state">Monto</label>
                    <input class="form-control" id="event-state" type="text" placeholder="State" />
                  </div>
                  <div class="col-sm-4 mb-3">
                    <label class="form-label" for="event-country">Deducciones varias</label>
                    <input class="form-control" id="event-country" type="text" placeholder="Country" />
                  </div>

                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-city">INSS</label>
                    <input class="form-control" id="event-city" type="text" placeholder="City" />
                  </div>
                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-state">IR</label>
                    <input class="form-control" id="event-state" type="text" placeholder="State" />
                  </div>
                </div>
              </form>
            </div>
          </div>
          
        </div>

        <div class="col-lg-5 pe-lg-2">
          <div class="card mb-3">
            <div class="card-header">

              <div class="row justify-content-between">
                <div class="col-auto">
                  <h6>Salario ordinario: C$.:</h6>
                </div>
                <div class="col-auto">
                  <div class="d-flex align-items-center">
                    <h4 class="text-success mb-0">C$ 0.00</h4>
                  </div>
                </div>
              </div>

          
            </div>
            <div class="card-body bg-light">
              <form>
                <div class="row gx-2">
                  <div class="col-sm-4 mb-3">
                    <label class="form-label" for="event-venue">Cant. vac. desc</label>
                    <input class="form-control" id="event-venue" type="text" placeholder="Venue" />
                  </div>
                  <div class="col-sm-4 mb-3">
                    <label class="form-label" for="event-address">Monto</label>
                    <input class="form-control" id="event-address" type="text" placeholder="Address" />
                  </div>                      
                  <div class="col-sm-4 mb-3">
                    <label class="form-label" for="event-venue">Días sub. por maternidad</label>
                    <input class="form-control" id="event-venue" type="text" placeholder="Venue" />
                  </div>
                  <div class="col-sm-4 mb-3">
                    <label class="form-label" for="event-address">Monto</label>
                    <input class="form-control" id="event-address" type="text" placeholder="Address" />
                  </div>
                  <div class="col-sm-4 mb-3">
                    <label class="form-label" for="event-venue">Días Subsidio</label>
                    <input class="form-control" id="event-venue" type="text" placeholder="Venue" />
                  </div>
                  <div class="col-sm-4 mb-3">
                    <label class="form-label" for="event-address">Días laborados</label>
                    <input class="form-control" id="event-address" type="text" placeholder="Address" />
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