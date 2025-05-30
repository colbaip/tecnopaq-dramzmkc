document.write(`<script src="${base_url}/Assets/js/plugins/JsBarcode.all.min.js"></script>`);
let tableProductos;
let rowTable = "";

$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

tableProductos = $('#tableProductos').dataTable({
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
            "url":" "+base_url+"/Productos/getProductos",
            "dataSrc":"",
        },
        "columns":[
            { 
             data:"idproducto",
             defaultContent : ''
            },
            { 
             data:"codigo",
             defaultContent : ''
            },
            { 
             data:"nombre",
             defaultContent : ''
            },
            { 
             data:'stock',
             defaultContent : ''
            },
                        { 
             data:'precio',
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
                "className": "btn btn-secondary",
                "exportOptions":{
                    "columns":[0,1,2,3,4,5]
                }
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success",
                "exportOptions":{
                    "columns":[0,1,2,3,4,5]
                }
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger",
                "exportOptions":{
                    "columns":[0,1,2,3,4,5]
                }
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info",
                "exportOptions":{
                    "columns":[0,1,2,3,4,5]
                }
            }
        ],
        "resonsieve":"true",
        "destroy": true,
        "displayLength": 10,
        "order":[[0,"desc"]]
        
});

window.addEventListener('load',function() {
    if (document.querySelector("#formProducto")){
    let formProducto = document.querySelector("#formProducto");
    formProducto.onsubmit = function(e){
        e.preventDefault();
        let strNombre = document.querySelector('#txtNombre').value;
        let intCodigo = document.querySelector('#txtCodigo').value;
        let strPrecio = document.querySelector('#txtPrecio').value;
        let intStock = document.querySelector('#txtStock').value;
        let intStatus = document.querySelector('#listEstado').value;
        
        if(strNombre == '' || intCodigo == '' || strPrecio == '' || intStock == '')
        {
            swal("Atencion", "Debe ingresar los campos obligatorios", "error");
            return false;
        }
        if(intCodigo.length < 5){
            swal("Atencion", "El código debe ser mayor de 5 digitos", "error");
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
            let ajaxUrl = base_url+'/Productos/setProducto';
            let formData = new FormData(formProducto);
            request.open("POST",ajaxUrl,true);
            request.send(formData);

        
            request.onreadystatechange = function(){
                    //console.log(request.responseText);
                    if(request.readyState == 4 && request.status == 200){
                        let objData = JSON.parse(request.responseText);
                        //console.log(objData);
                        //console.log(objData.status);
                        //die();
                        if(objData.status)
                        {
                            swal("", objData.msg ,"success");
                            document.querySelector("#idProducto").value = objData.idproducto;
                            document.querySelector("#containerGallery").classList.remove("notBlock");

                            if(rowTable == ""){
                                tableProductos.api().ajax.reload();
                            }else{
                            htmlStatus = intStatus == 1 ? 
                                '<span class="badge badge-success">Activo</span>' : 
                                '<span class="badge badge-danger">Inactivo</span>';
                                rowTable.cells[1].textContent = intCodigo;
                                rowTable.cells[2].textContent = strNombre;
                                rowTable.cells[3].textContent = intStock;
                                rowTable.cells[4].textContent = smony+strPrecio;
                                rowTable.cells[5].innerHTML =  htmlStatus;
                                rowTable = ""; 
                            }
                        }else{
                            swal("Error", objData.msg,"error");
                        }
                    }
                    divLoading.style.display="none";
                    return false;
    }
}
    }

    if (document.querySelector(".btnAddImage")){
            let btnAddImage = document.querySelector(".btnAddImage")
            btnAddImage.onclick = function(e){
            let key = Date.now();
            let newElement = document.createElement("div");
            newElement.id= "div"+key;
            newElement.innerHTML=`
                        <div class="prevImage"></div>
                        <input type="file" name="foto" id="img${key}" class="inputUploadfile">
                        <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload"></i></label>
                        <button class="btnDeleteImage notBlock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
            document.querySelector("#containerImages").appendChild(newElement);           
            document.querySelector("#div"+key+" .btnUploadfile").click();      
            fntInputFile();
        }
    }

    fntInputFile();
    fntCategorias();

}, false);

if(document.querySelector("#txtCodigo")){
    let inputCodigo = document.querySelector("#txtCodigo");
    inputCodigo.onkeyup = function(){
        if(inputCodigo.value.length >=5){
            document.querySelector('#divBarCode').classList.remove("notBlock");
            fntBarcode();
        }else{
            document.querySelector('#divBarCode').classList.add("notBlock");
        }
    }
}

tinymce.init({
    selector: '#txtDescripcion',
    width: "100%",
    height: 400,    
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});

function fntInputFile(){
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function(){
            let idProducto = document.querySelector("#idProducto").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");            
            let uploadFoto = document.querySelector("#"+idFile).value;
            let fileimg = document.querySelector("#"+idFile).files;
            let prevImg = document.querySelector("#"+parentId+" .prevImage");
            let nav = window.URL || window.webkitURL;
            if(uploadFoto !=''){
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                }else{
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'/Productos/setImage'; 
                    let formData = new FormData();
                    formData.append('idproducto',idProducto);
                    formData.append("foto", this.files[0]);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);
                    request.onreadystatechange = function(){
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status){
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",objData.imgname);
                                document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notBlock");
                                document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notBlock");
                            }else{
                                swal("Error", objData.msg , "error");
                            }
                        }
                    }

                }
            }

        });
    });
}

function fntDelItem(element){
    let nameImg = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
    let idProducto = document.querySelector("#idProducto").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/delFile'; 

    let formData = new FormData();
    formData.append('idproducto',idProducto);
    formData.append("file",nameImg);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            }else{
                swal("", objData.msg , "error");
            }
        }
    }
}

function fntViewProducto(idProducto){
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objProducto = objData.data;
                let estadoProducto = objProducto.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celCodigo").innerHTML = objProducto.codigo;
                document.querySelector("#celNombre").innerHTML = objProducto.nombre;
                document.querySelector("#celPrecio").innerHTML = objProducto.precio;
                document.querySelector("#celStock").innerHTML = objProducto.stock;
                document.querySelector("#celCategoria").innerHTML = objProducto.categoria;
                document.querySelector("#celStatus").innerHTML = estadoProducto;
                document.querySelector("#celDescripcion").innerHTML = objProducto.descripcion;

                if(objProducto.images.length > 0){
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        htmlImage +=`<img src="${objProductos[p].url_image}"></img>`;
                    }
                }
                document.querySelector("#celFotos").innerHTML = htmlImage;
                $('#modalViewProducto').modal('show');

            }else{
                swal("Error", objData.msg , "error");
            }
        }
    } 
}

function fntEditProducto(element,idProducto){
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Producto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objProducto = objData.data;
                document.querySelector("#idProducto").value = objProducto.idproducto;
                document.querySelector("#txtNombre").value = objProducto.nombre;
                document.querySelector("#txtDescripcion").value = objProducto.descripcion;
                document.querySelector("#txtCodigo").value = objProducto.codigo;
                document.querySelector("#txtPrecio").value = objProducto.precio;
                document.querySelector("#txtStock").value = objProducto.stock;
                document.querySelector("#listCategoria").value = objProducto.categoriaid;
                document.querySelector("#listEstado").value = objProducto.status;
                tinymce.activeEditor.setContent(objProducto.descripcion); 
                $('#listCategoria').selectpicker('render');
                $('#listEstado').selectpicker('render');
                fntBarcode();

                if(objProducto.images.length > 0){
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        let key = Date.now()+p;
                        htmlImage +=`<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objProductos[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage; 
                document.querySelector("#divBarCode").classList.remove("notBlock");
                document.querySelector("#containerGallery").classList.remove("notBlock");           
                $('#modalFormProducto').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntDelProducto(idProducto){
    swal({
        title: "Eliminar Producto",
        text: "¿Realmente quiere eliminar el producto?",
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
            let ajaxUrl = base_url+'/Productos/delProducto';
            let strData = "idProducto="+idProducto;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableProductos.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}



function fntCategorias(){
    if(document.querySelector('#listCategoria')){
            let ajaxUrl = base_url+'/Categorias/getSelectCategorias';
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status == 200){
                    document.querySelector("#listCategoria").innerHTML = request.responseText;
                    $('#listCategoria').selectpicker('render');
                }
            }
    }
}

function fntBarcode(){
    let codigo = document.querySelector("#txtCodigo").value;
    JsBarcode("#barcode", codigo);
}


function fntPrintBarcode(area){
    let elementArea = document.querySelector(area);
    let vprint = window.open('', 'popimpr', 'height=400,width=600');
    vprint.document.write(elementArea.innerHTML);
    vprint.document.close;
    vprint.print();
    vprint.close;
}


function openModal(){
       rowTable="";
       document.querySelector('#idProducto').value="";
       document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
       document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
       document.querySelector('#btnText').innerHTML="Guardar";
       document.querySelector('#titleModal').innerHTML="Nuevo Producto";
       document.querySelector('#formProducto').reset();
       document.querySelector("#divBarCode").classList.add("notBlock");
       document.querySelector("#containerGallery").classList.add("notBlock");
       document.querySelector("#containerImages").innerHTML = "";
       $('#modalFormProducto').modal('show');

}
