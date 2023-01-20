<?php
include_once ("../WebServices/clsEnsambleWebService.php");
date_default_timezone_set('America/Bogota');
$objEnsamble= new clsEnsambleWebService();

$objEnsamble->ProductoEnsamble(trim($_GET['strproducto']));
$strRespuesta=json_decode($objEnsamble->GetRespuestaWs());

?>

<page backtop="8mm" backbottom="8mm" backleft="8mm" backright="9mm" backimg="9mm">
<page_header>
<table style="width: 100%;">
	<tr></tr>
	<tr>
		<td style="width: 33%;text-align: center;">	
			<img src="../Images/inmodafantasy.png" height="100" width="200">
		</td>
		<td style="width: 33%;text-align: center;padding-top: 15px;">
			<br>IN MODA FANTASY S.A.S<br>
			CRA 52A 45  33 BG 501<br>
			Medellín-Colombia<br>
			Tel 5124129
		</td>		
		<td style="width: 33%;text-align: center;">	
		<h2>Receta <br>Ensamble</h2>
		</td>
	</tr>
</table>
<hr>
<table style="width: 100%;">
	<tr>
		<td style="width: 74%;font-size: 15px;padding:15px;border:1px solid #000;border-radius: 10px;">
				<strong>Referencia</strong> <?php echo $_GET['strproducto'];?><br>	
				<strong>Descripción</strong> <?php echo $strRespuesta[0]->strdescripcionproducto;?><br>
				<strong>Cantidad para ensamblar </strong> <?php echo $_GET['intcantidadreferencia'];?>
		</td>
		<td style="border:1px solid #000;width:25%;text-align: center; ">
			Fecha
			<table style="width: 100%;">
				<tr>
					<td style="width: 33%;border:1px solid #000;">DIA</td>
					<td style="width: 33%;border:1px solid #000;">MES</td>
					<td style="width: 33%;border:1px solid #000;">AÑO</td>
				</tr>
				<tr>
					<td style="width: 33%;border:1px solid #000;"><?php echo date('d');?></td>
					<td style="width: 33%;border:1px solid #000;"><?php echo date('m');?></td>
					<td style="width: 33%;border:1px solid #000;"><?php echo date('Y');?></td>
				</tr>
			</table>

		</td>
	</tr>
</table>	
<hr>
<table style="width: 100%;text-align: center;border:1px solid #000;">
	<tr>
		<td  style="width: 20%;border:1px solid #000;">Referencia a
		ensamblar</td>
		<td  style="border:1px solid #000;width:20%;">Descripción</td>
		<td  style="width: 20%;border:1px solid #000;">Unidad</td>
		<td  style="width: 20%;border:1px solid #000;">Cantidad por referencia</td>
		<td  style="width:  20%;border:1px solid #000;">Cantidad para ensamblar</td>
	</tr>
	<?php 
	for($i=0;$i<=sizeof($strRespuesta)-1;$i++)
	{
		@$intCantidad=(($strRespuesta[$i]->intcantidad*$_GET['intcantidadreferencia']));
		echo "<tr><td style='width:20%;'>".$strRespuesta[$i]->strproductosecundario."</td><td style='width:20%;'>".$strRespuesta[$i]->strdescripcion."</td><td style='width:20%;'>".$strRespuesta[$i]->strunidad."</td><td style='width:20%;'>".$strRespuesta[$i]->intcantidad."</td><td style='width:20%;'> ".$intCantidad."</td></tr>";
	}

	?>
</table>	

<table style="width: 100%;text-align: center;border:1px solid #000;">
	<tr>
		<td style="width: 50%;border-right: 1px solid #000;">
			<h4 style='padding: 0px;margin: 0px;'>Observación</h4>
			<hr>
			<?php
			$h=1;
			for($i=0;$i<=strlen($_GET['strobservacion'])-1;$i++){ 
				    echo $_GET['strobservacion'][$i]; 
				    $h++;
					if($h==50){
						echo '<br>';
						$h=1;
					}
				}
			?>
		</td>
		<td style="width: 50%;">
		 	<table style="width: 100%;">
		 		<tr>		 			
		 			<td style="width: 100%;border:1px solid #000;background: #ddd;">
		 				<strong>Mano de obra:</strong> <?php if(trim($_GET['intvalorobra'])==''){$_GET['intvalorobra']=0; echo $_GET['intvalorobra']; }else{
		 					echo number_format($_GET['intvalorobra']*$_GET['intcantidadmanoobra']);
		 				}?>
		 			</td>
		 		</tr>
		 	</table>

		</td>
	</tr>
</table>
</page_header>
 
<page_footer>

</page_footer>

</page>