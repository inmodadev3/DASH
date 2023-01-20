<?php 
date_default_timezone_set('America/Bogota');
include_once ("../Model/clsPedidosVendedoresModel.php");
require_once '../WebServices/clsVendedorWebService.php';
require_once '../WebServices/clsDocumentoWebService.php';
$objPedido=new clsPedidosVendedoresController();

if(isset($_POST['btnListarPedidos'])){
    $objPedido->ListarPedidos();
}
if(isset($_POST['btnGenerarExcelPedido'])){
    $objPedido->GenerarExcelPedidos();
}
if(isset($_POST['btnListarVendedores'])){
    $objPedido->ListarVendedores();
}
if(isset($_POST['btnAsignarSeparador'])){
    $objPedido->AsignarSeparador($_POST['strIdPedido'],$_POST['strIdSeparador'],$_POST['strSeparador']);
}
if(isset($_POST['btnConsultarDetallePedido'])){
    $objPedido->ConsultarDetallePedido();
}
if(isset($_POST['btnFinalizarPedidoSeparador'])){
    $objPedido->FinalizarPedidoSeparador();
}
if(isset($_POST['btnQuitarVendAsignado'])){
    $objPedido->QuitarVendAsignado();
}
if(isset($_POST['btnEnviarPedidoHgi'])){
    $objPedido->EnviarPedidoHgi($_POST['strIdPedido'],$_POST['intTransaccion'],$_POST['intDocumento'],$_POST['arrayReferencias'],$_POST['intCompania']);
}
if(isset($_POST['btnActualizarEstadoPedido'])){
    $objPedido->ActualizarEstadoPedido($_POST['strIdPedido'],$_POST['intEstado'],$_POST['intTransaccion'],$_POST['intDocumento']);
}
class clsPedidosVendedoresController{

    
	public function EnviarPedidoHgi($strIdPedido, $intTransaccion, $intDocumento, $arrayReferencias, $intCompania){
        $objPedidosVendedores = new clsPedidosVendedoresModel();
        $strDetallePedido=$objPedidosVendedores->ConsultarDetallePedido($strIdPedido);
        $clsDocumentoWebService = new clsDocumentoWebService();
        $r = 1;
        $array = array();
        foreach ($strDetallePedido as $key => $value) {
            $pos = array_search($value['strIdProducto'], array_column($arrayReferencias, 0));
            if( $pos !== false){
                if($arrayReferencias[$pos][1] != "" && $arrayReferencias[$pos][1] != 0){
                    if(!array_search($value['strIdProducto'], $array)){
                        array_push($array,$value['strIdProducto']);
                        $value['intCantidad'] = $arrayReferencias[$pos][1];
                        $intValorTotal = $value['intPrecio'] * $value['intCantidad'];
                        if($intCompania == 1){
                            $intCompania = 'INMODANET';
                        }else if($intCompania == 2){
                            $intCompania = 'VERDENET';
                        }else if($intCompania == 3){
                            $intCompania = 'KOPPEDNET';
                        }
                        $clsDocumentoWebService->EnviarPedidoHgi($key,"'".$intTransaccion."'","'".$intDocumento."'","'".$value['strIdProducto']."'",$value['intCantidad'],"'".$value['strUnidadMedida']."'",$value['intPrecio'],$intValorTotal,$intCompania);
                        $rpta = json_decode($clsDocumentoWebService->GetRespuestaWs());
                        
                        if($rpta == -1){
                            echo $rpta;
                            exit();
                        }elseif($rpta != ""){
                            $r.=$rpta."\n";
                        }
                    }
                    
                }else{
                    echo -2;
                    exit();
                }
                
            }
        }
        echo $r;
	}

    //Lista los pedidos que los vendedores cargan a la base de datos
    public function ListarPedidos(){
        $objPedidosVendedores = new clsPedidosVendedoresModel();
        $Pedidos=$objPedidosVendedores->ListarPedidos(); //llama los pedidos de la BD
        $Json=array(); 
        foreach($Pedidos as $array){
            array_push($Json,$array);//Convierte el Array en json ordenado
        }
        echo json_encode($Json); //Devuelve el json al view
    }
    //Generar el excel del pedido para ser montado en el HGI
    public function GenerarExcelPedidos(){
        $strIdPedido=trim($_POST['strIdPedido']);
        $objPedidosVendedores = new clsPedidosVendedoresModel();
        //Armando el array de cantidad y producto para generar el excel para el hgi
        $strPedidos=$objPedidosVendedores->ConsultarDetallePedido($strIdPedido);
        $ArrayProductos=array();
        $ArrayCantPorProducto=array();
        $ArrayPrecProducto=array();
        $k=0;
        $intCantidadProd=0;
        
        for($i=0;$i<=sizeof($strPedidos)-1;$i++){
            if(!in_array($strPedidos[$i]['strIdProducto'],$ArrayProductos)){
                $ArrayProductos[$k]=$strPedidos[$i]['strIdProducto'];
                $ArrayPrecProducto[$k]=$strPedidos[$i]['intPrecio'];
                for($j=0;$j<=sizeof($strPedidos)-1;$j++){
                    if($strPedidos[$j]['strIdProducto']===$ArrayProductos[$k]){
                        $intCantidadProd+=$strPedidos[$j]['intCantidad'];
                    }
                }
                $ArrayCantPorProducto[$k]=$intCantidadProd;
                $intCantidadProd=0;
                $k++;
            }          
        }
        //Generamos el excel
        $this->GenerarExcelPedido($ArrayProductos,$ArrayCantPorProducto,$ArrayPrecProducto,$strIdPedido);
    }
    //Generar el excel del pedido
    private function GenerarExcelPedido($ArrayProductos,$ArrayCantPorProducto,$ArrayPrecProducto,$strIdPedido){

        require_once '../Classes/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('tblDetalleDocumentos');
        $strArrayColumna= array('A1','B1','C1','D1');
        $strArrayDescripcion= array('StrSerie','StrProducto','intCantidaddoc','intValorUnitario');
        for($i=0;$i<=3;$i++){  
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($strArrayColumna[$i],$strArrayDescripcion[$i]);
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(trim($strArrayColumna[$i],'1'))->setAutoSize(TRUE);
        }

        $j=2;       
        for ($i=0; $i <=sizeof($ArrayProductos)-1; $i++) {      
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$j,trim($j-1))
            ->setCellValue('B'.$j,trim($ArrayProductos[$i]))
            ->setCellValue('C'.$j,trim($ArrayCantPorProducto[$i]))
            ->setCellValue('D'.$j,trim($ArrayPrecProducto[$i]));
            $j++;             
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="PedidoNro_'.$strIdPedido.'_'.date('Y/m/d').'.xlsx"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit();
    }
    //Consultar detalle del pedido
    public function ConsultarDetallePedido(){
       $strIdPedido=trim($_POST['strIdPedido']);
       $objPedidosVendedores = new clsPedidosVendedoresModel();
       $strDetPedidos=$objPedidosVendedores->ConsultarDetallePedido($strIdPedido);
       $Json=array(); 
       foreach($strDetPedidos as $array){
            array_push($Json,$array);//Convierte el Array en json ordenado
        }
        echo json_encode($Json);
    }

    public function ListarVendedores(){
        $clsVendedorWebService = new clsVendedorWebService();
        $clsVendedorWebService->ListarVendedores();
        $Vendedores=json_decode($clsVendedorWebService->GetRespuestaWs());
        $Json=array(); 
        foreach($Vendedores as $array){
            array_push($Json,$array);//Convierte el Array en json ordenado
        }
        echo json_encode($Json);
    }
    public function AsignarSeparador($strIdPedido,$strIdSeparador,$strSeparador){
        $objPedidosVendedores = new clsPedidosVendedoresModel();
        $objPedidosVendedores->AsignarSeparador($strIdPedido,$strIdSeparador,$strSeparador,-1);
    }
    //Finaliza el pedido a estado 3 y agrega la fecha de finalizacion del pedido por el separador
    public function FinalizarPedidoSeparador(){
        $strIdPedido=trim($_POST['strIdPedido']);
        $objPedidosVendedores = new clsPedidosVendedoresModel();
        $objPedidosVendedores->FinalizarPedidoSeparador($strIdPedido);
    }
     //Finaliza el pedido a estado 3 y agrega la fecha de finalizacion del pedido por el separador
    public function QuitarVendAsignado(){
        $strIdPedido=trim($_POST['strIdPedido']);
        $objPedidosVendedores = new clsPedidosVendedoresModel();
        $objPedidosVendedores->AsignarSeparador($strIdPedido,'','',1);
    }
    //Actualizar estado pedido
    public function ActualizarEstadoPedido($strIdPedido, $intEstado, $intTransaccion, $intDocumento){
        //echo $strIdPedido." ".$intEstado;
        $objPedidosVendedores = new clsPedidosVendedoresModel();
        $objPedidosVendedores->ActualizarEstadoPedido( $strIdPedido, $intEstado, $intTransaccion, $intDocumento);
    }
}
?>