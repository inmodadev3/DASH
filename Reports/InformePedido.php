<?php
use Mpdf\Mpdf;
require_once '../vendor/autoload.php';
session_start();
$intPedido=$_GET['pedido'];
include_once ("../Model/clsPedidosVendedoresModel.php");
$objPedidosVendedores = new clsPedidosVendedoresModel();
$Encabezado=$objPedidosVendedores->ConsultarEncabezadoPedido($intPedido); //llama el encabezado del pedido de la BD

$Detalle=$objPedidosVendedores->ConsultarDetallePedido($intPedido); //llama el Detalle del pedido de la BD
$Encabezado=$Encabezado[0];
$Productos="";

$hl=$Productos;
include_once ("../WebServices/clsEnsambleWebService.php");
$objEnsambleWebService = new clsEnsambleWebService();

$mpdf = new Mpdf(['margin_top' => 5,
'margin_left' => 5,
'margin_right' => 5,
'margin_bottom' => 15,
'mirrorMargins' => true,
'default_font' => 'Century Gothic',
'format' => 'Letter']);

$mpdf->AliasNbPages();
$mpdf->setTitle('Pedido');
$Tipo='';
if(($Encabezado['intTipo'])==0){
    $Tipo='IM';
}
$mpdf->WriteHTML('<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />');
$mpdf->WriteHTML('<sethtmlpageheader name="otherpages" value="on" />
');

foreach($Detalle as $item){
    $Productos.=("'".$item["strIdProducto"]."',");
}
$objEnsambleWebService->ListarUbicacionProductos(substr($Productos, 0, -1));
$Ubicacion = json_decode($objEnsambleWebService->GetRespuestaWs());

if($Encabezado['strIdDependencia'] == ''){
    $Encabezado['strNombreDependencia'] = "";
}

$mpdf->WriteHTML('
<style>
    table.detail td{
        font-size:10;
    }
    table.head td{
        font-size:10;
    }
    table.head tr{
        margin:0;
    }
	table{
		width:100%;
		line-height:inherit;
	}
	table.tblfooter tr td:nth-child(2){
        text-align:right;
        padding-right:10px;
    }
	.invoice-box table.detail td{
		padding:2px;
		vertical-align:top;
	}
	.invoice-box table.head td{
		padding:1;
		vertical-align:top;
	}
	.invoice-box table.head tr td:nth-child(2){
		text-align:right;
	}
	
	.invoice-box table tr.heading td{
		background:#eee;
		border-bottom:1px solid #ddd;
		font-weight:bold;
	}
	.invoice-box table tr.details td{
		padding-bottom:none;
	}
	.invoice-box table tr.item td{
		border-bottom:1px solid #aaa;
	}
	.invoice-box table.detail tr.item td:nth-child(9){
		
	}
    .invoice-box table.detail tr.item td:nth-child(7){
        text-align:center;
    }
    \.invoice-box table.detail tr.item td:nth-child(3){
        text-align:left;
    }
	.invoice-box table tr.item.last td{
		border-bottom:none;
	}
	
	
    </style>
  <div class="invoice-box">
		<table class="head" cellpadding="0" cellspacing="0">
			<tr class="top">
				<td colspan="2">
					<table>
                        <tr>
                            <td ><b>Nit:</b>    '.number_format($Encabezado['strIdCliente']).'    </td>
                            <td >Pedido: <b>'.$intPedido.' '.$Tipo.'</b></td>
                        </tr>
                        <tr>
                            <td ><b>Cliente:</b>    '.($Encabezado['strNombCliente']).'</td>
                        </tr>
                        <tr>
                            <td ><b>Ciudad:</b>     '.($Encabezado['strCiudadCliente']).'</td>
                            <td >F<b>echa Pedido:</b> '.($Encabezado['dtFechaFinalizacion']).'</td>
                        </tr>
                        <tr>
                            <td ><b>Separador:</b>  '.($Encabezado['strNombVendAsignado']).' ('.($Encabezado['dtFechaInicio']).')</td>
                            <td ><b>Vendedor:</b>   '.($Encabezado['strNombVendedor']).'</td>
                        </tr>
                        <tr>
                            <td ><b>Correo Facturacion:</b>     '.($Encabezado['strCorreoClienteAct']).'</td>
                            <td ><b>Telefono:</b> '.($Encabezado['strTelefonoClienteAct']).'</td>
                        </tr>
                        <tr>
                            <td ><b>Celular:</b>  '.($Encabezado['strCelularClienteAct']).'</td>
                            <td ><b>Ciudad:</b>  '.($Encabezado['strCiudadClienteAct']).'</td>
                        </tr>
                        <tr>
                            <td ><b>Info Empaque:</b>   '.array_search('941',array_column($Ubicacion,'StrIdProducto')).'</td>
                            <td ><b>Dependencia:</b>  '.($Encabezado['strNombreDependencia']).'</td>
                        </tr>
					</table>
				</td>
			</tr>
			
        </table>
			<hr>
		<table class="detail" cellpadding="0" cellspacing="0">	
			
			<tr class="heading">
                <td>#</td>
                <td>Referencia</td>
                <td>Descripcion</td>
                <td>Guion</td>
                <td>Observacion</td>
                <td>Ubicacion</td>
                <td>Cantidad</td>
                <td>Unidad</td>
                <td>Precio</td>
			</tr>
            ');
            $i=1;
            foreach ($Detalle as $item) {
                $precio='';
                switch ($item['intPrecio']) {
                    case $item['intPrecio']==$item['intPrecioProducto']:
                        $precio='   '.number_format($item['intPrecio']).'';
                        break;
                    case $item['intPrecio']>$item['intPrecioProducto']:
                        $precio='<b>↑ '.number_format($item['intPrecio']).'</b>    ('.number_format($item['intPrecioProducto']).') '.number_format(100/($item['intPrecioProducto'])*($item['intPrecioProducto']-$item['intPrecio'])).'%';
                        break;
                    case $item['intPrecio']<$item['intPrecioProducto']:
                        $precio='<b>↓ '.number_format($item['intPrecio']).'</b>    ('.number_format($item['intPrecioProducto']).') '.number_format(100/($item['intPrecioProducto'])*($item['intPrecioProducto']-$item['intPrecio'])).'%';
                        break;
                }
                $mpdf->WriteHTML('<tr class="item">
                    <td>'.$i.'</td>
                    <td>'.$item['strIdProducto'].'</td>
                    <td>'.$item['strDescripcion'].'</td>
                    <td>'.$item['strColor'].'</td>
                    <td>'.$item['strObservacion'].'</td>
                    <td>'.$Ubicacion[array_search($item['strIdProducto'] ,array_column($Ubicacion,'StrIdProducto'))]->strUbicacion.'</td>
                    <td>'.$item['intCantidad'].'</td>
                    <td>'.$item['strUnidadMedida'].'</td>
                    <td>'.$precio.'</td>
                </tr>
            
                <!--<tr class="item last">
                <td>3</td>
                    <td>A3452</td>
                    <td>BOLSO PARA FIESTA LARGO</td>
                    <td>Solo color rojo</td>
                    <td>4563-4564-4565-4566</td>
                    <td>23</td>
                    <td>DOC</td>
                    <td><b>↑ 5.200</b></td>
                </tr>--!>
                ');
                $i++;
        }
    $mpdf->WriteHTML('</table>
    <table class="tblfooter">
        <tr>
            <td><h4>***'.($Encabezado['strObservacion']).'***</h2></td>
            <td><b>Total</b>    $ '.number_format($Encabezado['intValorTotal']).'</td>
            
		</tr>
    </table>
	</div>
');
$mpdf->SetFooter('
<table width="100%">
    <tr style="font-size:10;">
        <td width="33%">{DATE j-m-Y}</td>
        <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
    </tr>
</table>');

$mpdf->Output('Pedido.pdf','I');
?>