let tableUsuarios;
let rowTable = "";
let divLoading=document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

    tableUsuarios = $('#tableUsuarios').dataTable({
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
            "url":" "+base_url+"/Usuarios/getUsuarios",
            "dataSrc":"",
        },
        "columns":[
            { 
             data:"idpersona",
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
             data:"nombrerol",
             defaultContent : ''
            },
             { 
             data:'status',
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
    if (document.querySelector("#formUsuario")){
        let formUsuario = document.querySelector("#formUsuario");
        formUsuario.onsubmit = function(e){
            e.preventDefault();
    
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let intTipoUsuario = document.querySelector('#listRolid').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let intStatus = document.querySelector('#listEstado').value;
            
            if(strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || intTipoUsuario == '')
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
             let ajaxUrl = base_url+'/Usuarios/setUsuario';
             let formData = new FormData(formUsuario);
             request.open("POST",ajaxUrl,true);
             request.send(formData);
    
            
             request.onreadystatechange = function(){
                         //console.log(request.responseText);
                        if(request.readyState == 4 && request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                if(rowTable == ""){
                                    tableUsuarios.api().ajax.reload();
                                }else{
                                    htmlStatus = intStatus == 1 ?
                                    '<span class="badge badge-success">Activo</span>' : 
                                    '<span class="badge badge-danger">Inactivo</span>';
                                    rowTable.cells[1].textContent = strNombre;
                                    rowTable.cells[2].textContent = strApellido;
                                    rowTable.cells[3].textContent = intTelefono;
                                    rowTable.cells[4].textContent = strEmail;
                                    rowTable.cells[5].textContent = document.querySelector("#listRolid").selectedOptions[0].text;
                                    rowTable.cells[6].innerHTML = htmlStatus;
                                }
                                $('#modalFormUsuario').modal("hide");
                                formUsuario.reset();
                                swal("Usuarios", objData.msg,"success");
                            }else{
                                swal("Error", objData.msg,"error");
                            }
                        }
                        divLoading.style.display="none";
                        return false;
            }
    
        }

    }

    // Actualizar Perfil
        if (document.querySelector("#formPerfil")){
        let formPerfil = document.querySelector("#formPerfil");
        formPerfil.onsubmit = function(e){
            e.preventDefault();
    
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
            
            if(strIdentificacion == '' || strApellido == '' || strNombre == '' || intTelefono == '')
            {
                swal("Atencion", "Debe ingresar los campos obligatorios", "error");
                return false;
            }

             if(strPassword != "" || strPasswordConfirm != "")
            {
                if(strPassword != strPasswordConfirm){
                    swal("Atencion", "Las contraseñas deben ser iguales", "info");
                    return false;
                }
                if(strPassword.length < 5){
                    swal("Atencion", "La contraseña deben tener al menos 5 caracteres", "error");
                    return false;
                }
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
             let ajaxUrl = base_url+'/Usuarios/putPerfil';
             let formData = new FormData(formPerfil);
             request.open("POST",ajaxUrl,true);
             request.send(formData);
                
             request.onreadystatechange = function(){
                         //console.log(request.responseText);
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                $('#modalFormPerfil').modal("hide");
                                swal({
                                    title: "",
                                    text: objData.msg,
                                    type: "success",
                                    confirmButtonText: "Aceptar",
                                    closeOnConfirm: false,
                                }, function (isConfirm){
                                    if(isConfirm){
                                        location.reload();
                                    }
                                });
                            }else{
                                swal("Error", objData.msg,"error");
                            }
                        }
                        divLoading.style.display="none";
                        return false;
            }
    
    
        }

    }

        // Actualizar Datos Fiscales
        if (document.querySelector("#formDataFiscal")){
        let formDataFiscal = document.querySelector("#formDataFiscal");
        formDataFiscal.onsubmit = function(e){
            e.preventDefault();
    
            let strNit = document.querySelector('#txtNit').value;
            let strNombreFiscal = document.querySelector('#txtNombreFiscal').value;
            let strDirFiscal = document.querySelector('#txtDirFiscal').value;
            
            if(strNit == '' || strNombreFiscal == '' || strDirFiscal == '')
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
             let ajaxUrl = base_url+'/Usuarios/putDFiscal';
             let formData = new FormData(formDataFiscal);
             request.open("POST",ajaxUrl,true);
             request.send(formData);
                
             request.onreadystatechange = function(){
                         //console.log(request.responseText);
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                $('#modalFormPerfil').modal("hide");
                                swal({
                                    title: "",
                                    text: objData.msg,
                                    type: "success",
                                    confirmButtonText: "Aceptar",
                                    closeOnConfirm: false,
                                }, function (isConfirm){
                                    if(isConfirm){
                                        location.reload();
                                    }
                                });
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
        fntRolesUsuario();
        //fntViewUsuario();
        //fntEditUsuario();
        //fntDelUsuario();
}, false);


function fntRolesUsuario(){
    if(document.querySelector('#listRolid')){
        let ajaxUrl = base_url+'/Roles/getSelectRoles';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();

        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listRolid').innerHTML = request.responseText;
                document.querySelector('#listRolid').value = 1;
                $('#listRolid').selectpicker('render');
            }
        }
    }
}

function fntViewUsuario(idpersona){
 
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
                            document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombrerol;
                            document.querySelector("#celEstado").innerHTML = estadoUsuario;
                            document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro; 
                            $('#modalViewUser').modal('show');
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
            }
}


function fntEditUsuario(element, idpersona){
            rowTable = element.parentNode.parentNode.parentNode;
            //console.log(rowTable);
            document.querySelector('#titleModal').innerHTML= "Actualizar Usuario";
            document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
            document.querySelector('#btnText').innerHTML="Actualizar";

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
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
                            document.querySelector("#listRolid").value = objData.data.idrol;
                            $('#listRolid').selectpicker('render');

                            if(objData.data.status == 1){
                                 document.querySelector('#listEstado').value= 1; 
                            }else{
                                 document.querySelector('#listEstado').value= 2; 
                            }
                            $('#listEstado').selectpicker('render');     
                    }
                     
                }

                 $('#modalFormUsuario').modal('show');
            
        }
}

// Eliminar Usuario

function fntDelUsuario(idpersona){

            swal({
                title: "Eliminar Usuario",
                text: "¿Desea eliminar el usuario?",
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
                    let ajaxUrl = base_url+'/Usuarios/delUsuario';
                    let strData = "idUsuario="+idUsuario;
                    request.open("POST", ajaxUrl,true);
                    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange= function(){
                        if(request.readyState == 4 & request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                swal("Eliminar!",objData.msg,"success");
                                tableUsuarios.api().ajax.reload(function(){
                                    //fntEditUsuario();
                                    //fntViewUsuario();
                                    //fntDelUsuario();
                                    fntRolesUsuario();
                                });
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
       document.querySelector('#titleModal').innerHTML="Nuevo Usuario";
       document.querySelector('#formUsuario').reset();
       $('#modalFormUsuario').modal('show');

}

function openModelPerfil(){
     $('#modalFormPerfil').modal('show');
}