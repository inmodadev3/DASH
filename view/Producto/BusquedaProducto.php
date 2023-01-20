<style type="text/css">
.contenedor-busqueda{
	margin-bottom: 20px;
}
.contenedor-busqueda input[type='text']{
	width: 50%;
	border:1px solid #337ab7;
	border-radius: 5px;
	line-height: 25px;
	text-align: center;
}
.contenedor-busqueda input[type='text']:focus{
	border:1px solid #337ab7;
}
body{
	background: #fff;
}
.contenedor-card{
	width:24%;border:1px solid #ddd;display: inline-block;
	border-radius: 25px;
	overflow: hidden;
}
.contenido-img{
	margin-bottom: 15px;

}
.contenido-img img{
	border-bottom: 1px solid #ddd;
	cursor: pointer;
}
.contenedor-producto label{
	margin: 0px !important;
}
.contenedor-modal{
	position: fixed;
	width: 100%;
	height: 100%;
	z-index: 10000;
	top: -100%;
	left: 0;
	right: 0;
	bottom: 0;
	transition: top 0.5s;
}
.fondo-modal{
	background: #337ab7;
	width: 100%;
	height: 100%;
	opacity: 0.2;
	top: 0;
	position: absolute;
}
.contenido-modal{
	position: absolute;
}
.centrar-contenido{
	height: 100%;
	display: flex;
	align-items: center;
	justify-content: center;
	margin-bottom: 2%;
}
.carousel-indicators li{
	height: 20px!important;
	width: 20px!important;
	border: 1px solid #777!important;
}
@media screen and (max-width:640px) {
	.contenedor-card{
		width: 100%;
	}
	.input{
		width: 90% !important;
	}
}
@media screen and (max-width:940px) {
	.contenedor-card{
		width: 48%;
	}
	.input{
		width: 90% !important;
	}
}
</style>
<div id="page-wrapper" style="padding-top:2%;padding-bottom:1%;" class="text-center">
	<div class="contenedor-modal" id='contenedor-modal'>
		<div class="fondo-modal" id='fondo-modal'>
		</div>
		<div class="centrar-contenido">
			  <ol class="carousel-indicators">
			    
			  </ol>
			  <img onerror="this.src='../Images/img-no-disponible.jpg'" src="../Images/img-no-disponible.jpg" id='ImgBusquedaProductoModal' class="img-responsive contenido-modal" height="400" width="500" alt="Inmodafantasy JPG" style="border: 1px solid #ddd;border-radius: 20px;">
			

		</div>
	</div>
	<div class="contenedor-busqueda text-center">
		<label>Buscador de productos </label><br>
		<input class="input" placeholder="Referencia" id='txtReferenciaBusqueda' type="text" name=""  onkeypress="EnterBusquedaProducto(event);" autofocus="">
	</div>
	<div id='strMensajeBusqueda'></div>
	<div id='contenedor-producto'>
		<div class="jumbotron" style='margin:5px;padding:5px;height: 300px;'>
			<h1>Buscador de referencias.</h1>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	function BuscarProducto() {
		let strReferencia=document.getElementById('txtReferenciaBusqueda');
		if(strReferencia.value.trim()==''){
			swal('Ingrese una referencia para su busqueda.');
			return;
		}
		var parametros = {
			"btnBusquedaProducto": 'true',
			"strReferencia": strReferencia.value.trim()
		}
		$.ajax({
			data: parametros,
			url: '../Controller/ProductosController.php',
			type: 'post',
			success: function(response) {
				
				if(response==''){
					console.log('Error Json metodo BuscarProducto');
					return;
				}
				let strContenedor_producto=document.getElementById('contenedor-producto');
					strContenedor_producto.style.display='inline';
				if(response == -1){
					strMensajeBusqueda.innerHTML=
					`<div class="jumbotron" style='margin:5px;padding:5px;'>
					<p>Digite una referencia correcta.</p>
					</div>`;
					
					strContenedor_producto.style.display='none';
					strMensajeBusqueda.style.display='inline';
				}else{
					
					strMensajeBusqueda.style.display='none';
					strContenedor_producto.innerHTML=response;
					imgReferencia=document.querySelectorAll('img[data-referencia]');
					imgReferencia.forEach((ElementImg) => {
						ElementImg.addEventListener('click',(Img)=>{
							OpenModal(Img, ElementImg.src);
						});
					});
				}
				
				/*let strDataJson=JSON.parse(response);					
				strReferencia.value='';
				strReferencia.focus();
				let strContenedor_producto=document.getElementById('contenedor-producto');
				let strMensajeBusqueda=document.getElementById('strMensajeBusqueda');
				if(strDataJson['Success']){
					
					var strCntProductos='';
					for(i=0;i<=strDataJson['Data']['Productos'].length-1;i++)
					{
						let clasificacion = "";
						if(strDataJson['Data']['Productos'][i]['strClase'] !== "GENERAL"){ clasificacion+=strDataJson['Data']['Productos'][i]['strClase']+"/";}
						if(strDataJson['Data']['Productos'][i]['strLinea'] !== "GENERAL"){ clasificacion+=strDataJson['Data']['Productos'][i]['strLinea']+"/";}
						if(strDataJson['Data']['Productos'][i]['strGrupo'] !== "GENERAL"){ clasificacion+=strDataJson['Data']['Productos'][i]['strGrupo']+"/";}
						if(strDataJson['Data']['Productos'][i]['strTipo'] !== "GENERAL"){ clasificacion+=strDataJson['Data']['Productos'][i]['strTipo']+"/";}
						let url = 'http://www.inmodafantasy.com.co/ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO/'+clasificacion+strDataJson['Data']['Productos'][i]['strReferencia']+"/"+strDataJson['Data']['Productos'][i]['strReferencia']+"$1.jpg";
						//onerror="this.src='`+url+`'" 
						//Despues de actualizar el owncloud poner en src la url y probar
						strCntProductos+=`
						<div class="contenedor-card">
						<div class="contenido-img">
						<img data-referencia="`+strDataJson['Data']['Productos'][i]['strReferencia']+`" onerror="this.src='../Images/img-no-disponible.jpg'" src="${'http://www.inmodafantasy.com.co/ownCloud/fotos_nube/'+strDataJson['Data']['Productos'][i]['strReferencia']+'.jpg?'+Math.random()}" id='ImgBusquedaProducto' class="img-responsive"  alt="Inmodafantasy JPG">
						</div>
						<div>
						<div>
						<b>Referencia</b><br>
						<span>`+strDataJson['Data']['Productos'][i]['strReferencia']+`</span><br>

						<b>Descripción</b><br>
						<span>`+strDataJson['Data']['Productos'][i]['strDescripcion']+`</span><br>

						<b>Unidad Medida </b><br>
						<span>`+strDataJson['Data']['Productos'][i]['strUnidadMedida']+`</span><br>

						<b>Tamaño </b><br>
						<span>`+(strDataJson['Data']['Productos'][i]['strTamano']=='' ? 'Sin tamaño' : strDataJson['Data']['Productos'][i]['strTamano'])+`</span><br>

						<b>Cantidad por empaque </b><br>
						<span>`+strDataJson['Data']['Productos'][i]['intCantXPacas']+`</span><br>

						<b>Precio </b><br>
						<span>`+new Intl.NumberFormat("en-IN").format(strDataJson['Data']['Productos'][i]['strPrecioUno'])+`</span><br>

						<b>Ubicación </b><br>
						<span> `+(strDataJson['Data']['Productos'][i]['strUbicacion']=='' || strDataJson['Data']['Productos'][i]['strUbicacion']=='0' ? 'Sin ubicar'  : strDataJson['Data']['Productos'][i]['strUbicacion'])+`</span>	
						</div>
						</div>
						</div>
						`;
					}
					strMensajeBusqueda.style.display='none';
					strContenedor_producto.style.display='inline';
					strContenedor_producto.innerHTML=strCntProductos;
					//onclick img
					imgReferencia=document.querySelectorAll('img[data-referencia]');
					imgReferencia.forEach((ElementImg) => {
						ElementImg.addEventListener('click',(Img)=>{
							document.getElementById('ImgBusquedaProductoModal').src='http://181.143.42.219:8888/owncloud/fotos_nube/'+Img.target.dataset.referencia+'.jpg?'+Math.random();
							document.getElementById('contenedor-modal').style.top='0';
						});
					});
				}else{
					strMensajeBusqueda.innerHTML=
					`<div class="jumbotron" style='margin:5px;padding:5px;'>
					<h1>`+strDataJson['Data']['strError']+`</h1>
					<p>Digite una referencia correcta.</p>
					</div>`;
					strContenedor_producto.style.display='none';
					strMensajeBusqueda.style.display='inline';
				}*/
			},
			error: function(error) {
				console.log(error.responseText);
			}
		});
	}
	var Mdl=document.getElementById('contenedor-modal');
	Mdl.addEventListener('click',(Modal)=>{
		if(Modal.target.id=='fondo-modal'){
			document.getElementById('contenedor-modal').style.top='-100%';	
		}
	});

	function EnterBusquedaProducto(e){
		tecla = (document.all) ? e.keyCode : e.which;
		if(tecla==13){
			BuscarProducto();
		}
	}

	function Carousel(url, elemt) {
		$('.carousel-indicators li').removeClass('active');
		$('#'+elemt.id).addClass('active');
		document.getElementById('ImgBusquedaProductoModal').src=url;
	}

	/*function OpenModal(Img, url) {
		let referencia = Img.target.dataset.referencia;
		var parametros = {
	        "actFotosCarousel": 'true',
	        "url": url
        };
        $.ajax({
            data: parametros,
            url: '../Controller/ProductosController.php',
            type: 'post',
            dataType: "JSON",
            success: function(res) {
            	let url = res['url'];
            	$('.carousel-indicators').html("");
            	let cont = 0;
            	for (var i = res['fotos'].length - 1; i >= 0; i--) {
            		let val= res['fotos'][i];
            		cont++;
            		$('.carousel-indicators').append(`
			    		<li id='`+cont+`' onclick="Carousel('`+url+`/`+val+`', this)"></li>`);
            	}
            	$('#1').addClass("active");
            },
            error: function(error) {
            	$('.carousel-indicators').html("");
                console.log(eval(error));
            }
        });
		document.getElementById('ImgBusquedaProductoModal').src=url;
		document.getElementById('contenedor-modal').style.top='0';
	}*/
	function OpenModal(Img, url) {
		let referencia = Img.target.dataset.referencia;
		let path = '../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO';
		var parametros = {
	        "actFotosCarousel": 'true',
	        "url": url,
	        "referencia" : referencia
        };
        $.ajax({
            data: parametros,
            url: '../Controller/ProductosController.php',
            type: 'post',
            dataType: "JSON",
            success: function(res) {
            	let url = res['url'];
            	$('.carousel-indicators').html("");
            	let cont = 0;
            	for (var i = 0; i <= res['urls'].length; i++) {
            		//for(var i = res['urls'].length - 1; i >= 0; i--){
            		let val= res['urls'][i];
            		cont++;
            		$('.carousel-indicators').append(`
			    		<li id='`+cont+`' onclick="Carousel('`+path+val.StrArchivo+`', this)"></li>`);
            	}
            	$('#1').addClass("active");
            },
            error: function(error) {
            	$('.carousel-indicators').html("");
                console.log(eval(error));
            }
        });
		document.getElementById('ImgBusquedaProductoModal').src=url;
		document.getElementById('contenedor-modal').style.top='0';
	}


</script>
