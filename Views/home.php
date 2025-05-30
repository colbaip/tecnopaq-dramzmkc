	
	
	<?php
		headerEcommerce($data);
		$arrSlider = $data['slider'];
		$arrBanner = $data['banner'];
		$arrProductos = $data['productos'];
		#dep($arrProductos);
	?>
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">

            <!-- Slide 1 -->
            <div class="item-slick1" style="background-image: url(<?= media() ?>/images/nube0.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-101 cl0 respon2">
                                Bienvenidos a TecnoOptic
                            </span>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-101 cl0 p-t-19 p-b-43 respon1">
                                Calidad en cada conexión, potencia en cada señal.
                            </h2>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
							 <a href="<?= base_url() ?>/contacto" class="flex-c-m stext-100 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Contáctanos
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="item-slick1" style="background-image: url(<?= media() ?>/images/Fondo_QSFP.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-101 cl2 respon2">
                                Soluciones avanzadas en telecomunicaciones
                            </span>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-101 cl2 p-t-19 p-b-43 respon1">
                                Equipos certificados y tecnología de vanguardia
                            </h2>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
							 <a href="<?= base_url() ?>/tienda" class="flex-c-m stext-100 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Ver productos
                           
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section>
	<!-- Categoria -->
	<div class="sec-banner bg0 p-t-80 p-b-20">
		<div class="container">
				
			<div class="row">
				<?php 
					for ($j=0; $j < count($arrBanner); $j++) { 
						$ruta = $arrBanner[$j]['ruta']
						# code...
				?>
				<div class="col-md-6 col-xl-3 p-b-30 m-lr-auto">
					<!-- Block1 -->

					<div class="block1 wrap-pic-w">
						<img src="<?= $arrBanner[$j]['portada'] ?>" alt="<?= $arrBanner[$j]['nombre'] ?>">

						<a href="<?= base_url().'/tienda/categoria/'.$arrBanner[$j]['idcategoria'].'/'.$ruta ?>" class="block1-txt ab-t-l s-full  flex-col-l-sb p-lr-38 p-tb-5 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name mtext-105 trans-04 p-b-8" style="color: #808080;">
									<?= $arrBanner[$j]['nombre'] ?>
								</span>

								<!--span class="block1-info stext-102 trans-04">
									<?= $arrBanner[$j]['nombre'] ?>
								</span-->
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-100 cl0 trans-09">
									Ver Productos
								</div>
							</div>
						</a>
					</div>

				</div>
				<?php 
				}?>

			</div>
		</div>
	</div>
</section>


	<!-- Product -->
	<section class="bg0 p-t-40 p-b-60">
		<div class="container">



					<div style="width: 100%; 
								background: url(<?= media() ?>/images/baner_stock.jpg) center center / cover no-repeat; 
								padding: 50px 0;
								color: white;">
						<div class="container">
							<div class="soporte-telecom" style="text-align: justify;">
								<h1 class="ltext-101 cl0 p-b-16">
									Productos en Stock
								</h1>
							</div>
						</div>
					</div>
				



			<div class="row isotope-grid p-t-40">
				<?php 
				for ($p=0; $p < count($arrProductos); $p++) { 
					$ruta=$arrProductos[$p]['ruta'];
					if(count($arrProductos[$p]['images']) > 0){
						$portada = $arrProductos[$p]['images'][0]['url_image'];
					}else{
						$portada = media().'/images/uploads/no-img.jpg';
					}
				
				?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block1 block2-pic hov-img0">
							<img src="<?= $portada ?>" height="250" alt="<?php $arrProductos[$p]['nombre']?>">
							<a href="<?= base_url().'/tienda/producto/'.$arrProductos[$p]['idproducto'].'/'.$ruta; ?>" class="block2-btn flex-c-m stext-100 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04">
								Ver producto
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="<?= base_url().'/tienda/producto/'.$arrProductos[$p]['idproducto'].'/'.$ruta; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?= $arrProductos[$p]['nombre']?>
								</a>

								<span class="stext-105 cl3">
									<?= SMONEY.formatMoney($arrProductos[$p]['precio'])?>
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" 
								 id="<?= openssl_encrypt($arrProductos[$p]['idproducto'],METHODENCRIPT,KEY); ?>"
								 class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-addcart-detail
								 		icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
									<i class="zmdi zmdi-shopping-cart"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php 
				}?>
			</div>

			<!-- Load more -->


			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="<?=base_url() ?>/tienda" class="flex-c-m stext-100 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
					Ver más
				</a>
			</div>
			
		</div>

	</section>
<hr>
	<!-- MisionyVision -->
	<section class="bg0 p-t-100 p-b-40">
		
		<div class="container">
			<div class="row">
					<div class="order-md-2 col-md-7 col-lg-8 p-b-30">
						<div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
							<div class="soporte-telecom" style="text-align: justify;">
							<h2 class="ltext-101 cl2 p-b-16  text-primary"><span style="color: #808080;">Tecnología confiable</span></h2>
							
							<p class="lead ltext-100">

								Nuestros productos est&aacute;n dise&ntilde;ados bajo los est&aacute;ndares m&aacute;s altos del sector, asegurando un rendimiento eficiente y confiable en cualquier entorno de telecomunicaciones. Cada componente pasa por un proceso riguroso de validaci&oacute;n en equipos reales, garantizando su compatibilidad total con m&uacute;ltiples plataformas y dispositivos del mercado. Este proceso incluye la evaluaci&oacute;n en entornos simulados de alta precisi&oacute;n, pruebas pr&aacute;cticas en sistemas y equipos reales, as&iacute; como un control de calidad integral orientado a maximizar la eficiencia operativa.</div>
							</p>								
						</div>
					</div>
					<div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
						<div class="how-bor2">
							<div class="hov-img0"><img src="<?=media() ?>/images/F_labratorio.jpg" alt="" width="500" height="280"></div>
							</div>
						</div>
					</div>
				<br>
				<br>
				<br>
				<div class="row p-b-50">
						<div class="col-md-7 col-lg-8">
							<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
							<h2 class="ltext-101 cl2 p-b-16 text-primary"><span style="color: #808080;">Excelencia en las entregas</span></h2>
								<p class="lead ltext-100" style="text-align: justify;">
									Gracias a nuestra gran disponibilidad de stock y a una gestión inteligente del inventario, contamos con una amplia gama de productos siempre listos para ser enviados el mismo día. Nuestra rápida preparación de pedidos y la inmediatez en nuestras cotizaciones permiten que encuentres el producto ideal de forma sencilla y segura. Solo necesitas seleccionarlo en línea, confirmar su precio y realizar tu orden; desde ese momento, te garantizamos una entrega ágil y eficiente. Todo esto, respaldado por nuestra atención rápida y personalizada, hace que tu experiencia de compra sea realmente fluida y satisfactoria.                                        
								</p>
							</div>
						</div>
					
						<div class="col-11 col-md-5 col-lg-4 m-lr-auto">
							<div class="how-bor1 shadow-sm rounded overflow-hidden">
								<div class="hov-img0">
									<img src="<?=media() ?>/images/F_bodega.jpg" alt="Laboratorio de fibra óptica" class="img-fluid" width="500" height="333">
								</div>
							</div>
						</div>
					</div>
				
			</div>
		</div>		
										
    </section>

	<!--Numeros -->
	<section class="container my-5">
	

				<div class="row text-center border-top p-t-40">
					<div class="col-6 col-md-3 mb-4">
						<div class="border-bottom mb-3">
							<img src="<?=media() ?>/iconos/experiencia.png" width="50" height="50" alt="Experiencia">
						</div>
					<h2 class="counter" data-count="15">0</h2>
					<p class="text-muted">Años de Experiencia</p>
					</div>
					<div class="col-6 col-md-3 mb-4">
						<div class="border-bottom mb-3">
							<img src="<?=media() ?>/iconos/Porcentaje3.png" width="50" height="50" alt="Compatibilidad">
						</div>
					<h2 class="counter" data-count="99.9">0</h2>
					<p class="text-muted">Compatibilidad Multivendor</p>
					</div>
					<div class="col-6 col-md-3 mb-4">
						<div class="border-bottom mb-3">
							<img src="<?=media() ?>/iconos/test2.png" width="50" height="50" alt="Test">
						</div>
					<h2 class="counter" data-count="50">0</h2>
					<p class="text-muted">Pruebas de Testeo</p>
					</div>
					<div class="col-6 col-md-3 mb-4">
						<div class="border-bottom mb-3">
							<img src="<?=media() ?>/iconos/producto1.png" width="50" height="50" alt="Producto">
						</div>
					<h2 class="counter" data-count="1000">0</h2>
					<p class="text-muted">Productos en Stock</p>
					</div>
				</div>
	</section>

<hr>
<!-- Certificacicones -->
<section>
<div class="container text-center p-t-60 p-b-60">
	<h2 class="ltext-101 cl2 p-b-16  text-primary"><span style="color: #808080;">Certificaciones y estándares de calidad</span></h2>
	<p class="lead ltext-100" style="text-align: justify;">
		En TecnoPaq, nos comprometemos a ofrecer productos de la más alta calidad, respaldados por certificaciones reconocidas a nivel internacional. Estas certificaciones reflejan nuestro compromiso con la excelencia y la sostenibilidad en cada uno de nuestros productos.
	</p>
	<br>
    <!-- Fila con imágenes distribuidas -->
    <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: 2rem;">
        <img src="<?=media() ?>/iconos/products_iso9001.svg" width="50" height="50" alt="Logo Marca Tecnopaq">
        <img src="<?=media() ?>/iconos/products_ce.svg" width="50" height="50" alt="Logo Marca CE">
        <img src="<?=media() ?>/iconos/products_fc.svg" width="50" height="50" alt="Logo Marca TecnoOptic">
        <img src="<?=media() ?>/iconos/products_iso14001.svg" width="50" height="50" alt="Logo Marca Cisco">
        <img src="<?=media() ?>/iconos/products_reach.svg" width="50" height="50" alt="Logo Marca Reach">
        <img src="<?=media() ?>/iconos/products_rohs.svg" width="50" height="50" alt="Logo Marca RoHS">
        <img src="<?=media() ?>/iconos/MSA_logo.png" width="50" height="50" alt="Logo MSA">
    </div>
	<br>
	<br>
</div>
</section>
	
	<script>
  document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll('.counter');
    const speed = 100;

    const animateCounter = (counter) => {
      const target = +counter.getAttribute('data-count');
      let count = 0;
      const increment = Math.ceil(target / speed);

      const update = () => {
        if (count < target) {
          count += increment;
          counter.innerText = count.toLocaleString();
          requestAnimationFrame(update);
        } else {
          counter.innerText = target.toLocaleString();
        }
      };

      counter.innerText = '0'; // Reinicia
      update();
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
        }
      });
    }, { threshold: 0.6 });

    counters.forEach(counter => {
      observer.observe(counter);
    });
  });
</script>


|
<?php 
	footerEcommerce($data);

?>