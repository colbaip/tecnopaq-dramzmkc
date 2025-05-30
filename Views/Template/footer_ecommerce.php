    <?php 
		$catFotter = getCatFooter();
	 ?>
	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32 ltext-101"  style="width: 100%; 
								background: url(<?= media() ?>/images/baner_azul.jpg) center center / cover no-repeat; 
								padding: 40px 0;
								color: white;">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-4 p-b-50">
					<h4 class="mtext-105 cl0 p-b-30">
						Categorias
					</h4>

					<?php if(count($catFotter) > 0){ ?>
					<ul>
						<?php foreach ($catFotter as $cat) { ?>
						<li class="p-b-10">
							<a href="<?= base_url() ?>/tienda/categoria/<?= $cat['idcategoria'].'/'.$cat['ruta'] ?>" class="mtext-107 cl7 hov-cl1 trans-04">
								<?= $cat['nombre'] ?>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>

				<div class="col-sm-6 col-lg-4 p-b-50">
					<h4 class="mtext-105 cl0 p-b-30">
						Contacto
					</h4>

					<p class="mtext-107 cl7 size-201">
						<?= DIRECCION ?> <br>
						Tel: <a class="linkFooter" href="tel:<?= TELEFONO ?>"><?= TELEFONO ?></a><br>
						Email: <a class="linkFooter" href="mailto:<?= EMAIL_EMPRESA ?>"><?= EMAIL_EMPRESA ?></a>
					</p>

					<div class="p-t-27">
						<a href="<?= FACEBOOK ?>" target="_blanck" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="<?= INSTAGRAM ?>" target="_blanck"  class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="htpps://wa.me/<?= WHATSAPP ?>" target="_blanck"  class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fab fa-whatsapp"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-4 p-b-50">
				<h4 class="mtext-105 cl0 p-b-30">
						Suscríbete
					</h4>

					<form id="frmSuscripcion" name="frmSuscripcion">
						<div class="mtext-107 wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" id="nombreSuscripcion" name="nombreSuscripcion" placeholder="Nombre completo" required>
							<div class="focus-input1 trans-04"></div>
						</div>
						<br>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="email" id="emailSuscripcion" name="emailSuscripcion" placeholder="email@example.com" required >
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m mtext-107 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Suscribirme
							</button>
						</div>
				</div>
			</div>

			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="<?= media()?>/ecommerce/images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="<?= media()?>/ecommerce/images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="<?= media()?>/ecommerce/images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="<?= media()?>/ecommerce/images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="<?= media()?>/ecommerce/images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>

	<!-- WHATSAPP-->
	<section id="whatsapp">
		<a href="https://wa.me/5491123014335" target="_blank">
			<img class="hov-img0" src="<?= media()?>/images/uploads/WhatsApp.png" alt="ICON-WHATSAPP">
		</a>
	</section>
	
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<script>
		const base_url = "<?= base_url(); ?>";
		const smoney = "<?= SMONEY; ?>";
	</script>
<!--===============================================================================================-->	
	<script src="<?= media()?>/ecommerce/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= media()?>/ecommerce/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= media()?>/ecommerce/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/slick/slick.min.js"></script>
	<script src="<?= media()?>/ecommerce/js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/parallax100/parallax100.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/js/main.js"></script>
<!--===============================================================================================-->
	<script src="<?= media(); ?>/js/fontawesome.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/js/functions_admin.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/js/functions_login.js"></script>
<!--===============================================================================================-->
	<script src="<?= media()?>/ecommerce/js/function.js"></script>
<!--===============================================================================================-->


</body>
</html>