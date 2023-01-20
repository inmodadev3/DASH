<?php
require_once("../Model/clsReportesModel.php");
include_once ("../Model/clsVendedoresModel.php");

session_start();

$objReportes= new clsReportesModel();	
$objVendedor= new clsVendedoresModel();																																																										
$objVendedor->ListarDocumentosLiquidacion($_SESSION['NrLiquidacion']);	
$strRespuestaVendedor=$objVendedor->GetRespuesta();	

$objReportes->ConsultarLiquidacionEncabezado($_SESSION['NrLiquidacion']);
$strRespuestaEncabezado=$objReportes->GetMensaje();




$strDiaInicio='01';
$strMes=$strRespuestaEncabezado[0]['strMes'];
$strDiaFinal=date("d",(mktime(0,0,0,$strRespuestaEncabezado[0]['strMes']+1,1,$strAnno)-1));
if($strRespuestaEncabezado[0]['intTipoMes']==2){
$strDiaInicio='16';
}	
if($strRespuestaEncabezado[0]['intTipoMes']==1){
$strDiaFinal='15';
}
if($strMes<=9){
$strMes='0'.$strMes;
}
$dtFechaInicio=$strDiaInicio.'-'.$strMes.'-'.explode('-',$strRespuestaEncabezado[0]['dtFechaCreacion'])[0];
$dtFechaFinal=$strDiaFinal.'-'.$strMes.'-'.explode('-',$strRespuestaEncabezado[0]['dtFechaCreacion'])[0];

$objReportes->ConsultarLiquidacionDetalle($_SESSION['NrLiquidacion'],'01');
$strRespuestaDetalleIngreso=$objReportes->GetMensaje();
$objReportes->ConsultarLiquidacionDetalle($_SESSION['NrLiquidacion'],'02');
$strRespuestaDetalleEgreso=$objReportes->GetMensaje();

$strDia='01';
if ($strRespuestaEncabezado[0]['intTipoMes']=='2'){
}

?>



<!DOCTYPE html>
<html>
<head>



<meta http-equiv="Expires" content="0">

<meta http-equiv="Last-Modified" content="0">

<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">

<meta http-equiv="Pragma" content="no-cache">

	<title>Informe Liquidacion</title>
	

	<style type="text/css">
		.body{
			
		}
	</style>
</head>
<body>
	
			<div style="display: inline;width: 33%;text-align:center;" ></div>
		<div style="display: inline;width: 33%;text-align:center;" ><label><?php echo "<small>In Moda Fantasy S.A.S<br>NIT: 900.433.668-2<br>Medellín-Colombia						 </small>";  ?> </label></div>
		<div style="width: 33%;">
			<label><?php 	echo "            				   " ?></label><qrcode value=<?php 	echo "'".$_SESSION['NrLiquidacion']."'" ?> ec='H' style='width: 20mm; background-color: white; color: black; float: right;'></qrcode>
			<label style="font-size: 20px;display: block;text-align: center;"><br>
				<strong>Liquidación </strong><br> <small style="text-align:justify-all;">Nro <?php 	echo $_SESSION['NrLiquidacion'] ?></small>
			</label>
			<br>
			
		</div><br>
		<div ><label><?php echo "<strong>Fecha Liquidacion: </strong>".date("Y-m-d"); ?><br><strong>Vendedor: </strong><?php echo $strRespuestaEncabezado[0]['strNombre'];?><strong><br> C.C.</strong><small><?php echo $strRespuestaEncabezado[0]['strCedulaVendedor'];?></small></label><br>
			<label><strong>Fecha inicio: </strong><small><?php echo $dtFechaInicio;?></small><br><strong>Fecha Final: </strong><small><?php echo $dtFechaFinal;?></small></label><br>
			<label>Generado por:<small><?php echo $_SESSION['Empleado'];?></small> </label></div>
			<br>
			<strong>
			<div style="width: 19%;display: inline;">
				<label>Codigo</label>
			</div>
			<div style="width: 29%;display: inline;">
				<label>Descripción</label>
			</div>
			<div style="width: 19%;display: inline;">
				<label>Ingresos</label>
			</div>
			<div style="width: 19%;display: inline">
				<label>Egresos</label>
			</div>
			<div style="width: 9%;display: inline">
				<label>Total</label>
			</div>
			</strong>
		<hr>	
	<?php
	$strEstructuraIngreso='';
	$intTotal=0;
	$intTotalEgreso=0;
	$blnIngreso=false;
	for($i=0;$i<=sizeof($strRespuestaDetalleIngreso)-1;$i++){
		if($strRespuestaDetalleIngreso[$i]['intSubTotal']!='0'){
			$blnIngreso=true;

			if($strRespuestaDetalleIngreso[$i]['intNumero']<=9){
				$strRespuestaDetalleIngreso[$i]['intNumero']='0000'.$strRespuestaDetalleIngreso[$i]['intNumero'];
			}else
			if($strRespuestaDetalleIngreso[$i]['intNumero']<=99){
				$strRespuestaDetalleIngreso[$i]['intNumero']='000'.$strRespuestaDetalleIngreso[$i]['intNumero'];
			}else
			if($strRespuestaDetalleIngreso[$i]['intNumero']<=999){
				$strRespuestaDetalleIngreso[$i]['intNumero']='00'.$strRespuestaDetalleIngreso[$i]['intNumero'];
			}else
			if($strRespuestaDetalleIngreso[$i]['intNumero']<=9999){
				$strRespuestaDetalleIngreso[$i]['intNumero']='0'.$strRespuestaDetalleIngreso[$i]['intNumero'];
			}

			$strEstructuraIngreso.="<strong><div style='width: 19%;display: inline;'>
					<label>".$strRespuestaDetalleIngreso[$i]['intNumero']."</label>
				</div></strong>
				<div style='width: 29%;display: inline;'>
					<label>".$strRespuestaDetalleIngreso[$i]['strNombre']."</label>
				</div>
				<div style='width: 19%;display: inline;'>
					<label>$".number_format($strRespuestaDetalleIngreso[$i]['intSubTotal'])."</label>
				</div>
				<div style='width: 19%;display: inline'>
					<label>0</label>
				</div>";
				$intTotal+=	$strRespuestaDetalleIngreso[$i]['intSubTotal'];
		}	
	}
	for($i=0;$i<=sizeof($strRespuestaDetalleEgreso)-1;$i++){
		if($intTotal==0){
			$blnIngreso=false;
			break;
		}
		if($strRespuestaDetalleEgreso[$i]['intSubTotal']!='0'){
			$blnIngreso=true;

			if($strRespuestaDetalleEgreso[$i]['intNumero']<=9){
				$strRespuestaDetalleEgreso[$i]['intNumero']='0000'.$strRespuestaDetalleEgreso[$i]['intNumero'];
			}else
			if($strRespuestaDetalleEgreso[$i]['intNumero']<=99){
				$strRespuestaDetalleEgreso[$i]['intNumero']='000'.$strRespuestaDetalleEgreso[$i]['intNumero'];
			}else
			if($strRespuestaDetalleEgreso[$i]['intNumero']<=999){
				$strRespuestaDetalleEgreso[$i]['intNumero']='00'.$strRespuestaDetalleEgreso[$i]['intNumero'];
			}else
			if($strRespuestaDetalleEgreso[$i]['intNumero']<=9999){
				$strRespuestaDetalleEgreso[$i]['intNumero']='0'.$strRespuestaDetalleEgreso[$i]['intNumero'];
			}
			$strEstructuraIngreso.="<strong><div style='width: 19%;display: inline;'>
					<label>".$strRespuestaDetalleEgreso[$i]['intNumero']."</label>
				</div></strong>
				<div style='width: 29%;display: inline;'>
					<label>".$strRespuestaDetalleEgreso[$i]['strNombre']."</label>
				</div>
				<div style='width: 19%;display: inline;'>
					<label>0</label>
				</div>
				<div style='width: 19%;display: inline'>
					<label>".number_format($strRespuestaDetalleEgreso[$i]['intSubTotal'])."</label>
				</div>
				";
				$intTotalEgreso+=	$strRespuestaDetalleEgreso[$i]['intSubTotal'];
		}	
	}
	if(!$blnIngreso){
		echo 'Sin movimientos.';
	}
	echo $strEstructuraIngreso;
	?>
		
	<br>
	<br>
	
		<hr>
		<style type="text/css">
			#sub{
				border: 1px solid black;
			}
		</style>
		<div style="width: 19%;display: inline;"><label></label></div>
		<div style="width: 29%;display: inline;"><label></label></div>





		<div style="width: 19%;display: inline;"><label id="sub"><?php echo number_format($intTotal);?></label></div>
		<div style="width: 19%;display: inline;"><label id="sub"><?php echo number_format($intTotalEgreso);?></label></div>
		<strong><div style="width: 9%;display: inline;"><label id="sub"><?php echo number_format($intTotal-$intTotalEgreso);?></label></div></strong>
		<label><strong>Valor: </strong><small>
			<?php
			include_once ("../Reports/clsNumerosAletras.php");
			$objNumeroAletras= new clsNumerosALetras();
			echo $objNumeroAletras->traducir($intTotal-$intTotalEgreso);
			$objNumeroAletras=null;
			?>
		</small></label>

		<hr>
		<?php 
		$blnEstado=true;
		$strContenido='';
		$intSumaTotal=0;
		$intSumaTipoTransaccion=0;
		$k=1;
		$strTituloComision='';
		$blnEstadoTipoFactura=true;
	for($i=0;$i<=sizeof($strRespuestaVendedor)-1;$i++){
		if($blnEstado){
					$strContenido.="<tr><td style='padding:10px;'><strong>".strtoupper($strRespuestaVendedor[$i]['strNombre'])."</strong><hr></td><td style='padding:10px;' ></td><td style='padding:10px;'></td><td style='padding:10px;'></td></tr>";
					$blnEstado=false;
		}	
		if($blnEstadoTipoFactura){
			$strContenido.="<tr><td style='padding:10px;'><strong>".strtoupper($strRespuestaVendedor[$i]['strNombreTransaccion'])."</strong></td><td style='padding:10px;' ></td><td style='padding:10px;'></td><td style='padding:10px;'></td></tr>";
			$blnEstadoTipoFactura=false;
		}



		$strContenido.="<tr><td style='padding: 5px;width:300px;'>".($k)."   ".$strRespuestaVendedor[$i]['strTercero']."</td><td style='padding: 5px;'>".$strRespuestaVendedor[$i]['strDocumento']."</td><td style='padding: 5px;'>".$strRespuestaVendedor[$i]['intRecibo']."</td><td style='padding: 5px;' >".number_format($strRespuestaVendedor[$i]['intBaseMonto'])."</td><td style='padding: 5px;' >".$strRespuestaVendedor[$i]['dtFechaDocumento']."</td><td style='padding: 5px;' >"."</td></tr>";
			$intSumaTotal+=$strRespuestaVendedor[$i]['intBaseMonto'];
			$intSumaTipoTransaccion+=$strRespuestaVendedor[$i]['intBaseMonto'];

	if($i!=(sizeof($strRespuestaVendedor)-1) || $i!=0){		
		if((trim($strRespuestaVendedor[$i]['strNombreTransaccion'])!=trim(@$strRespuestaVendedor[$i+1]['strNombreTransaccion']))){
			$strContenido.=
			"<tr ><td style='padding:10px;'>Sub Total:</td><td style='padding:10px;'></td><td style='padding:10px;'></td><td style='padding:10px;'>".number_format($intSumaTipoTransaccion)."</td><td style='padding:10px;'></td></tr><tr><td style='padding:10px;'></td><td style='padding:10px;'></td><td style='padding:10px;'></td><td style='padding:10px;'></td></tr>";
		}}
		if($i!=(sizeof($strRespuestaVendedor)-1)){	
				if(!(trim($strRespuestaVendedor[$i]['strNombreTransaccion'])==trim($strRespuestaVendedor[$i+1]['strNombreTransaccion']) && trim($strRespuestaVendedor[$i]['strNombre'])==trim($strRespuestaVendedor[$i+1]['strNombre']))){
						$blnEstadoTipoFactura=true;

						$intSumaTipoTransaccion=0;
				}
		}
		$k++;	
		if($i!=(sizeof($strRespuestaVendedor)-1)){	
		if(!($strRespuestaVendedor[$i]['intIdMovimiento']==$strRespuestaVendedor[$i+1]['intIdMovimiento'])){
			$strContenido.=
			"<tr ><td style='padding:10px;'>TOTAL ".strtoupper($strRespuestaVendedor[$i-1]['strNombre']).":</td><td style='padding:10px;'></td><td style='padding:10px;'></td><td style='padding:10px;'>".number_format($intSumaTotal)."</td><td style='padding:10px;'></td></tr><tr><td style='padding:10px;'><strong>".strtoupper( $strRespuestaVendedor[$i+1]['strNombre'])."</strong><hr></td><td style='padding:10px;'></td><td style='padding:10px;'></td><td style='padding:10px;'></td></tr>";
				$intSumaTotal=0;
				$intSumaTipoTransaccion=0;
				$strTituloComision=strtoupper($strRespuestaVendedor[$i+1]['strNombre']);
			$k=1;
		}
	}
	}



?>
<table style="border: #000 1px solid;" >
	<tr>
		<th>#</th>
		<th style="padding:5px ">Documento</th>
		<th style="padding:5px ">Recibo</th>
		<th style="padding: 10px;">Valor</th>
		<th style="padding: 10px;">Fecha Pago</th>
		<th style="padding: 10px;"></th>
	</tr>
	<tbody>
		<?php echo $strContenido."<tr><td style='padding:10px;'>TOTAL ".$strTituloComision.":</td><td style='padding:10px;'></td><td style='padding:10px;'></td><td style='padding:10px;'>".number_format($intSumaTotal)."</td><td></td></tr>"; ?>
	</tbody>
</table>
	<hr>
	<small>Este documento es informativo para la liquidación, no tiene efectos legales ni tributarios</small>

	
</body>
</html>