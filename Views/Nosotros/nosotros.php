<?php
		headerEcommerce($data);
		#$arrSlider = $data['slider'];
		//$banner = media()."/ecommerce/images/bg-01.jpg";
		$banner = $data['page']['portada'];
 		$idpagina = $data['page']['idpagina'];

?>
<script>
        document.querySelector('header').classList.add('header-v4');
</script>


<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner ?>);">
		<h2 class="ltext-105 cl0 txt-center">
			<?= $data['page']['titulo'] ?>
		</h2>
	</section>	

    
	<!-- Content page -->
	<?php
		//dep($data['page']);
		if(viewPage($idpagina)){
			echo $data['page']['contenido'];
		}else{
	?>
	<div>
		<div class="container-fluid py-5 text-center" >
			<img src="<?= media() ?>/images/construction.png" alt="En construcción">
			<h3>Estamos trabajando para usted.</h3>
		</div>
	</div>
<?php 
		}	
	footerEcommerce($data);

?>