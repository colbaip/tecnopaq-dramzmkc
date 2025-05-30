<?php 
$orden = $data['pedido']['orden'];
$detalle = $data['pedido']['detalle'];


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Compra</title>
    <style type="text/css">
        p{ font-family: Arial;letter-spacing: 1px;color: #7f7f7f; font-size: 12px;}
        hr{border: 0;border-top: 1px solid #ccc;}
        h4{font-family: arial; margin: 0;}
        table{width: 100%; max-width: 600px; margin: 10px auto; border: 1px solid #ccc; border-spacing: 0;}
        table tr td, table tr th{padding: 5px 10px; font-family: arial; font-size: 12px;}
        #detallerOrden tr td{border: 1px solid #ccc;}
        .table-active{background-color: #ccc;}
        .text-center{text-align: center;}
        .text-right{text-align: right;}

        @media screen and (max-width: 470px){
            .logo{width: 90px;}
            p, table tr td, table tr th{font-size: 9px;}
        } 

    </style>
</head>
<body>
    <div>
        <br>
        <p class="text-center">Se ha generado una orden, a continuacion encontraras los datos: </p>
        <br>
        <hr>
        <br>

        <table>
            <tr>
                <td width="33.33%">
                    <img src="<?=media(); ?>/ecommerce/images/icons/logo-01.png" alt="Logo">
                </td>
                <td width="33.33%">
                    <div class="text-center">
                        <h4><strong><?= NOMBRE_EMPRESA?> TECNOPAQ</strong></h4><br>
                        <p>

                            <?= DIRECCION?> <br>
                            Telefono:<?= TELEFONO?> <br>
                            Email: <?= EMAIL_EMPRESA?> <br>
                            <?= PROVINCIA?> - <?= CODIGOPOSTAL?> <br>
                        </p>
                    </div>
                </td>
                <td width="33.33%">
                    <div class="text-right">
                        <p>Nro Orden: <strong><?= $orden['idpedido']?></strong><br>
                           Fecha: <?= $orden['fecha']?> <br>
                           <?php if($orden['tipopagoid'] == 1) { ?>
                            Metodo Pago: <?= $orden['tipopago']?> <br>
                            Transaccion:  <?= $orden['idtransaccionpaypal']?>
                           <?php }else{ ?>
                            Metodo Pago: Pago contra entrega <br>
                            Tipo Pago: <?= $orden['tipopago']?>  
                           <?php }?>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="140">Nombre:  </td>
                <td><?= $_SESSION['userData']['nombres'].' '.$_SESSION['userData']['apellidos'] ?></td>
            </tr>
            <tr>
                <td>Telefono </td>
                <td><?= $_SESSION['userData']['telefono'] ?></td>
            </tr>
            <tr>
                <td>Direccion de Envio </td>
                <td><?= $orden['direccion_envio'] ?></td>
            </tr>
        </table>
        <table>
            <thead class="table-active">
                <tr>
                    <th>Descripcion</th>
                    <th class="text-right">Precio</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-right">Importe</th>
                </tr>
            </thead>
            <tbody id="detalleOrden">
                <?php if(count($detalle) > 0 ) {
                        $subtotal = 0;
                        foreach ($detalle as $producto) {
                            $precio= formatMoney($producto['precio']);
                            $importe= formatMoney($producto['precio'] * $producto['cantidad']);
                            $subtotal += $importe;
                    
                ?>
                <tr>
                    <td><?= $producto['producto'] ?></td>
                    <td class="text-right"><?= SMONEY.' '.$precio ?></td>
                    <td class="text-center"><?= $producto['cantidad'] ?></td>
                    <td class="text-right"><?= SMONEY.' '.$importe ?></td>
                </tr>
                <?php } 
                    }?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Subtotal</th>
                    <td class="text-right"><?= SMONEY.' '.$subtotal ?></td>
                </tr>
                <tr>
                    <th colspan="3" class="text-right">Envio</th>
                    <td class="text-right"><?= SMONEY.' '.formatMoney($orden['costo_envio']) ?></td>
                </tr>
                <tr>
                    <th colspan="3" class="text-right">Total</th>
                    <td class="text-right"><?= SMONEY.' '.formatMoney($orden['monto']); ?></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-center">
            <p>Si tiene preguntas sobre tu pedido, <br>pongase en contacto con nombre, telefono y Email</p>
            <h4>¡Gracias por tu compra...!</h4>
        </div>
    </div>
    
</body>
</html>