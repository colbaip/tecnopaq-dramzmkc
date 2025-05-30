<?php 
    const BASE_URL = "https://tecnopaq.dramelissapalma.com";

    //Zona Horaria

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    // Datos de conexion a Base MySql
    const DB_HOST = "localhost";
    const DB_NAME = "dramzmkc_dbtiendavirtual";
    //const DB_USER = "dramzmkc_tecnopaq";
    //const DB_PASSWORD = "T3qn0p@q+2025";
    const DB_USER = "dramzmkc";
    const DB_PASSWORD = "yAbg2noBAw9j";
    const DB_CHARSET = "charset=utf8";

    //Delimitadores decimal y millar

    const SPD = ",";
    const SPM = ".";

    // Simbolo de Moneda

    const SMONEY = "$";
    const CURRENCY = "USD";
    
    // SANDBOX Paypal  
    //const IDCLIENTE = "AdS1EhbuWQc1gubF3jO_2-cdFh8ibTo9GCOrphZTlRBafQQrkTfkRyqrqEq44Dd92e8xWvYhwk3rjAqi";
    const IDCLIENTE2 = "AXBut239VEgYWF_gx8TKyZ2o4a732iIMHv0GVSF7tq56wR65v9JihfA74xFK0dfPZMD-sDN6gmJ6PK7g"; // Tecnopaq?
    const IDCLIENTE = "ASs0q6BWmN0np05W-_9uYLlrrk8FUmcnIAkpiK0OUGrUE-9Gn9WIT_U9qVxDGgQ5jEXYZFUayzk8njO1"; // Aplicacion default?
    const URLPAYPAL2 = "https://api-m.sandbox.paypal.com/v1/oauth2/token"; //"https://api-m.sandbox.paypal.com";
    Const URLPAYPAL = "https://api.sandbox.paypal.com"; //"https://api-m.sandbox.paypal.com";
    const SECRET2 = "EFAu75Wkw7yIPYHXB-1PwG8-CgZfwL-gIL3kfZ8FfN4Cue6yGUO-aP4_ZRKZlk2cxURoBC857gEjGBSU";
    const SECRET = "EEu5tZ7ccu7rrryG1MXruxZgRyIGbOXJHFdWhP42h01c2c7zG0M6xGZZ26VNWj4B10jci8WVdQ9WRn1g"; // Aplicacion default?
    
    //Datos envio de correo
	const NOMBRE_REMITENTE = "Tecnopaq";
	const EMAIL_REMITENTE = "no-reply@tecnopaq.com";
	const NOMBRE_EMPRESA = "TECNOPAQ";
	const WEB_EMPRESA = "www.tecnopaq.com";
    const DIRECCION = "Int. Ratti 999, Ituzaingo";
    const TELEFONO = "1123014335";
    const WHATSAPP = "+5491123014335";
    const EMAIL_EMPRESA = "info@tecnopaq.com";
    const EMAIL_PEDIDOS = "pedidos@tecnopaq.com";
    const PROVINCIA= "Buenos Aires";
    const CODIGOPOSTAL = "CP 1714";
    const EMAIL_SUSCRIPCION = "no-replay@tecnopaq.com";

    // Extraer datos cateogiras

    const CAT_SLIDER = "1,2";
    const CAT_BANNER = "1,2,3,4";
    const CAT_FOOTER = "1,2,3,4";

    // Datos para Encriptar / Desencriptar
    const KEY = "marmoa";
    const METHODENCRIPT = "AES-128-ECB";

    // Costo de Envio
    const COSTOENVIO= "500";

    // ID Modulos

    const MCLIENTES = 3;
    const MPEDIDOS = 4;
    const MDASHBOARD = 1;
    const MCATEGORIAS = 6;
    const MPRODUCTOS = 5;
    const MUSUARIOS = 2;
    const MSUSCRIPTORES = 8;
    const MCONTACTOS = 9;
    const MPAGINAS = 10;

   // ID Paginas

   const PINICIO = 1;
   const PTIENDA = 2;
   const PCARRITO = 3;
   const PNOSOTROS = 4;
   const PCONTACTO = 5;
   const PPREGUNTAS = 6;
   const PTERMINOS = 7;
   const PSERVICIOS = 8;

    // ID Roles

    const RCLIENTES = 10;
    const RADMINISTRADOR = 1;

    // Status Pedido
    const STATUS = array('Completo','Aprobado','Cancelado','Reembolsado','Pendiente','Entregado');
 
    //Productos por página
	const CANTPRODHOME = 8;
	const PROPORPAGINA = 8;

	const PROCATEGORIA = 4;
	const PROBUSCAR = 4;

	//REDES SOCIALES
	const FACEBOOK = "https://www.facebook.com/";
	const INSTAGRAM = "https://www.instagram.com/";
    const PINTEREST = "https://pinterest.es/"
	
 
 ?>