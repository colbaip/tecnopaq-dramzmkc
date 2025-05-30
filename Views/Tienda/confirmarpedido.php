		
	<?php
		headerEcommerce($data);
		#$arrSlider = $data['slider'];
		#$arrBanner = $data['banner'];

	?>
	<br><br><br>
    <div class="jumbotron text-center">
        <h1 class="display-4">¡Gracias, por tu compra !</h1>
        <br>
        <p class="lead">Tu pedido fue procesado con éxito.</p>
        <br>
        <p>Nro. Orden: <strong><?= $data['orden']; ?></strong></p>
        <?php 
            if(!empty($data['transaccion'])){
        ?>
        <p>Transacción: <strong> <?= $data['transaccion']; ?> </strong></p>
        <?php } ?>

        <hr class="my-4">
        <p>Lo estaremos contactando para cordinar la entrega.</p>
        <p>Podra ver el estado de su pedido desde la seccion pedidos de tu usuario.</p>
        <br>
        <a class="btn btn-primary btn-lg" href="<?= base_url(); ?>" role="button">Continuar</a>
    </div>
        
<?php 
	footerEcommerce($data);

?>