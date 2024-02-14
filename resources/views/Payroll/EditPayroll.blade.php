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
              <div class="row justify-content-between align-items-center">
                <div class="col-md">
                  <h5 class="mb-2 mb-md-0">Planilla #AD20294</h5>
                </div>
                <div class="col-auto">
                  <button class="btn btn-falcon-default btn-sm me-1 mb-2 mb-sm-0" type="button"><span class="fas fa-arrow-down me-1"> </span>Download (.pdf)</button>
                  <button class="btn btn-falcon-default btn-sm me-1 mb-2 mb-sm-0" type="button"><span class="fas fa-print me-1"> </span>Print</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">          
              <div class="table-responsive scrollbar fs--1">
                <table class="table table-striped border-bottom">
                  <thead class="light">
                    <tr class="bg-primary text-white dark__bg-1000">
                      <th class="border-0">Nombres Y Apellidos</th>
                      <th class="border-0 text-center">Cedula</th>
                      <th class="border-0 text-end">Nº INSS</th>
                      <th class="border-0 text-end">Nº Cuenta</th>         
                      <th class="border-0 text-center">Sal. Mensual</th>
                      <th class="border-0 text-center">Dias. LAB</th>
                      <th class="border-0 text-center">Sal. ORD</th>
                      <th class="border-0 text-center">Hrs Extras</th>
                      <th class="border-0 text-center">Hrs Extras Monto</th>
                      <th class="border-0 text-center">Dias. Vac Descans</th>
                      <th class="border-0 text-center">Dias. Vac Descans Monto</th>
                      <th class="border-0 text-center">Ingreso Gravables</th>
                      <th class="border-0 text-center">Ingreso No Gravables</th>
                      <th class="border-0 text-center">DIA SUB. MATERN</th>
                      <th class="border-0 text-center">SUB. MATERNIDAD</th>
                      <th class="border-0 text-center">SUB. ESTATAL</th>
                      <th class="border-0 text-center">Total Ingreso</th>
                      <th class="border-0 text-center">Hrs. A Deducir</th>
                      <th class="border-0 text-center">Monto Hrs. a Deducir</th>
                      <th class="border-0 text-center">Inss Cotiz. Lab</th>
                      <th class="border-0 text-center">IR</th>
                      <th class="border-0 text-center">Deduc. Varias</th>
                      <th class="border-0 text-center">Total Deducir</th>
                      <th class="border-0 text-center">Neto a pagar</th>
                      <th class="border-0 text-center">Inss Patronal</th>
                      <th class="border-0 text-center">INATEC</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($Employes as $p)
                    <tr>
                      <td class="align-middle">
                      <a class=" text-900" href="../IngresosEgresos/{{$IdPayRoll}}/{{$p->employee_id}}"><h6 class="mb-0 text-nowrap">
                          {{$p->Employee->first_name}}  {{$p->Employee->last_name}}  </h6></a>
                        <p class="mb-0">{{$p->Employee->Position->position_name}}</p>
                      </td>
                      <td class="align-middle text-center">{{$p->Employee->cedula_number}}</td>
                      <td class="align-middle text-end">{{$p->Employee->inss_number}}</td>
                      <td class="align-middle text-end"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> - </td>
                      <td class="align-middle text-center"> 0 </td>
                    </tr>
                    
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row justify-content-end">
                <div class="col-auto">
                  <table class="table table-sm table-borderless fs--1 text-end">
                    
                    
                    <tr class="border-top border-top-2 fw-bolder text-900">
                      <th>Amount Due:</th>
                      <td>C$ 19,688.40</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="card-footer bg-light">
              <p class="fs--1 mb-0"><strong>Notes: </strong>We really appreciate your business and if there’s anything else we can do, please let us know!</p>
            </div>
          </div>

    </div>  
  </div>
</main>
@endsection('content')