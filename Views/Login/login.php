<html lang="es">
    
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Mauricio Armoa">
    <meta name="theme-color" content="#009688">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= media();?>/images/favicon.ico">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/style.css">
  <title><?= $data['page_tag']; ?></title>
  </head>
  <body>
    <div class="pace-activity"></div>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1><?= $data['page_title']; ?></h1>
      </div>
      <div class="login-box">
        <div id="divLoading">
          <div>
            <img src="<?= media();?>/images/loading.svg" alt="Cargando...">
          </div>
        </div>
        <form class="login-form" name="formLogin" id="formLogin" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Iniciar Session</h3>
          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input id="txtEmail" name="txtEmail" class="form-control" type="email" placeholder="Email" autofocus="">
          </div>
          <div class="form-group">
            <label class="control-label">CONSTRASEÑA</label>
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Constraseña">
          </div>
          <div class="form-group">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste Constraseña ?</a></p>
            </div>
          </div>
          <div id="alertLogin" class="text-center"></div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in-alt"></i>Iniciar Session</button>
          </div>
        </form>
        <form class="forget-form" id="formResetPass" name="formResetPass" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste Constraseña ?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar Session</a></p>
          </div>
        </form>
      </div>
    </section>
     <script>
        const base_url = "<?= base_url();?>";
     </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media();?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media();?>/js/popper.min.js"></script>
    <script src="<?= media();?>/js/bootstrap.min.js"></script>
    <script src="<?= media();?>/js/fontawesome.js"></script>
    <script src="<?= media();?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media();?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= media();?>/js/<?= $data['page_functions_js']; ?>"></script>
  
</body></html>