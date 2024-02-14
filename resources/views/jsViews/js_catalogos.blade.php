<script type="text/javascript">
    $(document).ready(function () {
        var Selectors = {
            MODAL_DEPA: '#modal_form_depa',     
            MODAL_POSI: '#modal_form_posicion',        
        };

        $("#btn_open_form").click(function(){
            var obj = document.querySelector(Selectors.MODAL_DEPA);
            var modal = new window.bootstrap.Modal(obj);
            modal.show();
        });
        $("#btn_open_form_posi").click(function(){
            var obj = document.querySelector(Selectors.MODAL_POSI);
            var modal = new window.bootstrap.Modal(obj);
            modal.show();
        });

        $("#save_depa").click(function(){
            var Nombre_     = $("#edtNombre").val();   
            var Company_    = $("#edtCompany option:selected").val(); 
            var IdRow       = $("#IdRow").text();

            Nombre_      = isValue(Nombre_,'N/D',true)            
            Company_     = isValue(Company_,'N/D',true)

            if(Nombre_ ==='N/D' || Company_ === 'N/D' ){
                Swal.fire("Oops", "Datos no Completos", "error");
            }else{

                if (IdRow === "0") {
                    SendData(Nombre_,"Departamento",Company_)
                } else {
                    UpdateData(Nombre_,3,IdRow,Company_)
                }
                

            }
        });
        $("#save_posicion").click(function(){
            var nmDepa     = $("#edtNombrePosicion").val();   
            var sltDepa    = $("#sltDepa option:selected").val(); 
            var IdRow       = $("#IdRow2").text();


            nmDepa      = isValue(nmDepa,'N/D',true)            
            sltDepa     = isValue(sltDepa,'N/D',true)

            if(sltDepa ==='N/D' || nmDepa === 'N/D' ){
                Swal.fire("Oops", "Datos no Completos", "error");
            }else{
                
                if (IdRow === "0") {
                    SendData(nmDepa,"Posicion",sltDepa)
                } else {
                    UpdateData(nmDepa,4,IdRow,sltDepa)
                }
                
            }
        });
    });
    function edtDepa(d){
        $("#edtNombre").val(d.department_name);
        $("#IdRow").text(d.id_department);
        $("#edtCompany").val(d.company_id).change();

        var obj = document.querySelector('#modal_form_depa');
        var modal = new window.bootstrap.Modal(obj);
        modal.show();
    }
    function edtPosi(d){
        $("#IdRow2").text(d.id_position);
        $("#edtNombrePosicion").val(d.position_name);   
        $("#sltDepa").val(d.department_id).change();

        var obj = document.querySelector('#modal_form_posicion');
        var modal = new window.bootstrap.Modal(obj);
        modal.show();
    }
    function edit(o) {

        var IsOK = isValue(o.contract_type_name,'N/D',true);
     
        var varDescripcion = (IsOK === 'N/D') ? o.company_name : o.contract_type_name ; 
        var varID = (IsOK === 'N/D') ? o.id_compy : o.id_contract_type ; 
        var varModelo = (IsOK === 'N/D') ? 2 : 1 ; 


        Swal.fire({
            title: varDescripcion,
            text: 'Editar registro',
            input: "text",
            inputPlaceholder: 'Valor a Ingresar',
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: true,
            confirmButtonText: 'Editar',
            showLoaderOnConfirm: true,
            inputValue: varDescripcion,
            inputValidator: (value) => {
                if (!value) {
                    return 'Campo no puede estar Vacio';
                }
                UpdateData(value,varModelo,varID,0)
            }
        })

    }


    function MSG(txt) {
        Swal.fire({
            title: txt,
            text: 'Nuevo registro',
            input: "text",
            inputPlaceholder: 'Valor a Ingresar',
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            showLoaderOnConfirm: true,
            inputValue: $('#cantidad').text(),
            inputValidator: (value) => {
                if (!value) {
                    return 'Campo no puede estar Vacio';
                }
                SendData(value,txt,'N/D')
            }
        })
    }

    function Remover(id,mdl){
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
                    url: "rmCatalogo",
                    data: {
                        id_  : id,
                        mdl_  : mdl,
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

     
    function UpdateData(Nombre,Modelo,ID,Select) {
        $.ajax({
            url: "UpdateCatalogo",
            data: {
                ID_     : ID,
                Nombre_ : Nombre,
                Modelo_ : Modelo,
                Select_ : Select,                
                _token  : "{{ csrf_token() }}" 
            },
            type: 'post',
            async: true,
            success: function(response) {
                swal("Exito!", "Guardado exitosamente", "success");
            },
            error: function(response) {
                swal("Oops", "No se ha podido guardar!", "error");
            }
        }).done(function(data) {
            location.reload();
        });
    }
</script>