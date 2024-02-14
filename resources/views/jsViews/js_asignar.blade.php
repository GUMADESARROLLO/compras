<script type="text/javascript">
    $(document).ready(function () {
        $('.js-example-basic-single').select2();

        $("#btn_assigned").click(function(){
            var IdEmployee  = $("#edtEmployee option:selected").val(); 
            var IdUser      = $("#Id_User").text(); 
            
            IdEmployee      = isValue(IdEmployee,0,true);
            IdUser          = isValue(IdUser,0,true);

            if(IdEmployee == 0 || IdUser == 0){
                    Swal.fire("Oops", "Datos no Completos", "error");
                }else{
                    $.ajax({
                        url: "../SaveAssigned",
                        type: 'post',
                        data: {
                            IdUser_       : IdUser,
                            IdEmployee_   : IdEmployee,
                            _token  : "{{ csrf_token() }}" 
                        },
                        async: true,
                        success: function(response) {
                            if(response){
                                Swal.fire({
                                title: 'Correcto',
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
                            Swal.fire("Oops", "No se ha podido guardar!", "error");
                        }
                    }).done(function(data) {
                        //location.reload();
                    });

                
            }
        });
    })

    function Remover(id){
        var IdUser      = $("#Id_User").text(); 
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
                    url: "../rmAssigned",
                    data: {
                        id_     : id,
                        IdUser_ : IdUser,
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
</script>