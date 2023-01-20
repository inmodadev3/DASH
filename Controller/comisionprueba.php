<?php
class prueba
{
    public function CalcularComision()
    {
        $this->strCedula = trim($_POST['strCedula']);
        $this->intCompania = trim($_POST['intCompania']);
        $this->intMes = trim($_POST['strMes']);
        $this->strMesTipo = trim($_POST['intPeriodo']);
        $this->intAnno = trim($_POST['intAnno']);

        $objVendedorModel = new clsVendedoresModel();
        $objVendedorModel->ConsultarIngresosVendedor(
            $this->strCedula,
            $this->intCompania
        );
        $strRespuesta = $objVendedorModel->GetRespuesta();
        $objVendedorModel->ListarLineasPorVendedor($this->strCedula);
        $strRespuestaLineas = $objVendedorModel->GetRespuesta();
        $objVendedorModel->ListarCiudadesPorVendedor($this->strCedula);
        $strRespuestaCiudades = $objVendedorModel->GetRespuesta();

        $blnEstado = false;
        $strValor = '';
        $intContador = 0;
        if ($strRespuesta == null) {
            echo '8';
            return;
        }
        if ($strRespuestaLineas == null) {
            echo '9';
            return;
        }
        @session_start();
        $objVendedorModel->CrearLiquidacionEncabezado(
            $this->strCedula,
            $this->intMes,
            $this->intCompania,
            $this->strMesTipo,
            $_SESSION['Empleado'],
            $this->intAnno
        );

        for ($p = 0; $p <= sizeof($strRespuesta) - 1; $p++) {
			/* Valida si el vendedor debe cumplir meta para liquidar la comision */
            if ($strRespuesta[$p]['intMeta'] == 1) {
                $intValorMeta = 0;
                $intValorMetaBase = 0;
                $strMes = '';
                if ($strRespuesta[$p]['intTipoMeta'] == 0) {
                    $intValorMeta = $strRespuesta[$p]['intValorMeta'];
                } else {
                    $ArrayMeses = [
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre',
                    ];
                    for ($i = 0; $i <= sizeof($ArrayMeses) - 1; $i++) {
                        if ($i + 1 == $this->intMes) {
                            $strMes = $ArrayMeses[$i];
                        }
                    }
                    //suma la meta de verde y blanca
                    for ($intCompania = 1; $intCompania <= 2; $intCompania++) {
                        $objVendedorModel->ConsultarMetaAVendedor(
                            $this->strCedula,
                            $strMes,
                            $intCompania,
                            $strRespuesta[$p]['strBaseMeta'],
                            $this->intAnno
                        );

                        $intValorMeta += $objVendedorModel->GetRespuesta()[0][
                            'intValor'
                        ];
                    }

                    if ($intValorMeta == null) {
                        $intValorMeta = 0;
                    }
                    if ($intValorMeta != null) {
                        if ($this->strMesTipo == 1 || $this->strMesTipo == 2) {
                            $intValorMeta = $intValorMeta / 2;
                        }
                    }
                }

                //metaa
                //blanca ventas
                $parametros = [];
                $parametros['Cia'] = '1';
                $parametros['Tipo'] = $strRespuesta[$p]['strBaseMeta'];
                $parametros['TipoVendedor'] = 'PP';
                $parametros['Vendedor'] =
                    $strRespuesta[$p]['strCedulaVendedor'];
                $parametros['Transacciones'] = "'04','041'";
                $strAnno = '';

                $strDia = '';
                $strDiasUltimo = '01';
                if ($this->strMesTipo == 1) {
                    $strMes = $this->intMes;
                    $strAnno = $this->intAnno;
                    $strDia = '15';
                } elseif ($this->strMesTipo == 2) {
                    if ($strRespuesta[$p]['strPeriocidad'] == 'QC') {
                        $strDiasUltimo = '16';
                    }
                    $strMes = $this->intMes;
                    $strAnno = $this->intAnno;
                    $strDia = date(
                        'd',
                        mktime(0, 0, 0, $strMes + 1, 1, $strAnno) - 1
                    );
                } elseif ($this->strMesTipo == 0) {
                    $strMes = $this->intMes;
                    $strAnno = $this->intAnno;
                    $strDia = date(
                        'd',
                        mktime(0, 0, 0, $strMes + 1, 1, $strAnno) - 1
                    );
                }
                if ($strMes <= 9) {
                    $strMes = '0' . $strMes;
                }
                $parametros['FechaIni'] =
                    $strAnno . '-' . $strMes . '-' . $strDiasUltimo;
                $parametros['FechaFin'] =
                    $strAnno . '-' . $strMes . '-' . $strDia;
                $client = new SoapClient($this->UrlWebService);
                $strWSVenta = $client->LiquidarComision($parametros);
                //
                echo $strWSVenta;
                if ($strWSVenta->LiquidarComisionResult == null) {
                    $intValorMetaBase = 0;
                } else {
                    $strMeta = explode(
                        '&#',
                        $strWSVenta->LiquidarComisionResult
                    );
                    for ($t = 0; $t <= sizeof($strRespuestaLineas) - 1; $t++) {
                        for ($w = 0; $w <= sizeof($strMeta) - 2; $w++) {
                            $strMetaFila = explode('%', $strMeta[$w]);
                            if (
                                $strRespuesta[$p]['strTipoBaseMeta'] == 'TTss'
                            ) {
                                $intValorMetaBase += $strMetaFila[4];
                            } else {
                                if (
                                    $strRespuestaLineas[$t]['intCodigoLinea'] ==
                                    $strMetaFila[3]
                                ) {
                                    $intValorMetaBase += $strMetaFila[4];
                                }
                            }
                        }
                    }
                    //ventas  verde meta total
                    $parametros = [];
                    $parametros['Cia'] = '2';
                    $parametros['Tipo'] = $strRespuesta[$p]['strBaseMeta'];
                    $parametros['TipoVendedor'] = 'PP';
                    $parametros['Vendedor'] =
                        $strRespuesta[$p]['strCedulaVendedor'];
                    $parametros['Transacciones'] = "'09'";
                    $strAnno = '';

                    $strDia = '';
                    $strDiasUltimo = '01';
                    if ($this->strMesTipo == 1) {
                        $strMes = $this->intMes;
                        $strAnno = $this->intAnno;
                        $strDia = '15';
                    } elseif ($this->strMesTipo == 2) {
                        if ($strRespuesta[$p]['strPeriocidad'] == 'QC') {
                            $strDiasUltimo = '16';
                        }
                        $strMes = $this->intMes;
                        $strAnno = $this->intAnno;
                        $strDia = date(
                            'd',
                            mktime(0, 0, 0, $strMes + 1, 1, $strAnno) - 1
                        );
                    } elseif ($this->strMesTipo == 0) {
                        $strMes = $this->intMes;
                        $strAnno = $this->intAnno;
                        $strDia = date(
                            'd',
                            mktime(0, 0, 0, $strMes + 1, 1, $strAnno) - 1
                        );
                    }
                    if ($strMes <= 9) {
                        $strMes = '0' . $strMes;
                    }
                    $parametros['FechaIni'] =
                        $strAnno . '-' . $strMes . '-' . $strDiasUltimo;
                    $parametros['FechaFin'] =
                        $strAnno . '-' . $strMes . '-' . $strDia;
                    $client = new SoapClient($this->UrlWebService);
                    $strWSVenta = $client->LiquidarComision($parametros);
                    if ($strWSVenta->LiquidarComisionResult == null) {
                        if ($intValorMetaBase == 0) {
                            $intValorMetaBase = 0;
                        }
                    } else {
                        $strMeta = explode(
                            '&#',
                            $strWSVenta->LiquidarComisionResult
                        );
                        for (
                            $t = 0;
                            $t <= sizeof($strRespuestaLineas) - 1;
                            $t++
                        ) {
                            for ($w = 0; $w <= sizeof($strMeta) - 2; $w++) {
                                $strMetaFila = explode('%', $strMeta[$w]);
                                if (
                                    $strRespuesta[$p]['strTipoBaseMeta'] == 'TT'
                                ) {
                                    $intValorMetaBase += $strMetaFila[4];
                                } else {
                                    if (
                                        $strRespuestaLineas[$t][
                                            'intCodigoLinea'
                                        ] == $strMetaFila[3]
                                    ) {
                                        $intValorMetaBase += $strMetaFila[4];
                                    }
                                }
                            }
                        }
                    }

                    if ($intValorMetaBase >= $intValorMeta) {
                        $blnEstado = true;
                    } else {
                        $blnEstado = false;
                    }
                }
                $strWSVenta = null;
            } else {
                $blnEstado = true;
            }
            //echo $intValorMetaBase;

            /*Meta*/
            $intMontoIngreso = 0;
            $blnActualizarIngreso = false;
            $blnEstadoIngreso = 1;
            $intCantidad = 0;
			/* Valida la periocidad en la que se liquida el ingreso */
            if ($this->strMesTipo == 0) {
                if ($strRespuesta[$p]['strPeriocidad'] == 'MS') {
                    $intCantidad = 1;
                    $intEstadoTipoPeriocidad = 0;
                } else {
                    $intCantidad = 2;
                    $intEstadoTipoPeriocidad = 1;
                }
            }

            if ($this->strMesTipo == 1) {
                if ($strRespuesta[$p]['strPeriocidad'] == 'QC') {
                    $intCantidad = 1;
                    $intEstadoTipoPeriocidad = 2;
                }
            } elseif ($this->strMesTipo == 2) {
                if ($strRespuesta[$p]['strPeriocidad'] == 'MS') {
                    $intCantidad = 1;
                    $intEstadoTipoPeriocidad = 0;
                }
                if ($strRespuesta[$p]['strPeriocidad'] == 'QC') {
                    $intCantidad = 1;
                    $intEstadoTipoPeriocidad = 1;
                }
            }

            //agregar mes a aplicar
            if (
                !(
                    explode('-', $strRespuesta[$p]['dtFechaInicial'])[0] <=
                    $this->intAnno
                )
            ) {
                $blnEstado = false;
            }
            if (
                explode('-', $strRespuesta[$p]['dtFechaInicial'])[0] ==
                $this->intAnno
            ) {
                if (
                    !(
                        explode(
                            '-',
                            str_replace(
                                '0',
                                '',
                                $strRespuesta[$p]['dtFechaInicial']
                            )
                        )[1] <= $this->intMes
                    )
                ) {
                    $blnEstado = false;
                }
            }
			/* Valida el estado del ingreso a liquidar */
            if ($blnEstado) {
                if ($strRespuesta[$p]['intSerie'] == 0) {
					/* TIPOS
						0: Fijo
						1: Unico
						2: Temporal
					*/
                    if ($strRespuesta[$p]['intTipo'] == 0) {
                        $blnActualizarIngreso = true;
                        $blnEstadoIngreso = 1;
                        $intMontoIngreso = $strRespuesta[$p]['intValor'] * $intCantidad;
                    } elseif ($strRespuesta[$p]['intTipo'] == 1) {
                        if ( explode('-',str_replace('0','',$strRespuesta[$p]['dtFechaInicial']))[1] == $this->intMes &&explode('-',$strRespuesta[$p]['dtFechaInicial'])[0] == $this->intAnno) {
                            $intMontoIngreso = $strRespuesta[$p]['intValor'];
                            $blnEstadoIngreso = 0;
                            $intEstadoTipoPeriocidad = -1;
                            $blnActualizarIngreso = true;
                        }
                    } elseif ($strRespuesta[$p]['intTipo'] == 2) {
                        //trae  uno rectificar cuando es QC periodo 1
                        $blnEstadoUltimoDia = true;
                        if (explode('-',str_replace('0','',$strRespuesta[$p]['dtFechaFinal']))[1] < $this->intMes 
							&&
                            $strRespuesta[$p]['strPeriocidad'] == 'MS' && explode('-',$strRespuesta[$p]['dtFechaFinal'])[0] == $this->intAnno
                        ) {
                            $intMontoIngreso = 0;
                            $blnActualizarIngreso = true;
                            $blnEstadoIngreso = 0;
                            $intEstadoTipoPeriocidad = -1;
                            $blnEstadoUltimoDia = false;
                        } else {
                            //pendiente cuando applico mesual no me aplica la quincena en el tiempo 1 a 15

                            if (
                                explode(
                                    '-',
                                    str_replace(
                                        '0',
                                        '',
                                        $strRespuesta[$p]['dtFechaFinal']
                                    )
                                )[1] == $this->intMes &&
                                ($this->strMesTipo == 2 ||
                                    $this->strMesTipo == 0) &&
                                explode(
                                    '-',
                                    $strRespuesta[$p]['dtFechaFinal']
                                )[2] <= 15 &&
                                explode(
                                    '-',
                                    $strRespuesta[$p]['dtFechaFinal']
                                )[0] == $this->intAnno
                            ) {
                                $intMontoIngreso = 0;

                                $blnActualizarIngreso = true;
                                $blnEstadoIngreso = 0;
                                $intEstadoTipoPeriocidad = -1;
                                $blnEstadoUltimoDia = false;
                            }

                            if (
                                $this->intMes >
                                    explode(
                                        '-',
                                        str_replace(
                                            '0',
                                            '',
                                            $strRespuesta[$p]['dtFechaFinal']
                                        )
                                    )[1] &&
                                explode(
                                    '-',
                                    $strRespuesta[$p]['dtFechaFinal']
                                )[0] == $this->intAnno
                            ) {
                                $intMontoIngreso = 0;
                                $blnActualizarIngreso = true;
                                $blnEstadoIngreso = 0;
                                $intEstadoTipoPeriocidad = -1;
                                $blnEstadoUltimoDia = false;
                            }
                        }

                        if ($blnEstadoUltimoDia) {
                            if (
                                $this->intMes >=
                                    explode(
                                        '-',
                                        str_replace(
                                            '0',
                                            '',
                                            $strRespuesta[$p]['dtFechaInicial']
                                        )
                                    )[1] &&
                                explode(
                                    '-',
                                    $strRespuesta[$p]['dtFechaInicial']
                                )[0] == $this->intAnno
                            ) {
                                $blnActualizarIngreso = true;
                                $blnEstadoIngreso = 1;
                                $intMontoIngreso =
                                    $strRespuesta[$p]['intValor'] *
                                    $intCantidad;
                            }
                        }
                    }
                } else {
                    //obtener documentos ventas
					/* 
						Se definen los parametros para la consula de los documentos al web services
						- Cia
						- Tipo
						- TipoVendedor (PP,GN,MD)
						- Vendedor
						- Fecha Inicial
						- Fecha final
					*/
                    $intBaseIngreso = 0;
                    $strVendedor = $strRespuesta[$p]['strVendedor'];
                    if ($strRespuesta[$p]['strTipoVendedor'] == 'PP') {
                        $strVendedor = $strRespuesta[$p]['strCedulaVendedor'];
                    }
                    if ($strRespuesta[$p]['strTipoVendedor'] == 'GN') {
                        $strVendedor = '';
                    }
                    $parametros = [];

                    $parametros['Cia'] = $strRespuesta[$p]['intCompania'];
                    $parametros['Tipo'] = $strRespuesta[$p]['strTipoBase'];
                    $parametros['TipoVendedor'] = $strRespuesta[$p]['strTipoVendedor'];
                    $parametros['Vendedor'] = $strVendedor;
                    $strFechaDia = new DateTime(
                        $strRespuesta[$p]['dtUltimaFechaLiqui']
                    );
                    $dtFecha = explode(
                        '-',
                        $strRespuesta[$p]['dtUltimaFechaLiqui']
                    );
                    $strMesUno = '01';
                    $intCantidad = 1;
					/* se define la perriocidad de liquidacion del ingreso */
                    if ($this->strMesTipo == 1) {
                        $strMes = $this->intMes;
                        $strAnno = $this->intAnno;
                        $strDia = '15';
                    } elseif ($this->strMesTipo == 2) {
                        if ($strRespuesta[$p]['strPeriocidad'] == 'QC') {
                            $strMesUno = '16';
                        }
                        $strMes = $this->intMes;
                        $strAnno = $this->intAnno;
                        $strDia = date(
                            'd',
                            mktime(0, 0, 0, $strMes + 1, 1, $strAnno) - 1
                        );
                    } elseif ($this->strMesTipo == 0) {
                        $strMes = $this->intMes;
                        $strAnno = $this->intAnno;
                        $strDia = date(
                            'd',
                            mktime(0, 0, 0, $strMes + 1, 1, $strAnno) - 1
                        );
                    }
                    //rango de fecha para consultar cuanto es unico y temporal
                    if (
                        $this->intMes ==
                            explode(
                                '-',
                                $strRespuesta[$p]['dtFechaInicial']
                            )[1] &&
                        $this->intAnno ==
                            explode('-', $strRespuesta[$p]['dtFechaInicial'])[0]
                    ) {
                        $strMes = $this->intMes;
                        $strAnno = $this->intAnno;
                        $strMesUno = explode(
                            '-',
                            $strRespuesta[$p]['dtFechaInicial']
                        )[2];
                        $strDia = explode(
                            '-',
                            $strRespuesta[$p]['dtFechaFinal']
                        )[2];
                        if (
                            $strRespuesta[$p]['strPeriocidad'] == 'QC' &&
                            $this->strMesTipo == 2
                        ) {
                            $strMesUno = '16';
                        }
                    }
                    //Ingreso de documentos liquidados
                    $blnEstadoAgregarDocumentos = false;
                    if (
                        $this->strMesTipo == 1 &&
                        $strRespuesta[$p]['strPeriocidad'] == 'QC'
                    ) {
                        $blnEstadoAgregarDocumentos = true;
                    }
                    if (
                        ($strRespuesta[$p]['strPeriocidad'] == 'MS' ||
                            ($strRespuesta[$p]['strPeriocidad'] = 'QC')) &&
                        ($this->strMesTipo == 2 || $this->strMesTipo == 0)
                    ) {
                        $blnEstadoAgregarDocumentos = true;
                    }

                    if ($strMes <= 9) {
                        $strMes = '0' . $strMes;
                    }
                    $parametros['FechaIni'] =
                        $strAnno . '-' . $strMes . '-' . $strMesUno;
                    $parametros['FechaFin'] =
                        $strAnno . '-' . $strMes . '-' . $strDia;
                    $parametros['Transacciones'] =
                        $strRespuesta[$p]['strTransacciones'];

                    //echo $strAnno.'-'.$strMes.'-'.$strMesUno;
                    //echo '<br>';
                    //echo $strAnno."-".$strMes."-".$strDia;
                    $client = new SoapClient($this->UrlWebService);
                    $WebService = $client->LiquidarComision($parametros);
                    $client = null;
                    $parametros = [];
                    $parametros['Vendedor'] =
                        $strRespuesta[$p]['strCedulaVendedor'];
                    $client = new SoapClient($this->UrlWebService);
                    $WebServiceUltimaVisita = $client->UltimaVisita(
                        $parametros
                    );
                    $client = null;
                    $blnEstadoMonto = true;
                    //ciudades

                    $strContenidoWebService = explode('&#',$WebService->LiquidarComisionResult);
                    $strContenidoWebServiceTiempoVisita = explode('&',$WebServiceUltimaVisita->UltimaVisitaResult);
                    //var_dump($strContenidoWebService);
                    var_dump($strContenidoWebServiceTiempoVisita);
					/* Se define la base de liquidacion del ingreso */
                    if ($strRespuesta[$p]['strTipoBase'] == 'VN') {
                        // necesito que me envie el total de la factura y su iva
                        if ($strRespuesta[$p]['strTipoBaseIngreso'] == 'LZ') {
                            for (
                                $i = 0;
                                $i <= sizeof($strContenidoWebService) - 2;
                                $i++
                            ) {
                                $blnEstadoMonto = true;
                                $strContenidoWebServiceFila = explode(
                                    '%',
                                    $strContenidoWebService[$i]
                                );

                                for (
                                    $j = 0;
                                    $j <= sizeof($strRespuestaLineas) - 1;
                                    $j++
                                ) {
                                    if (
                                        $strRespuestaLineas[$j][
                                            'intCodigoLinea'
                                        ] == $strContenidoWebServiceFila[3]
                                    ) {
                                        //validar ciudades//

                                        if ($blnEstadoMonto) {
                                            if (
                                                sizeof($strRespuestaCiudades) ==
                                                0
                                            ) {
                                                $blnEstadoMonto = false;
                                            }
                                            for (
                                                $c = 0;
                                                $c <=
                                                sizeof($strRespuestaCiudades) -
                                                    1;
                                                $c++
                                            ) {
                                                if (
                                                    trim(
                                                        $strContenidoWebServiceFila[8]
                                                    ) ==
                                                    trim(
                                                        $strRespuestaCiudades[
                                                            $c
                                                        ]['intIdCiudad']
                                                    )
                                                ) {
                                                    $blnEstadoMonto = true;
                                                    break;
                                                } else {
                                                    $blnEstadoMonto = false;
                                                    //break;
                                                }
                                            }
                                        }
                                        if ($strRespuesta[$p]['intTiempoVisita'] == 1) {
                                            if (sizeof($strContenidoWebServiceTiempoVisita) == 1) {
                                                $blnEstadoMonto = false;
                                            }else{
												for ($k = 0;$k <=sizeof($strContenidoWebServiceTiempoVisita) -2;$k++) {
													$strTiempoVisita = explode(
														'%',
														$strContenidoWebServiceTiempoVisita[
															$k
														]
													);
													if (
														$strTiempoVisita[0] ==
														$strContenidoWebServiceFila[2]
													) {
														if (
															$strRespuesta[$p][
																'strDiasVisita'
															] > $strTiempoVisita[2]
														) {
															$blnEstadoMonto = true;
															break;
														} else {
															$blnEstadoMonto = false;
															break;
														}
													} else {
														$blnEstadoMonto = false;
													}
												}
											}
                                            
                                        }
                                        if ($strRespuesta[$p]['intIva'] == 1) {
                                            if ($blnEstadoMonto) {
                                                $intBaseIngreso +=
                                                    $strContenidoWebServiceFila[4] +
                                                    $strContenidoWebServiceFila[5];
                                                if (
                                                    $blnEstadoAgregarDocumentos
                                                ) {
                                                    $objVendedorModel->AgregarDocumentosLiquidacion(
                                                        $strContenidoWebServiceFila[0],
                                                        $strContenidoWebServiceFila[4] +
                                                            $strContenidoWebServiceFila[5],
                                                        '01',
                                                        $this->intAnno,
                                                        $strRespuesta[$p][
                                                            'intId'
                                                        ],
                                                        $strContenidoWebServiceFila[1],
                                                        $strContenidoWebServiceFila[6],
                                                        $strContenidoWebServiceFila[7],
                                                        $strContenidoWebServiceFila[9]
                                                    );
                                                }
                                            }
                                        } else {
                                            if ($blnEstadoMonto) {
                                                $intBaseIngreso +=
                                                    $strContenidoWebServiceFila[4];
                                                if (
                                                    $blnEstadoAgregarDocumentos
                                                ) {
                                                    $objVendedorModel->AgregarDocumentosLiquidacion(
                                                        $strContenidoWebServiceFila[0],
                                                        $strContenidoWebServiceFila[4],
                                                        '01',
                                                        $this->intAnno,
                                                        $strRespuesta[$p][
                                                            'intId'
                                                        ],
                                                        $strContenidoWebServiceFila[1],
                                                        $strContenidoWebServiceFila[6],
                                                        $strContenidoWebServiceFila[7],
                                                        $strContenidoWebServiceFila[9]
                                                    );
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            for ($i = 0;$i <= sizeof($strContenidoWebService) - 2;$i++) {
                                $blnEstadoMonto = true;
                                $strContenidoWebServiceFila = explode('%',$strContenidoWebService[$i]);
                                
                                if ($strRespuesta[$p]['intTiempoVisita'] == 1) {
									if (sizeof($strContenidoWebServiceTiempoVisita) == 1) {
										$blnEstadoMonto = false;
									}else{
										for ($k = 0;$k <=sizeof($strContenidoWebServiceTiempoVisita)-2;$k++) {
											$strTiempoVisita = explode('%',$strContenidoWebServiceTiempoVisita[$k]);
											if ($strTiempoVisita[1] ==$strContenidoWebServiceFila[0]) {
												if ($strTiempoVisita[0] ==$strContenidoWebServiceFila[2]) {
													if ($strRespuesta[$p]['strDiasVisita'] > $strTiempoVisita[2]) {
														$blnEstadoMonto = true;
														break;
													} else {
														$blnEstadoMonto = false;
														break;
													}
												} else {
													$blnEstadoMonto = false;
												}
											}
										}
									}
                                    
                                }
                                if ($strRespuesta[$p]['intIva'] == 1) {
                                    if ($blnEstadoMonto) {
                                        $intBaseIngreso +=
                                            $strContenidoWebServiceFila[4] +
                                            $strContenidoWebServiceFila[5];
                                        if ($blnEstadoAgregarDocumentos) {
                                            $objVendedorModel->AgregarDocumentosLiquidacion(
                                                $strContenidoWebServiceFila[0],
                                                $strContenidoWebServiceFila[4] +
                                                    $strContenidoWebServiceFila[5],
                                                '01',
                                                $this->intAnno,
                                                $strRespuesta[$p]['intId'],
                                                $strContenidoWebServiceFila[1],
                                                $strContenidoWebServiceFila[6],
                                                $strContenidoWebServiceFila[7],
                                                0,
                                                $strContenidoWebServiceFila[9]
                                            );
                                        }
                                    }
                                } else {
                                    if ($blnEstadoMonto) {
                                        $intBaseIngreso +=
                                            $strContenidoWebServiceFila[4];
                                        if ($blnEstadoAgregarDocumentos) {
                                            $objVendedorModel->AgregarDocumentosLiquidacion(
                                                $strContenidoWebServiceFila[0],
                                                $strContenidoWebServiceFila[4],
                                                '01',
                                                $this->intAnno,
                                                $strRespuesta[$p]['intId'],
                                                $strContenidoWebServiceFila[1],
                                                $strContenidoWebServiceFila[6],
                                                $strContenidoWebServiceFila[7],
                                                0,
                                                $strContenidoWebServiceFila[9]
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        // diferente de VN---------------------------------------------------------------------------------------------------
                        $ll = 0;
                        if ($strRespuesta[$p]['strTipoBaseIngreso'] == 'LZ') {
                            //

                            for (
                                $i = 0;
                                $i <= sizeof($strContenidoWebService) - 2;
                                $i++
                            ) {
                                $strContenidoWebServiceFila = explode(
                                    '%',
                                    $strContenidoWebService[$i]
                                );
                                $blnEstadoMonto = true;
                                for (
                                    $j = 0;
                                    $j <= sizeof($strRespuestaLineas) - 1;
                                    $j++
                                ) {
                                    if (
                                        $strRespuestaLineas[$j][
                                            'intCodigoLinea'
                                        ] ==
                                        trim($strContenidoWebServiceFila[5])
                                    ) {
                                        if (
                                            $strContenidoWebServiceFila[8] !=
                                                '08' &&
                                            $strContenidoWebServiceFila[8] !=
                                                '36' &&
                                            $strContenidoWebServiceFila[8] !=
                                                '14' &&
                                            $strContenidoWebServiceFila[8] !=
                                                '24'
                                        ) {
                                            if ($strRespuesta[$p]['intTiempoVisita'] == 1) {
                                                if (sizeof($strContenidoWebServiceTiempoVisita) == 1) {
                                                    $blnEstadoMonto = false;
                                                }else{
													for ($k = 0;$k <=sizeof($strContenidoWebServiceTiempoVisita) -2;$k++) {
														$strTiempoVisita = explode(
															'%',
															$strContenidoWebServiceTiempoVisita[
																$k
															]
														);
														if (
															$strTiempoVisita[0] ==
															$strContenidoWebServiceFila[4]
														) {
															if (
																$strRespuesta[$p][
																	'strDiasVisita'
																] >
																$strTiempoVisita[2]
															) {
																$blnEstadoMonto = true;
																break;
															} else {
																$blnEstadoMonto = false;
																break;
															}
														} else {
															$blnEstadoMonto = false;
														}
													}
												}
                                                
                                            }

                                            //validar ciudades recaudos//

                                            if ($blnEstadoMonto) {
                                                if (
                                                    sizeof(
                                                        $strRespuestaCiudades
                                                    ) == 0
                                                ) {
                                                    $blnEstadoMonto = false;
                                                }
                                                for (
                                                    $c = 0;
                                                    $c <=
                                                    sizeof(
                                                        $strRespuestaCiudades
                                                    ) -
                                                        1;
                                                    $c++
                                                ) {
                                                    if (
                                                        trim(
                                                            $strContenidoWebServiceFila[11]
                                                        ) ==
                                                        trim(
                                                            $strRespuestaCiudades[
                                                                $c
                                                            ]['intIdCiudad']
                                                        )
                                                    ) {
                                                        $blnEstadoMonto = true;
                                                        break;
                                                    } else {
                                                        $blnEstadoMonto = false;
                                                    }
                                                }
                                            }

                                            $intMontoTotal = 0;

                                            if (
                                                $strRespuesta[$p]['intIva'] == 1
                                            ) {
                                                if ($blnEstadoMonto) {
                                                    if (
                                                        str_replace(
                                                            ',',
                                                            '.',
                                                            $strContenidoWebServiceFila[6]
                                                        ) >= 1
                                                    ) {
                                                        $intBaseIngreso +=
                                                            $strContenidoWebServiceFila[7];
                                                        $intMontoTotal =
                                                            $strContenidoWebServiceFila[7];
                                                    } else {
                                                        $intBaseIngreso +=
                                                            $strContenidoWebServiceFila[7] *
                                                            str_replace(
                                                                ',',
                                                                '.',
                                                                $strContenidoWebServiceFila[6]
                                                            );
                                                        $intMontoTotal =
                                                            $strContenidoWebServiceFila[7] *
                                                            str_replace(
                                                                ',',
                                                                '.',
                                                                $strContenidoWebServiceFila[6]
                                                            );
                                                    }
                                                }
                                            } else {
                                                if ($blnEstadoMonto) {
                                                    if (
                                                        str_replace(
                                                            ',',
                                                            '.',
                                                            $strContenidoWebServiceFila[6]
                                                        ) >= 1
                                                    ) {
                                                        $intBaseIngreso +=
                                                            $strContenidoWebServiceFila[7] /
                                                            1.19;
                                                        $intMontoTotal =
                                                            $strContenidoWebServiceFila[7] /
                                                            1.19;
                                                    } else {
                                                        $intBaseIngreso +=
                                                            ($strContenidoWebServiceFila[7] *
                                                                str_replace(
                                                                    ',',
                                                                    '.',
                                                                    $strContenidoWebServiceFila[6]
                                                                )) /
                                                            1.19;
                                                        $intMontoTotal =
                                                            ($strContenidoWebServiceFila[7] *
                                                                str_replace(
                                                                    ',',
                                                                    '.',
                                                                    $strContenidoWebServiceFila[6]
                                                                )) /
                                                            1.19;
                                                    }
                                                }
                                            }

                                            if (
                                                $strRespuesta[$p][
                                                    'intDescuento'
                                                ] == 0
                                            ) {
                                                if ($blnEstadoMonto) {
                                                    for (
                                                        $u = 0;
                                                        $u <=
                                                        sizeof(
                                                            $strContenidoWebService
                                                        ) -
                                                            2;
                                                        $u++
                                                    ) {
                                                        $strContenidoWebServiceDescuento = explode(
                                                            '%',
                                                            $strContenidoWebService[
                                                                $u
                                                            ]
                                                        );
                                                        for (
                                                            $h = 0;
                                                            $h <=
                                                            sizeof(
                                                                $strRespuestaLineas
                                                            ) -
                                                                1;
                                                            $h++
                                                        ) {
                                                            if (
                                                                $strRespuestaLineas[
                                                                    $h
                                                                ][
                                                                    'intCodigoLinea'
                                                                ] ==
                                                                trim(
                                                                    $strContenidoWebServiceDescuento[5]
                                                                )
                                                            ) {
                                                                if (
                                                                    trim(
                                                                        $strContenidoWebServiceDescuento[8]
                                                                    ) == '08' &&
                                                                    trim(
                                                                        $strContenidoWebServiceFila[2]
                                                                    ) ==
                                                                        trim(
                                                                            $strContenidoWebServiceDescuento[2]
                                                                        )
                                                                ) {
                                                                    if (
                                                                        trim(
                                                                            $strContenidoWebServiceFila[0]
                                                                        ) ==
                                                                            trim(
                                                                                $strContenidoWebServiceDescuento[0]
                                                                            ) &&
                                                                        trim(
                                                                            $strContenidoWebServiceDescuento[5]
                                                                        ) ==
                                                                            trim(
                                                                                $strContenidoWebServiceFila[5]
                                                                            )
                                                                    ) {
                                                                        if (
                                                                            str_replace(
                                                                                ',',
                                                                                '.',
                                                                                $strContenidoWebServiceDescuento[6]
                                                                            ) >=
                                                                            1
                                                                        ) {
                                                                            $intBaseIngreso -=
                                                                                $strContenidoWebServiceDescuento[7];
                                                                            $intMontoTotal =
                                                                                $intMontoTotal -
                                                                                $strContenidoWebServiceDescuento[7];
                                                                        } else {
                                                                            $intBaseIngreso -=
                                                                                $strContenidoWebServiceDescuento[7] *
                                                                                str_replace(
                                                                                    ',',
                                                                                    '.',
                                                                                    $strContenidoWebServiceDescuento[6]
                                                                                );
                                                                            $intMontoTotal =
                                                                                $intMontoTotal -
                                                                                $strContenidoWebServiceDescuento[7] *
                                                                                    str_replace(
                                                                                        ',',
                                                                                        '.',
                                                                                        $strContenidoWebServiceDescuento[6]
                                                                                    );
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if (
                                                $blnEstadoMonto &&
                                                $blnEstadoAgregarDocumentos
                                            ) {
                                                $objVendedorModel->AgregarDocumentosLiquidacion(
                                                    $strContenidoWebServiceFila[0],
                                                    $intMontoTotal,
                                                    '01',
                                                    $this->intAnno,
                                                    $strRespuesta[$p]['intId'],
                                                    $strContenidoWebServiceFila[3],
                                                    $strContenidoWebServiceFila[9],
                                                    $strContenidoWebServiceFila[10],
                                                    $strContenidoWebServiceFila[2],
                                                    $strContenidoWebServiceFila[12]
                                                );
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            for (
                                $i = 0;
                                $i <= sizeof($strContenidoWebService) - 2;
                                $i++
                            ) {
                                $strContenidoWebServiceFila = explode(
                                    '%',
                                    $strContenidoWebService[$i]
                                );
                                $blnEstadoMonto = true;
                                if (
                                    $strContenidoWebServiceFila[8] != '08' &&
                                    $strContenidoWebServiceFila[8] != '36' &&
                                    $strContenidoWebServiceFila[8] != '14' &&
                                    $strContenidoWebServiceFila[8] != '24'
                                ) {
                                    if ($strRespuesta[$p]['intTiempoVisita'] ==1) {
										if (sizeof($strContenidoWebServiceTiempoVisita) == 1) {
											$blnEstadoMonto = false;
										}else{
											for ($k = 0;$k <=sizeof($strContenidoWebServiceTiempoVisita) -2;$k++) {
												$strTiempoVisita = explode(
													'%',
													$strContenidoWebServiceTiempoVisita[
														$k
													]
												);
												if (
													$strTiempoVisita[0] ==
													$strContenidoWebServiceFila[4]
												) {
													if (
														$strRespuesta[$p][
															'strDiasVisita'
														] > $strTiempoVisita[2]
													) {
														$blnEstadoMonto = true;
														break;
													} else {
														$blnEstadoMonto = false;
														break;
													}
												} else {
													$blnEstadoMonto = false;
												}
											}
										}
                                        
                                    }
                                    $intMontoTotal = 0;

                                    //lineas por porcentaje
                                    if ($strRespuesta[$p]['intIva'] == 1) {
                                        if ($blnEstadoMonto) {
                                            if (
                                                str_replace(
                                                    ',',
                                                    '.',
                                                    $strContenidoWebServiceFila[6]
                                                ) >= 1
                                            ) {
                                                $intBaseIngreso +=
                                                    $strContenidoWebServiceFila[7];
                                                $intMontoTotal =
                                                    $strContenidoWebServiceFila[7];
                                            } else {
                                                $intBaseIngreso +=
                                                    $strContenidoWebServiceFila[7] *
                                                    str_replace(
                                                        ',',
                                                        '.',
                                                        $strContenidoWebServiceFila[6]
                                                    );
                                                $intMontoTotal =
                                                    $strContenidoWebServiceFila[7] *
                                                    str_replace(
                                                        ',',
                                                        '.',
                                                        $strContenidoWebServiceFila[6]
                                                    );
                                            }
                                        }
                                    } else {
                                        if ($blnEstadoMonto) {
                                            if (
                                                str_replace(
                                                    ',',
                                                    '.',
                                                    $strContenidoWebServiceFila[6]
                                                ) >= 1
                                            ) {
                                                $intBaseIngreso +=
                                                    $strContenidoWebServiceFila[7] /
                                                    1.19;
                                                $intMontoTotal =
                                                    $strContenidoWebServiceFila[7] /
                                                    1.19;
                                            } else {
                                                $intBaseIngreso +=
                                                    ($strContenidoWebServiceFila[7] /
                                                        1.19) *
                                                    str_replace(
                                                        ',',
                                                        '.',
                                                        $strContenidoWebServiceFila[6]
                                                    );
                                                $intMontoTotal =
                                                    ($strContenidoWebServiceFila[7] /
                                                        1.19) *
                                                    str_replace(
                                                        ',',
                                                        '.',
                                                        $strContenidoWebServiceFila[6]
                                                    );
                                            }
                                        }
                                    }

                                    if (
                                        $strRespuesta[$p]['intDescuento'] == 0
                                    ) {
                                        if ($blnEstadoMonto) {
                                            for (
                                                $j = 0;
                                                $j <=
                                                sizeof(
                                                    $strContenidoWebService
                                                ) -
                                                    2;
                                                $j++
                                            ) {
                                                $strContenidoWebServiceDescuento = explode(
                                                    '%',
                                                    $strContenidoWebService[$j]
                                                );

                                                if (
                                                    trim(
                                                        $strContenidoWebServiceDescuento[8]
                                                    ) == '08' &&
                                                    trim(
                                                        $strContenidoWebServiceFila[2]
                                                    ) ==
                                                        trim(
                                                            $strContenidoWebServiceDescuento[2]
                                                        )
                                                ) {
                                                    if (
                                                        trim(
                                                            $strContenidoWebServiceFila[0]
                                                        ) ==
                                                            trim(
                                                                $strContenidoWebServiceDescuento[0]
                                                            ) &&
                                                        trim(
                                                            $strContenidoWebServiceDescuento[5]
                                                        ) ==
                                                            trim(
                                                                $strContenidoWebServiceFila[5]
                                                            )
                                                    ) {
                                                        if (
                                                            str_replace(
                                                                ',',
                                                                '.',
                                                                $strContenidoWebServiceDescuento[6]
                                                            ) >= 1
                                                        ) {
                                                            $intBaseIngreso -=
                                                                $strContenidoWebServiceDescuento[7];
                                                            $intMontoTotal =
                                                                $intMontoTotal -
                                                                $strContenidoWebServiceDescuento[7];
                                                        } else {
                                                            $intBaseIngreso -=
                                                                $strContenidoWebServiceDescuento[7] *
                                                                str_replace(
                                                                    ',',
                                                                    '.',
                                                                    $strContenidoWebServiceDescuento[6]
                                                                );
                                                            $intMontoTotal =
                                                                $intMontoTotal -
                                                                $strContenidoWebServiceDescuento[7] *
                                                                    str_replace(
                                                                        ',',
                                                                        '.',
                                                                        $strContenidoWebServiceDescuento[6]
                                                                    );
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if (
                                        $blnEstadoMonto &&
                                        $blnEstadoAgregarDocumentos
                                    ) {
                                        $objVendedorModel->AgregarDocumentosLiquidacion(
                                            $strContenidoWebServiceFila[0],
                                            $intMontoTotal,
                                            '01',
                                            $this->intAnno,
                                            $strRespuesta[$p]['intId'],
                                            $strContenidoWebServiceFila[3],
                                            $strContenidoWebServiceFila[9],
                                            $strContenidoWebServiceFila[10],
                                            $strContenidoWebServiceFila[2],
                                            $strContenidoWebServiceFila[12]
                                        );
                                    }
                                }
                            }
                        }
                    }
                    $intBaseIngreso =
                        ($intBaseIngreso * $strRespuesta[$p]['intValor']) / 100;
                    if ($strRespuesta[$p]['intTipo'] == 0) {
                        $blnActualizarIngreso = true;
                        $blnEstadoIngreso = 1;
                        $intMontoIngreso = $intBaseIngreso * $intCantidad;
                    } elseif ($strRespuesta[$p]['intTipo'] == 1) {
                        if (
                            explode(
                                '-',
                                str_replace(
                                    '0',
                                    '',
                                    $strRespuesta[$p]['dtFechaInicial']
                                )
                            )[1] == $this->intMes &&
                            explode(
                                '-',
                                $strRespuesta[$p]['dtFechaInicial']
                            )[0] == $this->intAnno
                        ) {
                            $intMontoIngreso = $intBaseIngreso;
                            $blnEstadoIngreso = 0;
                            $intEstadoTipoPeriocidad = -1;
                            $blnActualizarIngreso = true;
                        }
                    } elseif ($strRespuesta[$p]['intTipo'] == 2) {
                        $blnEstadoUltimoDia = true;
                        if (
                            explode(
                                '-',
                                str_replace(
                                    '0',
                                    '',
                                    $strRespuesta[$p]['dtFechaFinal']
                                )
                            )[1] < $this->intMes &&
                            $strRespuesta[$p]['strPeriocidad'] == 'MS' &&
                            explode(
                                '-',
                                $strRespuesta[$p]['dtFechaFinal']
                            )[0] == $this->intAnno
                        ) {
                            $intMontoIngreso = 0;
                            $blnActualizarIngreso = true;
                            $blnEstadoIngreso = 0;
                            $intEstadoTipoPeriocidad = -1;
                            $blnEstadoUltimoDia = false;
                        } else {
                            if (
                                explode(
                                    '-',
                                    str_replace(
                                        '0',
                                        '',
                                        $strRespuesta[$p]['dtFechaFinal']
                                    )
                                )[1] == $this->intMes &&
                                ($this->strMesTipo == 2 ||
                                    $this->strMesTipo == 0) &&
                                explode(
                                    '-',
                                    $strRespuesta[$p]['dtFechaFinal']
                                )[2] <= 15 &&
                                explode(
                                    '-',
                                    $strRespuesta[$p]['dtFechaFinal']
                                )[0] == $this->intAnno
                            ) {
                                $intMontoIngreso = 0;
                                $blnActualizarIngreso = true;
                                $blnEstadoIngreso = 0;
                                $intEstadoTipoPeriocidad = -1;
                                $blnEstadoUltimoDia = false;
                            }
                            if (
                                $this->intMes >
                                    explode(
                                        '-',
                                        str_replace(
                                            '0',
                                            '',
                                            $strRespuesta[$p]['dtFechaFinal']
                                        )
                                    )[1] &&
                                explode(
                                    '-',
                                    $strRespuesta[$p]['dtFechaFinal']
                                )[0] == $this->intAnno
                            ) {
                                $intMontoIngreso = 0;
                                $blnActualizarIngreso = true;
                                $blnEstadoIngreso = 0;
                                $intEstadoTipoPeriocidad = -1;
                                $blnEstadoUltimoDia = false;
                            }
                        }
                        if ($blnEstadoUltimoDia) {
                            if (
                                $this->intMes >=
                                    explode(
                                        '-',
                                        str_replace(
                                            '0',
                                            '',
                                            $strRespuesta[$p]['dtFechaInicial']
                                        )
                                    )[1] &&
                                explode(
                                    '-',
                                    $strRespuesta[$p]['dtFechaInicial']
                                )[0] == $this->intAnno
                            ) {
                                $blnActualizarIngreso = true;
                                $blnEstadoIngreso = 1;
                                $intMontoIngreso =
                                    $intBaseIngreso * $intCantidad;
                            }
                        }
                    }
                }
            }
            $blnActualizar = false;
            if (
                $this->intMes == 12 &&
                ($this->strMesTipo == 2 || $this->strMesTipo == 0)
            ) {
                $strMes = '01';
                $strDia = '01';
                $strAnno = date('Y') + 1;
                $blnActualizar = true;
            } else {
                if (
                    $strRespuesta[$p]['strPeriocidad'] == 'MS' &&
                    ($this->strMesTipo == 2 || $this->strMesTipo == 0)
                ) {
                    $strMes = $this->intMes + 1;
                    $strDia = '01';
                    $strAnno = date('Y');
                    $blnActualizar = true;
                }
                if ($strRespuesta[$p]['strPeriocidad'] == 'QC') {
                    if ($this->strMesTipo == 1) {
                        $strMes = $this->intMes;
                        $strDia = '16';
                        $strAnno = date('Y');
                        $blnActualizar = true;
                    } else {
                        $strMes = $this->intMes + 1;
                        $strDia = '01';
                        $strAnno = date('Y');
                        $blnActualizar = true;
                    }
                }
            }
            //if(explode('-',str_replace('0','',$strRespuesta[$p]['dtUltimaFechaLiqui']))[1] != $this->intMes){
            //	$blnActualizar=false;
            //}

            if ($blnActualizar) {
                if ($strMes <= 9) {
                    $strMes = str_replace('0', '', $strMes);
                }
                $objVendedorModel->ActualizarIngreso(
                    $this->strCedula,
                    $this->intCompania,
                    $strRespuesta[$p]['intId'],
                    $intEstadoTipoPeriocidad,
                    $blnEstadoIngreso,
                    $strAnno . '-' . $strMes . '-' . $strDia
                );
                $objVendedorModel->CrearDetalleLiquidacion(
                    $strRespuesta[$p]['intId'],
                    $intMontoIngreso,
                    1
                );
            }
        }
    }
}

?>
