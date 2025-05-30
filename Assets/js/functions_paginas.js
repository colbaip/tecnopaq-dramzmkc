
let tablePaginas;
let rowTable = "";

// $(document).on('focusin', function(e) {
//     if ($(e.target).closest(".tox-dialog").length) {
//         e.stopImmediatePropagation();
//     }
// });

tablePaginas = $('#tablePaginas').dataTable({
        columnDefs:[
                {'className':"textcenter","targets":[3]},
                {'className':"textright","targets":[4]},
                {'className':"textcenter","targets":[5]},
                {"defaultContent":"-"},
                {"targets":"_all"},
           
        ],
        "processing":true,
        "derverside":true,
        "language": {
            "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url":" "+base_url+"/paginas/getPaginas",
            "dataSrc":"",
        },
        "columns":[
            { 
             data:"idpagina",
             defaultContent : ''
            },
            { 
             data:"titulo",
             defaultContent : ''
            },
            { 
             data:"fecha",
             defaultContent : ''
            },
            { 
             data:'opcion', 
             defaultContent : ''
            }

        ],"columnDefs":
        [
            {'className':"textcenter","targets":[2]},
            {'className':"textrigth","targets":[3]}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary",
                "exportOptions":{
                    "columns":[0,1,2]
                }
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success",
                "exportOptions":{
                    "columns":[0,1,2]
                }
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger",
                "exportOptions":{
                    "columns":[0,1,2]
                }
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info",
                "exportOptions":{
                    "columns":[0,1,2]
                }
            }
        ],
        "resonsieve":"true",
        "destroy": true,
        "displayLength": 10,
        "order":[[0,"desc"]]
        
});

tinymce.init({
    selector: '#txtContenido',
    width: "100%",
    height: 600,    
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});

if (document.querySelector("#formPagina")){
    let formPagina = document.querySelector("#formPagina");
    formPagina.onsubmit = function(e){
        e.preventDefault();
        let strNombre = document.querySelector('#txtTitulo').value;
        let strContenido = document.querySelector('#txtContenido').value;
        let intStatus = document.querySelector('#listEstado').value;
        
        if(strNombre == '' || strContenido == '' || intStatus == '')
        {
            swal("Atencion", "Debe ingresar los campos obligatorios", "error");
            return false;
        }
        divLoading.style.display = "flex";
        tinymce.triggerSave();
        /*
        let elementsValid = document.getElementsByClassName("valid");
        for (let i =0; i < elementsValid.length; i++){
            if(elementsValid[i].classList.contains('is-invalid')) {
                swal("Atencion", "Por favor verificar los campos en rojo", "error");
                return false;
            }

        }
        */
        let request = (window.XMLHttpRequest) ?
                    new XMLHttpRequest() :
                    new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Paginas/setPagina';
        let formData = new FormData(formPagina);
        request.open("POST",ajaxUrl,true);
        request.send(formData);

        
        request.onreadystatechange = function(){
            //console.log(request.responseText);
            if(request.readyState == 4 && request.status == 200){
                //console.log(request.responseText)
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    swal({
                        title: "",
                        text: objData.msg,
                        type: "success",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false,
                    }, function(isConfirm) {
                            location.reload();
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
        if(document.querySelector("#foto_remove")){
            document.querySelector("#foto_remove").value= 1;
        }
        removePhoto();
    }
}

function removePhoto(){
    document.querySelector('#foto').value ="";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if(document.querySelector('#img')){
        document.querySelector('#img').remove();
    }
    
}


function fntDelPagina(idpagina){
    swal({
        title: "Eliminar Página",
        text: "¿Realmente quiere eliminar la página?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Paginas/delPagina';
            let strData = "idPagina="+idpagina;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tablePaginas.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}