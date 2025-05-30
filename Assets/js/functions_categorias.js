let tableCategorias;
let rowTable="";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded',function(){

        tableCategorias = $('#tableCategorias').dataTable({
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
            "url":" "+base_url+"/Categorias/getCategorias",
            "dataSrc":"",
        },
        "columns":[
            { 
             data:"idcategoria",
             defaultContent : ''
            },
            { 
             data:"nombre",
             defaultContent : ''
            },
            { 
             data:'descripcion',
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


        if(document.querySelector("#foto")){
            let foto = document.querySelector("#foto");
            foto.onchange = function(e) {
                let uploadFoto = document.querySelector("#foto").value;
                let fileimg = document.querySelector("#foto").files;
                let nav = window.URL || window.webkitURL;
                let contactAlert = document.querySelector('#form_alert');
                if(uploadFoto !=''){
                    let type = fileimg[0].type;
                    let name = fileimg[0].name;
                    if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                        contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                        if(document.querySelector('#img')){
                            document.querySelector('#img').remove();
                        }
                        document.querySelector('.delPhoto').classList.add("notBlock");
                        foto.value="";
                        return false;
                    }else{  
                            contactAlert.innerHTML='';
                            if(document.querySelector('#img')){
                                document.querySelector('#img').remove();
                            }
                            document.querySelector('.delPhoto').classList.remove("notBlock");
                            let objeto_url = nav.createObjectURL(this.files[0]);
                            document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
                        }
                }else{
                    alert("No selecciono foto");
                    if(document.querySelector('#img')){
                        document.querySelector('#img').remove();
                    }
                }
            }
        }

        if(document.querySelector(".delPhoto")){
            let delPhoto = document.querySelector(".delPhoto");
            delPhoto.onclick = function(e) {
                document.querySelector("#foto_remove").value= 1;
                removePhoto();
            }
        }

        //NUEVA CATEGORIA
  
        let formCategoria = document.querySelector("#formCategoria");
        formCategoria.onsubmit= function(e) {
            
            e.preventDefault();
        
            let strNombre = document.querySelector('#txtNombre').value;
            let strDescripcion = document.querySelector('#txtDescripcion').value;
            let intStatus = document.querySelector('#listEstado').value;        
            if(strNombre == '' || strDescripcion == '' || intStatus == '' )
            {
                swal("Atencion","Todos los campos son obligatorios.", "error");
                return false;
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Categorias/setCategoria'; 
            let formData = new FormData(formCategoria);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                    
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        if(rowTable == "" ){
                            tableCategorias.api().ajax.reload();
                        }else{
                            htmlStatus = intStatus == 1 ?
                            '<span class="badge badge-success">Activo</span>' : 
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strNombre;
                            rowTable.cells[2].textContent = strDescripcion;
                            rowTable.cells[3].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormCategoria').modal("hide");
                        formCategoria.reset();
                        swal("Categoria", objData.msg ,"success");
                        removePhoto();
                    }else{
                        swal("Error", objData.msg , "error");
                    }              
                } 
                divLoading.style.display="none";
                return false;
            }
        
        };
     

}, false);

function removePhoto(){
    document.querySelector('#foto').value ="";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if(document.querySelector('#img')){
        document.querySelector('#img').remove();
    }
    
}


function openModal(){
       rowTable="";
       document.querySelector('#idCategoria').value="";
       document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
       document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
       document.querySelector('#btnText').innerHTML="Guardar";
       document.querySelector('#titleModal').innerHTML="Nueva Categoria";
       document.querySelector('#formCategoria').reset();
       $('#modalFormCategoria').modal('show');
       removePhoto();

}

// Muestra un cliente

function fntViewCategoria(idcategoria){
             let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Categorias/getCategoria/'+idcategoria;
            request.open("GET",ajaxUrl,true);
            request.send();
            console.log('ObjectData',request.responseText);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);

                    if(objData.status)
                    {
                        
                             let estadoCategoria = objData.data.status == 1 ? 
                            '<span class="badge badge-success">Activo</span>' : 
                            '<span class="badge badge-danger">Inactivo</span>';

                            document.querySelector("#celId").innerHTML = objData.data.idcategoria;
                            document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                            document.querySelector("#celDescripcion").innerHTML = objData.data.descripcion;
                            document.querySelector("#celEstado").innerHTML = estadoCategoria;
                            document.querySelector("#imgCategoria").innerHTML = '<img src="'+objData.data.url_portada+'"></img>';
                            
                            $('#modalViewCategoria').modal('show');
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
            }
}



// Actualiza un cliente

function fntEditCategoria(element, idcategoria){
            rowTable = element.parentNode.parentNode.parentNode;
            //console.log(rowTable);
            document.querySelector('#titleModal').innerHTML= "Actualizar Categoria";
            document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
            document.querySelector('#btnText').innerHTML="Actualizar";

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Categorias/getCategoria/'+idcategoria;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);

                    if(objData.status)
                    {       /*
                             let estadoCategoria = objData.data.status == 1 ? 
                            '<span class="badge badge-success">Activo</span>' : 
                            '<span class="badge badge-danger">Inactivo</span>';
                            */
                            document.querySelector("#idCategoria").value = objData.data.idcategoria;
                            document.querySelector("#txtNombre").value = objData.data.nombre;
                            document.querySelector("#txtDescripcion").value = objData.data.descripcion;
                            //document.querySelector("#listEstado").innerHTML = estadoCategoria;
                            document.querySelector("#foto_actual").value = objData.data.portada;
                            document.querySelector("#foto_remove").value = 0;
                            // $('#listRolid').selectpicker('render');

                            if(objData.data.status == 1){
                                 document.querySelector('#listEstado').value= 1; 
                            }else{
                                 document.querySelector('#listEstado').value= 2; 
                            }
                            $('#listEstado').selectpicker('render');
                            if(document.querySelector ('#img')){
                                 document.querySelector('#img').src= objData.data.url_portada; 
                            }else{
                                 document.querySelector(".prevPhoto div").innerHTML = "<img id='img' src="+objData.data.url_portada+">";
                            }
                            if(objData.data.portada =='portada_categoria.png'){
                                 document.querySelector('.delPhoto').classList.add("notBlock"); 
                            }else{
                                 document.querySelector('.delPhoto').classList.remove("notBlock"); 
                            }
                            
                            
                            $('#modalFormCategoria').modal('show');    
                            
                            
                    }else{
                         swal("Error!",objData.msg,"error")
                    }    
                }
        }
}


// Eliminar Categoria

function fntDelCategoria(idcategoria){

            swal({
                title: "Eliminar Categoria",
                text: "¿Desea eliminar la categoria?",
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
                    let ajaxUrl = base_url+'/Categorias/delCategoria';
                    let strData = "idCategoria="+idcategoria;
                    request.open("POST", ajaxUrl,true);
                    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange= function(){
                        if(request.readyState == 4 & request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                swal("Eliminar!",objData.msg,"success");
                                tableCategorias.api().ajax.reload();
                            }else{
                                swal("Atencion!",objData.msg,"error")
                            }
                        }
                    }
                }
              
            });
}
