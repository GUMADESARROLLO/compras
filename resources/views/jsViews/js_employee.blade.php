<script type="text/javascript">
    const startOfMonth = moment().startOf('month').format('YYYY-MM-DD');
    const endOfMonth   = moment().subtract(0, "days").format("YYYY-MM-DD");
    $('[data-mask]').inputmask()
    $('#txt_email').inputmask({
        alias: 'email'
    });


    var Selectors = {
        TABLE_SETTING: '#modal_new_product',
        TABLE_UPLOARD: '#modal_upload',
        TABLE_KARDEX: '#modal_kardex'
    };

    dta_table_excel = [];
    var isError = false
    var TableExcel;
   
    $(document).ready(function () {
        var labelRange = startOfMonth + " to " + endOfMonth;

        $('.form-check-input').on('click', function() {
        
            var isChecked   = $(this).prop('checked');
            var payrollType = $(this).data('payroll-type');
            var id_employee = $("#txt_employee").val();
            console.log(payrollType)

            SendData(id_employee,payrollType,isChecked)
        });


        $('#id_range_select').val(labelRange);

        $('#id_range_select').change(function () {
            Fechas = $(this).val().split("to");
            if(Object.keys(Fechas).length >= 2 ){
                var ArticuloID = $("#art_code").val()
                getKardexLogs(ArticuloID,Fechas[0],Fechas[1]);
            } 
        }); 

       
        $('#id_txt_buscar').on('keyup', function() {   
            var vTableArticulos = $('#tbl_employee').DataTable();     
            vTableArticulos.search(this.value).draw();
        });
        $('#id_txt_excel').on('keyup', function() {    
            if(isValue(TableExcel,0,true)){
                TableExcel.search(this.value).draw();
            }
        });
        

        $("#btn_upload").click(function(){
            var addMultiRow = document.querySelector(Selectors.TABLE_UPLOARD);
            var modal = new window.bootstrap.Modal(addMultiRow);
            modal.show();
        });

        
        $("#btn_kardex").click(function(){
            var addMultiRow = document.querySelector(Selectors.TABLE_KARDEX);
            var modal = new window.bootstrap.Modal(addMultiRow);
            modal.show();
        });

        $('#frm-upload').on("change", function(e){ 
            handleFileSelect(e)
        });

        initTable('#tbl_employee');
    });

    function SendData(Employee,PayrollType,isChecked) {
        $.ajax({
            url: '../EmployeeTypePayroll',
            data: {
                Employee_       : Employee,
                PayrollType_    : PayrollType,
                isChecked_      : isChecked,
                _token  : "{{ csrf_token() }}" 
            },
            type: 'post',
            async: true,
            success: function(response) {
            
            },
            error: function(response) {
                
            }
        });
    }
    function Editar(id) {
        window.location ="EditEmployee/" + id
    }

    function Remover(id){
        Swal.fire({
            title: '¿Estas Seguro de remover el registro  ?' + id,
            text: "¡Se removera la informacion permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            target: document.getElementById('mdlMatPrima'),
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    url: "rmEmployee",
                    data: {
                        id_  : id,
                        _token  : "{{ csrf_token() }}" 
                    },
                    type: 'post',
                    async: true,
                    success: function(response) {
                        if(response){
                            Swal.fire({
                                title: 'Registro Removido Correctamente ' ,
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                    }
                                })
                            }
                        },
                    error: function(response) {
                        //Swal.fire("Oops", "No se ha podido guardar!", "error");
                    }
                    }).done(function(data) {
                        //CargarDatos(nMes,annio);
                        location.reload();
                    });
                },
            allowOutsideClick: () => !Swal.isLoading()
        });

    }

    
    function OpenModal(Articulo,Event){
        
        var HeaderArticulo = Articulo.DESCRIPCION 
        var FooterArticulo = Articulo.ARTICULO + " | " + Articulo.UND

        // Obtener la fecha y hora de Articulo.CREATED_AT
        const fechaArticulo = moment(Articulo.CREATED_AT);

        // Formatear la fecha y hora según el formato deseado
        const fechaFormateada = fechaArticulo.format('ddd, MMM D, YYYY h:mm');

        $("#articulos_header").text(HeaderArticulo) 
        $("#articulos_footer").text(FooterArticulo)

        var _CANTIDAD = numeral(Articulo.CANTIDAD).format('0,0.00')

        var _JUMBOS = numeral(Articulo.JUMBOS).format('0.00')
        var _FISICO = numeral(Articulo.CANTIDAD).format('0.00')

        $("#id_existencia_actual").text(_CANTIDAD  + " " + Articulo.UND) 
        $("#id_created_at").text(fechaFormateada) 

        
        
        $("#art_code").val(Articulo.ID);
        $("#id_event").val(Event);

        getKardexLogs(Articulo.ID,startOfMonth,endOfMonth)
        
        
        $("#exist_actual").val(_FISICO)
        $("#id_jumbos").val(_JUMBOS)

        var lbl = (Event == 'In')? "Kardex [ INGRESO ]" : "Kardex [ EGRESO ]" ; 

        $("#id_lbl_modal_kardex").text(lbl)
        initTable("#tblRegkardex")

        var TABLE_SETTING = document.querySelector(Selectors.TABLE_SETTING);
        var modal = new window.bootstrap.Modal(TABLE_SETTING);
        modal.show();
    }

    function initTable(id){
        $(id).DataTable({
        "destroy": true,
        "info": false,
        "bPaginate": true,
        "responsive": true, 
        "order": [
            [0, "asc"]
        ],
        "lengthMenu": [
            [7, -1],
            [7, "Todo"]
        ],
        "language": {
            "zeroRecords": "NO HAY COINCIDENCIAS",
            "paginate": {
                "first": "Primera",
                "last": "Última ",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "MOSTRAR _MENU_",
            "emptyTable": "-",
            "search": "BUSCAR"
        },
        });

        $(id+"_length").hide();
        $(id+"_filter").hide();
    }
   
    function table_render(Table,datos,Header,columnDefs,Filter){

        TableExcel = $(Table).DataTable({
            "data": datos,
            "destroy": true,
            "info": false,
            "bPaginate": true,
            "order": [
                [0, "DESC"]
            ],
            "lengthMenu": [
                [7, -1],
                [7, "Todo"]
            ],
            "language": {
                "zeroRecords": "NO HAY COINCIDENCIAS",
                "paginate": {
                    "first": "Primera",
                    "last": "Última ",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "lengthMenu": "MOSTRAR _MENU_",
                "emptyTable": "-",
                "search": "BUSCAR"
            },
            'columns': Header,
            "columnDefs": columnDefs,
            rowCallback: function( row, data, index ) {
                if ( data.Index == 'N/D' ) {
                    $(row).addClass('table-danger');
                } 
            }
        });
        if(!Filter){
            $(Table+"_length").hide();
            $(Table+"_filter").hide();
        }

    }
    var ExcelToJSON = function() {

        this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {type: 'binary'});
           
            workbook.SheetNames.forEach(function(sheetName) {

               

                if(sheetName=='INVENTARIO'){
                    dta_table_excel = [];
                    isError=false;

                    var isVal = 0;
                    var NotVal = 0;
                    var ttSkus = 0;

                    var worksheet = workbook.Sheets[sheetName];
                    var range = XLSX.utils.decode_range('A1:E200');
                    var rows = XLSX.utils.sheet_to_json(worksheet, {range: range});

                    rows.forEach(function(row) {

                        var _Codigo   = isValue(row.ARTICULO,'N/D',true)
                        var index     = _Codigo;
                        var _Total    = numeral(isValue(row.FISICO,'0',true)).format('00.00')
                        var _Unida    = isValue(row.UNIDAD,'N/D',true)
                        var _Jumbo    = numeral(isValue(row.JUMBOS,'0',true)).format('00.00')
                        var _Descr    = isValue(row["DESCRIPCION"],'Columna <strong>"Descripcion de Producto"</strong> no Encontrada',true)

                        if(_Codigo == 'N/D'){
                            isError=true
                            NotVal++
                        }

                        if (/^[0-9N]/.test(_Codigo.charAt(0))){

                            if(_Total != '00.00'){

                                dta_table_excel.push({ 
                                    Articulo: _Codigo,
                                    Descr   : _Descr,
                                    Unida   : _Unida,
                                    Total   : _Total,
                                })

                            }
                            
                            
                        }
                    });

                    ttSkus = dta_table_excel.length;
                    isVal   = numeral(isValue((ttSkus - NotVal),'0',true)).format('0,0')
                    NotVal  = numeral(isValue(NotVal,'0',true)).format('0,0')

                    AVGValido = (isVal / ttSkus) * 100;
                    AVGValido  = numeral(isValue(AVGValido,'0',true)).format('0.00')+ "%"

                    AVGNotValido = (NotVal / ttSkus) * 100;
                    AVGNotValido  = numeral(isValue(AVGNotValido,'0',true)).format('0.00') + "%"

                    
                    $("#ttSKUs").text(dta_table_excel.length) 
                    $("#ttSKUsValido").text(isVal)
                    $("#avgValido").text(AVGValido)
                    $("#avgNotValido").text(AVGNotValido)
                    $("#ttSKUsNotValido").text(NotVal)

                    if(isError){
                        Swal.fire("Codigo de Articulo No encontrado", "Existen articulos sin Definicion de Codigo ", "error");
                    }


                    dta_table_header = [
                        {"title": "Articulo","data": "Articulo"},
                        {"title": "Descripcion","data": "Descr"}, 
                        {"title": "Unidad","data": "Unida"},                                     
                        {"title": "Fisica","data": "Total"},
                    ]
                    dta_columnDefs = [{"className": "dt-center", "targets": [ ]},]
                    table_render('#tbl_excel',dta_table_excel,dta_table_header,dta_columnDefs,false)
                }
            })
        };

        reader.onerror = function(ex) {

        };

        reader.readAsBinaryString(file);

        };
    };

    function ReadComment(Comentario){        
        Swal.fire({
            title: 'Comentario',
            html: Comentario,
        })
    }
    function rmKardex(ID){

        IdArticulo = $("#art_code").val();

        Swal.fire({
            title: '¿Estas Seguro de remover el registro  ?',
            text: "¡Se removera la informacion permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            target: document.getElementById('mdlMatPrima'),
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    url: "rmKardex",
                    data: {
                        id   : ID,
                        _token  : "{{ csrf_token() }}" 
                    },
                    type: 'post',
                    async: true,
                    success: function(response) {
                        if(response){
                            Swal.fire({
                                title: 'Registro Removido Correctamente ' ,
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                    }
                                })
                            }
                        },
                    error: function(response) {
                        //Swal.fire("Oops", "No se ha podido guardar!", "error");
                    }
                    }).done(function(data) {
                        //CargarDatos(nMes,annio);
                    });
                },
            allowOutsideClick: () => !Swal.isLoading()
        });
        
    }

    $("#id_send_data_excel").click(function(){ 
     
        
        if(!isError){
        Swal.fire({
            title: '¿Estas Seguro de cargar  ?',
            text: "¡Se cargara la informacion previamente visualizada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            target: document.getElementById('mdlMatPrima'),
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    url: "GuardarInventario",
                    data: {
                        datos   : dta_table_excel,
                        _token  : "{{ csrf_token() }}" 
                    },
                    type: 'post',
                    async: true,
                    success: function(response) {
                        if(response){
                            Swal.fire({
                                title: 'Articulos Ingresados Correctamente ' ,
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                    }
                                })
                            }
                        },
                    error: function(response) {
                        //Swal.fire("Oops", "No se ha podido guardar!", "error");
                    }
                    }).done(function(data) {
                        //CargarDatos(nMes,annio);
                    });
                },
            allowOutsideClick: () => !Swal.isLoading()
        });

            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Existen articulos sin Definicion de Codigo ",
                
            })
        }
    })
 
    function handleFileSelect(evt) {    
        var files = evt.target.files;
        var xl2json = new ExcelToJSON();
        xl2json.parseExcel(files[0]);
    }

    function getKardexLogs(ArticuloID,startOfMonth,endOfMonth)
        {
            dta_table_kardex = [];
            $.ajax({
            url: "postKardex",
            data: {
                ArticuloID   : ArticuloID,
                DateStart   : startOfMonth,
                DateEnd   : endOfMonth,
                _token  : "{{ csrf_token() }}" 
            },
            type: 'post',
            async: true,
            success: function(response) {
                if(response){

                    response.forEach((response) => {

                        var _ENTRADA = numeral(response.ENTRADA).format('0,0.00')
                        var _SALIDA = numeral(response.SALIDA).format('0,0.00')
                        var _STOCK = numeral(response.STOCK).format('0,0.00')

                        dta_table_kardex.push({ 
                            ID: response.ID,
                            TIPO_MOVI       : response.TIPO_MOVIMIENTO,
                            FECHA           : response.FECHA,
                            _ENTRADA        :_ENTRADA,
                            _SALIDA         : _SALIDA,
                            _STOCK          : _STOCK,
                            OBSERVACION     : response.OBSERVACION
                        })
                        


                    });

                    dta_header_kardex = [
                        {"title": "ID","data": "ID"}, 
                        {"title": "","data": "ID", "render": function(data, type, row, meta) {

                        var evColor = (row.TIPO_MOVI == 'In')? 'success' : 'warning' ;
                        var evLabel = (row.TIPO_MOVI == 'In')? 'Ingreso ' : 'Egreso' ;
                        var eLetter = (row.TIPO_MOVI == 'In')? 'I ' : 'E' ;
                        var eIcon   = (row.TIPO_MOVI == 'In')? 'fas fa-arrow-left' : 'fas fa-arrow-right' ;
                        var isComm  = '';
                        var showCom = '';

                        if (isValue(row.OBSERVACION,'N/D',true)=='N/D') {
                            isComm  = 'd-none'
                            showCom = ''
                        } else {
                            isComm  = ''
                            showCom = row.OBSERVACION.replace(/\n/g, "");
                        }

                       

                        return`<tr>
                                <td class="log">
                                    <div class="d-flex align-items-center position-relative">
                                        <div class="flex-1">
                                            <p class="text-500 fs--2 mb-0">Numero de Registro # ` + row.ID + ` | <span class="badge badge rounded-pill badge-soft-` + evColor + `">` + evLabel + `<span class="ms-1 ` +eIcon + `" data-fa-transform="shrink-2"></span></span> </p>
                                            <h6 class="mb-0 fw-semi-bold">` + evLabel + ` al inventario registrada</h6>
                                            <p class="text-700 fs--1 mb-0">` + row.FECHA + ` &bull; <span class="fas fa-trash-alt" onclick="rmKardex(` + row.ID + `)"></span> &bull; <span class="fas fa-comment ` + isComm + `" onclick="ReadComment(` + "'" +showCom + "'" + `)"></span></p> 
                                       
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>`

                    }},
                    {"title": "Entrada","data": "_ENTRADA"}, 
                    {"title": "Salida","data": "_SALIDA"},                                     
                    {"title": "Saldo","data": "_STOCK"},
                ]

                dta_columnDefs = [
                    {"visible": false,"searchable": false,"targets": [0]},
                    {"className": "align-middle dt-right", "targets": [2,3,4]},
                    {"width": "40%","targets": [1]},
                    {"className": "align-middle dt-center", "targets": [2]},
                ]
                table_render('#tblRegkardex',dta_table_kardex,dta_header_kardex,dta_columnDefs,false)


                    

                }
                },
            error: function(response) {
                //Swal.fire("Oops", "No se ha podido guardar!", "error");
            }
            }).done(function(data) {
                //CargarDatos(nMes,annio);
            });

        }
    function isValue(value, def, is_return) {
        if ( $.type(value) == 'null'
            || $.type(value) == 'undefined'
            || $.trim(value) == '(en blanco)'
            || $.trim(value) == ''
            || ($.type(value) == 'number' && !$.isNumeric(value))
            || ($.type(value) == 'array' && value.length == 0)
            || ($.type(value) == 'object' && $.isEmptyObject(value)) ) {
            return ($.type(def) != 'undefined') ? def : false;
        } else {
            return ($.type(is_return) == 'boolean' && is_return === true ? value : true);
        }
    }
</script>