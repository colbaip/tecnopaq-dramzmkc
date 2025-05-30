let tableClientes;
let rowTable = "";
let divLoading=document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

    tableClientes = $('#tableClientes').dataTable({
        columnDefs:[{
            "defaultContent":"-",
            "targets":"_all"
        }],
        "processing":true,
        "derverside":true,
        "language": {
            "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url":" "+base_url+"/Clientes/getClientes",
            "dataSrc":"",
        },
        "columns":[
            { 
             data:"idpersona",
             defaultContent : ''
            },
            { 
             data:"identificacion",
             defaultContent : ''
            },
            { 
             data:"nombres",
             defaultContent : ''
            },
            { 
             data:'apellidos',
             defaultContent : ''
            },
            { 
             data:'telefono',
             defaultContent : ''
            },
            { 
             data:'email_user',
             defaultContent : ''
            },
            { 
             data:'opcion', 
             defaultContent : ''
            }

        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "destroy": true,
        "displayLength": 10,
        "order":[[0,"desc"]]
        
    });

    //document.querySelector("#identificacion").focus();
    if (document.querySelector("#formCliente")){
        let formCliente = document.querySelector("#formCliente");
        formCliente.onsubmit = function(e){
            e.preventDefault();
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let strNit = document.querySelector('#txtNit').value;
            let strNomFiscal = document.querySelector('#txtNomFiscal').value;
            let strDirFiscal = document.querySelector('#txtDirFiscal').value;
            let strPassword = document.querySelector('#txtPassword').value;
            
            if(strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == ''
               || strNit == '' || strNomFiscal == '' || strDirFiscal == '')
            {
                swal("Atencion", "Debe ingresar los campos obligatorios", "error");
                return false;
            }
    
            let elementsValid = document.getElementsByClassName("valid");
            for (let i =0; i < elementsValid.length; i++){
                if(elementsValid[i].classList.contains('is-invalid')) {
                    swal("Atencion", "Por favor verificar los campos en rojo", "error");
                    return false;
                }
    
            }
             divLoading.style.display = "flex";
             let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
             let ajaxUrl = base_url+'/Clientes/setCliente';
             let formData = new FormData(formCliente);
             request.open("POST",ajaxUrl,true);
             request.send(formData);
    
            
             request.onreadystatechange = function(){
                         //console.log(request.responseText);
                        if(request.readyState == 4 && request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                if(rowTable == ""){
                                    tableClientes.api().ajax.reload();
                                }else{
                                    rowTable.cells[1].textContent = strIdentificacion;
                                    rowTable.cells[2].textContent = strNombre;
                                    rowTable.cells[3].textContent = strApellido;
                                    rowTable.cells[4].textContent = intTelefono;
                                    rowTable.cells[5].textContent = strEmail;
                                    rowTable = "";
                                }
                                $('#modalFormCliente').modal("hide");
                                formCliente.reset();
                                swal("Clientes", objData.msg,"success");
                                //tableClientes.api().ajax.reload();
                            }else{
                                swal("Error", objData.msg,"error");
                            }
                        }
                        divLoading.style.display="none";
                        return false;
            }
        }
    }

}, false);

window.addEventListener('load',function(){
        //fntRolesUsuario();
        //fntViewUsuario();
        //fntEditUsuario();
        //fntDelUsuario();
}, false);

// Muestra un cliente

function fntViewCliente(idpersona){
 
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
            request.open("GET",ajaxUrl,true);
            request.send();
            console.log('ObjectData',request.responseText);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);

                    if(objData.status)
                    {
                             let estadoUsuario = objData.data.status == 1 ? 
                            '<span class="badge badge-success">Activo</span>' : 
                            '<span class="badge badge-danger">Inactivo</span>';

                            document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
                            document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                            document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                            document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                            document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                            document.querySelector("#celNit").innerHTML = objData.data.nit;
                            document.querySelector("#celNomFiscal").innerHTML = objData.data.nombrefiscal;;
                            document.querySelector("#celDirFiscal").innerHTML = objData.data.direccionfiscal;;
                            document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro; 
                            $('#modalViewCliente').modal('show');
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
            }
}




// Actualiza un cliente

function fntEditCliente(element, idpersona){
            rowTable = element.parentNode.parentNode.parentNode;
            //console.log(rowTable);
            document.querySelector('#titleModal').innerHTML= "Actualizar Cliente";
            document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
            document.querySelector('#btnText').innerHTML="Actualizar";

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Clientes/getCliente/'+idpersona;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);

                    if(objData.status)
                    {
                            document.querySelector("#idUsuario").value = objData.data.idpersona;
                            document.querySelector("#txtIdentificacion").value = objData.data.identificacion;
                            document.querySelector("#txtNombre").value = objData.data.nombres;
                            document.querySelector("#txtApellido").value = objData.data.apellidos;
                            document.querySelector("#txtTelefono").value = objData.data.telefono;
                            document.querySelector("#txtEmail").value = objData.data.email_user;
                            document.querySelector("#txtNit").value = objData.data.nit;
                            document.querySelector("#txtNomFiscal").value = objData.data.nombrefiscal;;
                            document.querySelector("#txtDirFiscal").value = objData.data.direccionfiscal;;
                    }
                     
                }

                 $('#modalFormCliente').modal('show');
            
        }
}

// Eliminar Cliente

function fntDelCliente(idpersona){

            swal({
                title: "Eliminar Cliente",
                text: "¿Desea eliminar el cliente?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar",
                closeOnConfirm:false,
                closeOnCancel:true,
            }, function(isConfirm){

                if (isConfirm) 
                {
                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'/Clientes/delCliente';
                    let strData = "idUsuario="+idpersona;
                    request.open("POST", ajaxUrl,true);
                    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange= function(){
                        if(request.readyState == 4 & request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                swal("Eliminar!",objData.msg,"success");
                                tableClientes.api().ajax.reload();
                            }else{
                                swal("Atencion!",objData.msg,"error")
                            }
                        }
                    }
                }
              
            });
}

function openModal(){
       rowTable="";
       document.querySelector('#idUsuario').value="";
       document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
       document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
       document.querySelector('#btnText').innerHTML="Guardar";
       document.querySelector('#titleModal').innerHTML="Nuevo Cliente";
       document.querySelector('#formCliente').reset();
       $('#modalFormCliente').modal('show');

}

