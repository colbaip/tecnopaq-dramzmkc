<!-- Modal -->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Actualizr Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formPerfil" name="formPerfil" class="form-horizontal">
            <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="txtIdentificacion">Identificacion <span class="required">*</span></label>
                <input class="form-control" id="txtIdentificacion" name="txtIdentificacion" value="<?= $_SESSION['userData']['identificacion']; ?>"type="text" required="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="txtNombre">Nombres <span class="required">*</span></label>
                <input class="form-control valid validText" id="txtNombre" name="txtNombre" value="<?= $_SESSION['userData']['nombres']; ?>" type="text" required="">
            </div>
            <div class="form-group col-md-6">
                <label class="txtApellido">Apellido <span class="required">*</span></label>
                <input class="form-control valid validText" id="txtApellido" name="txtApellido" value="<?= $_SESSION['userData']['apellidos']; ?>" type="text" required="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="txtTelefono">Telefono <span class="required">*</span></label>
                <input class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" value="<?= $_SESSION['userData']['telefono']; ?>" type="text" required=""
                onkeypress="return controlTag(event);">
            </div>
            <div class="form-group col-md-6">
                <label class="txtEmail">Email</label>
                <input class="form-control valid validEmail" id="txtEmail" name="txtEmail" value="<?= $_SESSION['userData']['email_user']; ?>"
                readonly disabled type="email" required="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="txtPassword">Password</label>
                <input class="form-control" id="txtPassword" name="txtPassword" type="password">
            </div>
            <div class="form-group col-md-6">
                <label class="txtPasswordConfirm">Confirmar Password</label>
                <input class="form-control" id="txtPasswordConfirm" name="txtPasswordConfirm" type="password">
            </div>
        </div>

            <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-info" type="submit">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                    <span id="btnText">Actualizar</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <i class="fa fa-fw fa-lg fa-times-circle-o"></i>
                    <span id="btnText">Cerrar</span>
                </button>

            </div>
            </form>
      </div>
    </div>
  </div>
</div>
