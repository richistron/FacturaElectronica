<?php
/**
 * SimpleCFD (Comprobantes Fiscales Digitales)
 * Copyright (C) 2010 Basilio Briceno Hernandez <bbh@tlalokes.org>
 *
 * SimpleCFD class is free software: you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation, version 3 of the License.
 *
 * SimpleCFD is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with SimpleCFD. If not, see <http://www.gnu.org/licenses/lgpl.html>.
 */

/**
 * SimpleCFD provides static methods to process a Comprobante Fiscal Digital
 * also named as Factura Electronica.
 *
 * @author Basilio Brice&ntilde;o Hern&aacute;ndez <bbh@tlalokes.org>
 * @copyright Copyright &copy; 2010 Basilio Brice&ntilde;o Hern&aacute;ndez
 * @license http://www.gnu.org/licenses/lgpl.html GNU LGPL
 */
class SimpleCFD {

  /**
   * Trasforms a CFD array into a CFD XML
   *
   * @param array $data
   * @return string CFD XML
   */
  public static function getXML ( array $data )
  {
    $dom = new DOMDocument( '1.0', 'utf-8' );
    $dom->formatOutput = true;

    // Comprobante
    $co = $dom->createElement( 'Comprobante' );
    $dom->appendChild( $co );

    $xmlns = $dom->createAttribute( 'xmlns' );
    $xmlns->appendChild( $dom->createTextNode( "http://www.sat.gob.mx/cfd/2" ) );
    $co->appendChild( $xmlns );

    $xmlns_xsi = $dom->createAttribute( 'xmlns:xsi' );
    $xmlns_xsi->appendChild( $dom->createTextNode( "http://www.w3.org/2001/XMLSchema-instance") );
    $co->appendChild( $xmlns_xsi );

    $xsi = $dom->createAttribute( 'xsi:schemaLocation' );
    $xsi->appendChild( $dom->createTextNode( "http://www.sat.gob.mx/cfd/2 http://www.sat.gob.mx/sitio_internet/cfd/2/cfdv2.xsd" ) );
    $co->appendChild( $xsi );

    $version = $dom->createAttribute( 'version' );
    $co->appendChild( $version );
    $version->appendChild( $dom->createTextNode( '2.0' ) );

    if ( isset( $data['serie'] ) ) {
      $serie = $dom->createAttribute( 'serie' );
      $co->appendChild( $serie );
      $serie->appendChild( $dom->createTextNode( $data['serie'] ) );
    }

    if ( isset( $data['folio'] ) ) {
      $folio = $dom->createAttribute( 'folio' );
      $co->appendChild( $folio );
      $folio->appendChild( $dom->createTextNode( $data['folio'] ) );
    }

    if ( isset( $data['fecha'] ) ) {
      $fecha = $dom->createAttribute( 'fecha' );
      $co->appendChild( $fecha );
      $fecha->appendChild( $dom->createTextNode( $data['fecha'] ) );
    }

    if ( isset( $data['sello'] ) ) {
      $sello = $dom->createAttribute( 'sello' );
      $co->appendChild( $sello );
      $sello->appendChild( $dom->createTextNode( $data['sello'] ) );
    }

    if ( isset( $data['noAprobacion'] ) ) {
      $noAprobacion = $dom->createAttribute( 'noAprobacion' );
      $co->appendChild( $noAprobacion );
      $noAprobacion->appendChild( $dom->createTextNode( $data['noAprobacion'] ) );
    }

    if ( isset( $data['anoAprobacion'] ) ) {
      $anoAprobacion = $dom->createAttribute( 'anoAprobacion' );
      $co->appendChild( $anoAprobacion );
      $anoAprobacion->appendChild( $dom->createTextNode( $data['anoAprobacion'] ) );
    }

    if ( isset( $data['tipoDeComprobante'] ) ) {
      $tipoDeComprobante = $dom->createAttribute( 'tipoDeComprobante' );
      $co->appendChild( $tipoDeComprobante );
      $tipoDeComprobante->appendChild( $dom->createTextNode( $data['tipoDeComprobante'] ) );
    }

    if ( isset( $data['formaDePago'] ) ) {
      $formaDePago = $dom->createAttribute( 'formaDePago' );
      $co->appendChild( $formaDePago );
      $formaDePago->appendChild( $dom->createTextNode( $data['formaDePago'] ) );
    }

    if ( isset( $data['noCertificado'] ) ) {
      $noCertificado = $dom->createAttribute( 'noCertificado' );
      $co->appendChild( $noCertificado );
      $noCertificado->appendChild( $dom->createTextNode( $data['noCertificado'] ) );
    }

    if ( isset( $data['certificado'] ) ) {
      $certificado = $dom->createAttribute( 'certificado' );
      $co->appendChild( $certificado );
      $certificado->appendChild( $dom->createTextNode( $data['certificado'] ) );
    }

    if ( isset( $data['subTotal'] ) ) {
      $subTotal = $dom->createAttribute( 'subTotal' );
      $co->appendChild( $subTotal );
      $subTotal->appendChild( $dom->createTextNode( $data['subTotal'] ) );
    }

    if ( isset( $data['descuento'] ) ) {
      $descuento = $dom->createAttribute( 'descuento' );
      $co->appendChild( $descuento );
      $descuento->appendChild( $dom->createTextNode( $data['descuento'] ) );
    }

    if ( isset( $data['total'] ) ) {
      $total = $dom->createAttribute( 'total' );
      $co->appendChild( $total );
      $total->appendChild( $dom->createTextNode( $data['total'] ) );
    }

    // Emisor
    $e = $dom->createElement( 'Emisor' );
    $co->appendChild( $e );

    if ( isset( $data['Emisor']['rfc'] ) ) {
      $e_rfc = $dom->createAttribute( 'rfc' );
      $e->appendChild( $e_rfc );
      $e_rfc->appendChild( $dom->createTextNode( $data['Emisor']['rfc'] ) );
    }

    if ( isset( $data['Emisor']['nombre'] ) ) {
      $e_nombre = $dom->createAttribute( 'nombre' );
      $e->appendChild( $e_nombre );
      $e_nombre->appendChild( $dom->createTextNode( $data['Emisor']['nombre'] ) );
    }

    // DomicilioFiscal
    $df = $dom->createElement( 'DomicilioFiscal' );
    $e->appendChild( $df );

    if ( isset( $data['DomicilioFiscal']['calle'] ) ) {
      $df_calle = $dom->createAttribute( 'calle' );
      $df->appendChild( $df_calle );
      $df_calle->appendChild( $dom->createTextNode( $data['Emisor']['nombre'] ) );
    }

    if ( isset( $data['DomicilioFiscal']['noExterior'] ) ) {
      $df_noExterior = $dom->createAttribute( 'noExterior' );
      $df->appendChild( $df_noExterior );
      $df_noExterior->appendChild( $dom->createTextNode( $data['DomicilioFiscal']['noExterior'] ) );
    }

    if ( isset( $data['DomicilioFiscal']['noInterior'] ) ) {
      $df_noInterior = $dom->createAttribute( 'noInterior' );
      $df->appendChild( $df_noInterior );
      $df_noInterior->appendChild( $dom->createTextNode( $data['DomicilioFiscal']['noInterior'] ) );
    }

    if ( isset( $data['DomicilioFiscal']['colonia'] ) ) {
      $df_colonia = $dom->createAttribute( 'colonia' );
      $df->appendChild( $df_colonia );
      $df_colonia->appendChild( $dom->createTextNode( $data['DomicilioFiscal']['colonia'] ) );
    }

    if ( isset( $data['DomicilioFiscal']['localidad'] ) ) {
      $df_localidad = $dom->createAttribute( 'localidad' );
      $df->appendChild( $df_localidad );
      $df_localidad->appendChild( $dom->createTextNode( $data['DomicilioFiscal']['localidad'] ) );
    }

    if ( isset( $data['DomicilioFiscal']['referencia'] ) ) {
      $df_referencia = $dom->createAttribute( 'referencia' );
      $df->appendChild( $df_referencia );
      $df_referencia->appendChild( $dom->createTextNode( $data['DomicilioFiscal']['referencia'] ) );
    }

    if ( isset( $data['DomicilioFiscal']['municipio'] ) ) {
      $df_municipio = $dom->createAttribute( 'municipio' );
      $df->appendChild( $df_municipio );
      $df_municipio->appendChild( $dom->createTextNode( $data['DomicilioFiscal']['municipio'] ) );
    }

    if ( isset( $data['DomicilioFiscal']['estado'] ) ) {
      $df_estado = $dom->createAttribute( 'estado' );
      $df->appendChild( $df_estado );
      $df_estado->appendChild( $dom->createTextNode( $data['DomicilioFiscal']['estado'] ) );
    }

    if ( isset( $data['DomicilioFiscal']['pais'] ) ) {
      $df_pais = $dom->createAttribute( 'pais' );
      $df->appendChild( $df_pais );
      $df_pais->appendChild( $dom->createTextNode( $data['DomicilioFiscal']['pais'] ) );
    }

    if ( isset( $data['DomicilioFiscal']['codigoPostal'] ) ) {
      $df_codigoPostal = $dom->createAttribute( 'codigoPostal' );
      $df->appendChild( $df_codigoPostal );
      $df_codigoPostal->appendChild( $dom->createTextNode( $data['DomicilioFiscal']['codigoPostal'] ) );
    }

    // ExpedidoEn
    $en = $dom->createElement( 'ExpedidoEn' );
    $e->appendChild( $en );

    if ( isset( $data['ExpedidoEn']['calle'] ) ) {
      $en_calle = $dom->createAttribute( 'calle' );
      $en->appendChild( $en_calle );
      $en_calle->appendChild( $dom->createTextNode( $data['Emisor']['nombre'] ) );
    }

    if ( isset( $data['ExpedidoEn']['noExterior'] ) ) {
      $en_noExterior = $dom->createAttribute( 'noExterior' );
      $en->appendChild( $en_noExterior );
      $en_noExterior->appendChild( $dom->createTextNode( $data['ExpedidoEn']['noExterior'] ) );
    }

    if ( isset( $data['ExpedidoEn']['noInterior'] ) ) {
      $en_noInterior = $dom->createAttribute( 'noInterior' );
      $en->appendChild( $en_noInterior );
      $en_noInterior->appendChild( $dom->createTextNode( $data['ExpedidoEn']['noInterior'] ) );
    }

    if ( isset( $data['ExpedidoEn']['colonia'] ) ) {
      $en_colonia = $dom->createAttribute( 'colonia' );
      $en->appendChild( $en_colonia );
      $en_colonia->appendChild( $dom->createTextNode( $data['ExpedidoEn']['colonia'] ) );
    }

    if ( isset( $data['ExpedidoEn']['localidad'] ) ) {
      $en_localidad = $dom->createAttribute( 'localidad' );
      $en->appendChild( $en_localidad );
      $en_localidad->appendChild( $dom->createTextNode( $data['ExpedidoEn']['localidad'] ) );
    }

    if ( isset( $data['ExpedidoEn']['referencia'] ) ) {
      $en_referencia = $dom->createAttribute( 'referencia' );
      $en->appendChild( $en_referencia );
      $en_referencia->appendChild( $dom->createTextNode( $data['ExpedidoEn']['referencia'] ) );
    }

    if ( isset( $data['ExpedidoEn']['municipio'] ) ) {
      $en_municipio = $dom->createAttribute( 'municipio' );
      $en->appendChild( $en_municipio );
      $en_municipio->appendChild( $dom->createTextNode( $data['ExpedidoEn']['municipio'] ) );
    }

    if ( isset( $data['ExpedidoEn']['estado'] ) ) {
      $en_estado = $dom->createAttribute( 'estado' );
      $en->appendChild( $en_estado );
      $en_estado->appendChild( $dom->createTextNode( $data['ExpedidoEn']['estado'] ) );
    }

    if ( isset( $data['ExpedidoEn']['pais'] ) ) {
      $en_pais = $dom->createAttribute( 'pais' );
      $en->appendChild( $en_pais );
      $en_pais->appendChild( $dom->createTextNode( $data['ExpedidoEn']['pais'] ) );
    }

    if ( isset( $data['ExpedidoEn']['codigoPostal'] ) ) {
      $en_codigoPostal = $dom->createAttribute( 'codigoPostal' );
      $en->appendChild( $en_codigoPostal );
      $en_codigoPostal->appendChild( $dom->createTextNode( $data['ExpedidoEn']['codigoPostal'] ) );
    }

    // Receptor
    $r = $dom->createElement( 'Receptor' );
    $co->appendChild( $r );

    if ( isset( $data['Receptor']['rfc'] ) ) {
      $r_rfc = $dom->createAttribute( 'rfc' );
      $r->appendChild( $r_rfc );
      $r_rfc->appendChild( $dom->createTextNode( $data['Receptor']['rfc'] ) );
    }

    if ( isset( $data['Receptor']['nombre'] ) ) {
      $r_nombre = $dom->createAttribute( 'nombre' );
      $r->appendChild( $r_nombre );
      $r_nombre->appendChild( $dom->createTextNode( $data['Receptor']['nombre'] ) );
    }

    // Domicilio
    $d = $dom->createElement( 'Domicilio' );
    $e->appendChild( $d );

    if ( isset( $data['Domicilio']['calle'] ) ) {
      $d_calle = $dom->createAttribute( 'calle' );
      $d->appendChild( $d_calle );
      $d_calle->appendChild( $dom->createTextNode( $data['Emisor']['nombre'] ) );
    }

    if ( isset( $data['Domicilio']['noExterior'] ) ) {
      $d_noExterior = $dom->createAttribute( 'noExterior' );
      $d->appendChild( $d_noExterior );
      $d_noExterior->appendChild( $dom->createTextNode( $data['Domicilio']['noExterior'] ) );
    }

    if ( isset( $data['Domicilio']['noInterior'] ) ) {
      $d_noInterior = $dom->createAttribute( 'noInterior' );
      $d->appendChild( $d_noInterior );
      $d_noInterior->appendChild( $dom->createTextNode( $data['Domicilio']['noInterior'] ) );
    }

    if ( isset( $data['Domicilio']['colonia'] ) ) {
      $d_colonia = $dom->createAttribute( 'colonia' );
      $d->appendChild( $d_colonia );
      $d_colonia->appendChild( $dom->createTextNode( $data['Domicilio']['colonia'] ) );
    }

    if ( isset( $data['Domicilio']['localidad'] ) ) {
      $d_localidad = $dom->createAttribute( 'localidad' );
      $d->appendChild( $d_localidad );
      $d_localidad->appendChild( $dom->createTextNode( $data['Domicilio']['localidad'] ) );
    }

    if ( isset( $data['Domicilio']['referencia'] ) ) {
      $d_referencia = $dom->createAttribute( 'referencia' );
      $d->appendChild( $d_referencia );
      $d_referencia->appendChild( $dom->createTextNode( $data['Domicilio']['referencia'] ) );
    }

    if ( isset( $data['Domicilio']['municipio'] ) ) {
      $d_municipio = $dom->createAttribute( 'municipio' );
      $d->appendChild( $d_municipio );
      $d_municipio->appendChild( $dom->createTextNode( $data['Domicilio']['municipio'] ) );
    }

    if ( isset( $data['Domicilio']['estado'] ) ) {
      $d_estado = $dom->createAttribute( 'estado' );
      $d->appendChild( $d_estado );
      $d_estado->appendChild( $dom->createTextNode( $data['Domicilio']['estado'] ) );
    }

    if ( isset( $data['Domicilio']['pais'] ) ) {
      $d_pais = $dom->createAttribute( 'pais' );
      $d->appendChild( $d_pais );
      $d_pais->appendChild( $dom->createTextNode( $data['Domicilio']['pais'] ) );
    }

    if ( isset( $data['Domicilio']['codigoPostal'] ) ) {
      $d_codigoPostal = $dom->createAttribute( 'codigoPostal' );
      $d->appendChild( $d_codigoPostal );
      $d_codigoPostal->appendChild( $dom->createTextNode( $data['Domicilio']['codigoPostal'] ) );
    }

    // Conceptos
    $cs = $dom->createElement( 'Conceptos' );
    $co->appendChild( $cs );

    $count = count( $data['Concepto'] );
    if ( $count == 1 ) {

      $c = $dom->createElement( 'Concepto' );
      $cs->appendChild( $c );

      if ( isset( $data['Concepto'][0]['cantidad'] ) ) {
        $c_cantidad = $dom->createAttribute( 'cantidad' );
        $c->appendChild( $c_cantidad );
        $c_cantidad->appendChild( $dom->createTextNode( $data['Concepto'][0]['cantidad'] ) );
      }

      if ( isset( $data['Concepto'][0]['unidad'] ) ) {
        $c_unidad = $dom->createAttribute( 'unidad' );
        $c->appendChild( $c_unidad );
        $c_unidad->appendChild( $dom->createTextNode( $data['Concepto'][0]['unidad'] ) );
      }

      if ( isset( $data['Concepto'][0]['noIdentificacion'] ) ) {
        $c_noIdentificacion = $dom->createAttribute( 'noIdentificacion' );
        $c->appendChild( $c_noIdentificacion );
        $c_noIdentificacion->appendChild( $dom->createTextNode( $data['Concepto'][0]['noIdentificacion'] ) );
      }

      if ( isset( $data['Concepto'][0]['descripcion'] ) ) {
        $c_descripcion = $dom->createAttribute( 'descripcion' );
        $c->appendChild( $c_descripcion );
        $c_descripcion->appendChild( $dom->createTextNode( $data['Concepto'][0]['descripcion'] ) );
      }

      if ( isset( $data['Concepto'][0]['valorUnitario'] ) ) {
        $c_valorUnitario = $dom->createAttribute( 'valorUnitario' );
        $c->appendChild( $c_valorUnitario );
        $c_valorUnitario->appendChild( $dom->createTextNode( $data['Concepto'][0]['valorUnitario'] ) );
      }

      if ( isset( $data['Concepto'][0]['importe'] ) ) {
        $c_importe = $dom->createAttribute( 'importe' );
        $c->appendChild( $c_importe );
        $c_importe->appendChild( $dom->createTextNode( $data['Concepto'][0]['importe'] ) );
      }
    } else {
      for( $i = 0; $i < $count; ++$i ) {

        $c_{$i} = $dom->createElement( 'Concepto' );
        $cs->appendChild( $c_{$i} );

        if ( isset( $data['Concepto'][$i]['cantidad'] ) ) {
          $c_cantidad = $dom->createAttribute( 'cantidad' );
          $c_{$i}->appendChild( $c_cantidad );
          $c_cantidad->appendChild( $dom->createTextNode( $data['Concepto'][$i]['cantidad'] ) );
        }

        if ( isset( $data['Concepto'][$i]['unidad'] ) ) {
          $c_unidad[$i] = $dom->createAttribute( 'unidad' );
          $c_{$i}->appendChild( $c_unidad[$i] );
          $c_unidad[$i]->appendChild( $dom->createTextNode( $data['Concepto'][$i]['unidad'] ) );
        }

        if ( isset( $data['Concepto'][$i]['noIdentificacion'] ) ) {
          $c_noIdentificacion[$i] = $dom->createAttribute( 'noIdentificacion' );
          $c_{$i}->appendChild( $c_noIdentificacion[$i] );
          $c_noIdentificacion[$i]->appendChild( $dom->createTextNode( $data['Concepto'][$i]['noIdentificacion'] ) );
        }

        if ( isset( $data['Concepto'][$i]['descripcion'] ) ) {
          $c_descripcion = $dom->createAttribute( 'descripcion' );
          $c_{$i}->appendChild( $c_descripcion );
          $c_descripcion->appendChild( $dom->createTextNode( $data['Concepto'][$i]['descripcion'] ) );
        }

        if ( isset( $data['Concepto'][$i]['valorUnitario'] ) ) {
          $c_valorUnitario = $dom->createAttribute( 'valorUnitario' );
          $c_{$i}->appendChild( $c_valorUnitario );
          $c_valorUnitario->appendChild( $dom->createTextNode( $data['Concepto'][$i]['valorUnitario'] ) );
        }

        if ( isset( $data['Concepto'][$i]['importe'] ) ) {
          $c_importe = $dom->createAttribute( 'importe' );
          $c_{$i}->appendChild( $c_importe );
          $c_importe->appendChild( $dom->createTextNode( $data['Concepto'][$i]['importe'] ) );
        }
      }
    }

    // Impuestos
    $im = $dom->createElement( 'Impuestos' );
    $co->appendChild( $im );

    // Retenciones
    if ( isset( $data['Retencion'] ) ) {
      $rs = $dom->createElement( 'Retenciones' );
      $im->appendChild( $rs );

      // Retencion
      $count = count( $data['Retencion'] );
      if ( $count == 1 ) {

        $rt = $dom->createElement( 'Retencion' );
        $rs->appendChild( $rt );

        if ( isset( $data['Retencion'][0]['impuesto'] ) ) {
          $rt_impuesto = $dom->createAttribute( 'impuesto' );
          $rt->appendChild( $rt_impuesto );
          $rt_impuesto->appendChild( $dom->createTextNode( $data['Retencion'][0]['impuesto'] ) );
        }

        if ( isset( $data['Retencion'][0]['importe'] ) ) {
          $rt_importe = $dom->createAttribute( 'importe' );
          $rt->appendChild( $rt_importe );
          $rt_importe->appendChild( $dom->createTextNode( $data['Retencion'][0]['importe'] ) );
        }
      } else {
        for( $i = 0; $i < $count; ++$i ) {

          $rt_{$i} = $dom->createElement( 'Retencion' );
          $rs->appendChild( $rt_{$i} );

          if ( isset( $data['Retencion'][$i]['impuesto'] ) ) {
            $rt_impuesto = $dom->createAttribute( 'impuesto' );
            $rt_{$i}->appendChild( $rt_impuesto );
            $rt_impuesto->appendChild( $dom->createTextNode( $data['Retencion'][$i]['impuesto'] ) );
          }

          if ( isset( $data['Retencion'][$i]['importe'] ) ) {
            $rt_importe = $dom->createAttribute( 'importe' );
            $rt_{$i}->appendChild( $rt_importe );
            $rt_importe->appendChild( $dom->createTextNode( $data['Retencion'][$i]['importe'] ) );
          }
        }
      }
    }

    // Traslados
    if ( isset( $data['Traslados'] ) ) {

      $ts = $dom->createElement( 'Traslados' );
      $im->appendChild( $ts );

      // Traslado
      $count = count( $data['Traslado'] );
      if ( $count == 1 ) {

        $tr = $dom->createElement( 'Traslado' );
        $ts->appendChild( $tr );

        if ( isset( $data['Traslado'][0]['impuesto'] ) ) {
          $ts_impuesto = $dom->createAttribute( 'impuesto' );
          $tr->appendChild( $ts_impuesto );
          $ts_impuesto->appendChild( $dom->createTextNode( $data['Traslado'][0]['impuesto'] ) );
        }

        if ( isset( $data['Traslado'][0]['tasa'] ) ) {
          $ts_tasa = $dom->createAttribute( 'importe' );
          $tr->appendChild( $ts_tasa );
          $ts_tasa->appendChild( $dom->createTextNode( $data['Traslado'][0]['tasa'] ) );
        }

        if ( isset( $data['Traslado'][0]['importe'] ) ) {
          $ts_importe = $dom->createAttribute( 'importe' );
          $tr->appendChild( $ts_importe );
          $ts_importe->appendChild( $dom->createTextNode( $data['Traslado'][0]['importe'] ) );
        }
      } else {
        for( $i = 0; $i < $count; ++$i ) {

          $tr_{$i} = $dom->createElement( 'Traslado' );
          $ts->appendChild( $tr_{$i} );

          if ( isset( $data['Traslado'][0]['impuesto'] ) ) {
            $ts_impuesto = $dom->createAttribute( 'impuesto' );
            $tr_{$i}->appendChild( $ts_impuesto );
            $ts_impuesto->appendChild( $dom->createTextNode( $data['Traslado'][0]['impuesto'] ) );
          }

          if ( isset( $data['Traslado'][0]['tasa'] ) ) {
            $ts_tasa = $dom->createAttribute( 'importe' );
            $tr_{$i}->appendChild( $ts_tasa );
            $ts_tasa->appendChild( $dom->createTextNode( $data['Traslado'][0]['tasa'] ) );
          }

          if ( isset( $data['Traslado'][0]['importe'] ) ) {
            $ts_importe = $dom->createAttribute( 'importe' );
            $tr_{$i}->appendChild( $ts_importe );
            $ts_importe->appendChild( $dom->createTextNode( $data['Traslado'][0]['importe'] ) );
          }
        }
      }
    }

    return $dom->saveXML();
  }

  /**
   * Validates and transforma an array of data to a | (pipe) separated string
   *
   * @param array contains the FEA data
   * @return string separated by | (pipe)
   */
  public static function getOriginalString ( array &$data )
  {
    if ( !$data ) {
      return false;
    }

    $string = '||';

    // Comprobante
    $string .= isset( $data['version'] ) ? $data['version'].'|' : '';
    $string .= isset( $data['serie'] ) ? $data['serie'].'|' : '';
    $string .= isset( $data['folio'] ) ? $data['folio'].'|' : '';
    $string .= isset( $data['fecha'] ) ? $data['fecha'].'|' : ''; // 2010-11-24T16:30:00
    $string .= isset( $data['noAprobacion'] ) ? $data['noAprobacion'].'|' : '';

    // Emisor
    if ( !isset( $data['Emisor'] ) ) {
      die( 'You must provide the Emisor in your array'."\n" );
    }
    $string .= isset( $data['Emisor']['rfc'] ) ? $data['Emisor']['rfc'].'|' : '';
    $string .= isset( $data['Emisor']['nombre'] ) ? $data['Emisor']['nombre'].'|' : '';

    // DomicilioFiscal
    $string .= isset( $data['DomicilioFiscal']['calle'] ) ? $data['DomicilioFiscal']['calle'].'|' : '';
    $string .= isset( $data['DomicilioFiscal']['noExterior'] ) ? $data['DomicilioFiscal']['noExterior'].'|' : '';
    $string .= isset( $data['DomicilioFiscal']['noInterior'] ) ? $data['DomicilioFiscal']['noInterior'].'|' : '';
    $string .= isset( $data['DomicilioFiscal']['colonia'] ) ? $data['DomicilioFiscal']['colonia'].'|' : '';
    $string .= isset( $data['DomicilioFiscal']['localidad'] ) ? $data['DomicilioFiscal']['localidad'].'|' : '';
    $string .= isset( $data['DomicilioFiscal']['referencia'] ) ? $data['DomicilioFiscal']['referencia'].'|' : '';
    $string .= isset( $data['DomicilioFiscal']['municipio'] ) ? $data['DomicilioFiscal']['municipio'].'|' : '';
    $string .= isset( $data['DomicilioFiscal']['estado'] ) ? $data['DomicilioFiscal']['estado'].'|' : '';
    $string .= isset( $data['DomicilioFiscal']['pais'] ) ? $data['DomicilioFiscal']['pais'].'|' : '';
    $string .= isset( $data['DomicilioFiscal']['codigoPostal'] ) ? $data['DomicilioFiscal']['codigoPostal'].'|' : '';

    // ExpedidoEn
    $string .= isset( $data['ExpedidoEn']['calle'] ) ? $data['ExpedidoEn']['calle'].'|' : '';
    $string .= isset( $data['ExpedidoEn']['noExterior'] ) ? $data['ExpedidoEn']['noExterior'].'|' : '';
    $string .= isset( $data['ExpedidoEn']['noInterior'] ) ? $data['ExpedidoEn']['noInterior'].'|' : '';
    $string .= isset( $data['ExpedidoEn']['colonia'] ) ? $data['ExpedidoEn']['colonia'].'|' : '';
    $string .= isset( $data['ExpedidoEn']['localidad'] ) ? $data['ExpedidoEn']['localidad'].'|' : '';
    $string .= isset( $data['ExpedidoEn']['referencia'] ) ? $data['ExpedidoEn']['referencia'].'|' : '';
    $string .= isset( $data['ExpedidoEn']['municipio'] ) ? $data['ExpedidoEn']['municipio'].'|' : '';
    $string .= isset( $data['ExpedidoEn']['estado'] ) ? $data['ExpedidoEn']['estado'].'|' : '';
    $string .= isset( $data['ExpedidoEn']['pais'] ) ? $data['ExpedidoEn']['pais'].'|' : '';
    $string .= isset( $data['ExpedidoEn']['codigoPostal'] ) ? $data['ExpedidoEn']['codigoPostal'].'|' : '';

    // Receptor
    if ( !isset( $data['Receptor'] ) ) {
      die( 'You must provide the Receptor in your array'."\n" );
    }
    $string .= isset( $data['Receptor']['rfc'] ) ? $data['Receptor']['rfc'].'|' : '';
    $string .= isset( $data['Receptor']['nombre'] ) ? $data['Receptor']['nombre'].'|' : '';

    // Domicilio
    $string .= isset( $data['Domicilio']['calle'] ) ? $data['Domicilio']['calle'].'|' : '';
    $string .= isset( $data['Domicilio']['noExterior'] ) ? $data['Domicilio']['noExterior'].'|' : '';
    $string .= isset( $data['Domicilio']['noInterior'] ) ? $data['Domicilio']['noInterior'].'|' : '';
    $string .= isset( $data['Domicilio']['colonia'] ) ? $data['Domicilio']['colonia'].'|' : '';
    $string .= isset( $data['Domicilio']['localidad'] ) ? $data['Domicilio']['localidad'].'|' : '';
    $string .= isset( $data['Domicilio']['referencia'] ) ? $data['Domicilio']['referencia'].'|' : '';
    $string .= isset( $data['Domicilio']['municipio'] ) ? $data['Domicilio']['municipio'].'|' : '';
    $string .= isset( $data['Domicilio']['estado'] ) ? $data['Domicilio']['estado'].'|' : '';
    $string .= isset( $data['Domicilio']['pais'] ) ? $data['Domicilio']['pais'].'|' : '';
    $string .= isset( $data['Domicilio']['codigoPostal'] ) ? $data['Domicilio']['codigoPostal'].'|' : '';

    // Conceptos
    if ( !isset( $data['Concepto'] ) ) {
      die( 'You must provide at least one Concepto in your array'."\n" );
    }
    $count = count( $data['Concepto'] );
    if ( $count == 1 ) {
      $string .= isset( $data['Concepto'][0]['cantidad'] ) ? $data['Concepto'][0]['cantidad'].'|' : '';
      $string .= isset( $data['Concepto'][0]['unidad'] ) ? $data['Concepto'][0]['unidad'].'|' : '';
      $string .= isset( $data['Concepto'][0]['noIdentificacion'] ) ? $data['Concepto'][0]['noIdentificacion'].'|' : '';
      $string .= isset( $data['Concepto'][0]['descripcion'] ) ? $data['Concepto'][0]['descripcion'].'|' : '';
      $string .= isset( $data['Concepto'][0]['valorUnitario'] ) ? $data['Concepto'][0]['valorUnitario'].'|' : '';
      $string .= isset( $data['Concepto'][0]['importe'] ) ? $data['Concepto'][0]['importe'].'|' : '';
      $string .= isset( $data['Concepto'][0]['InformacionAduanera']['numero'] ) ? $data['Concepto'][0]['InformacionAduanera']['numero'].'|' : '';
      $string .= isset( $data['Concepto'][0]['InformacionAduanera']['fecha'] ) ? $data['Concepto'][0]['InformacionAduanera']['fecha'].'|' : '';
      $string .= isset( $data['Concepto'][0]['InformacionAduanera']['aduana'] ) ? $data['Concepto'][0]['InformacionAduanera']['aduana'].'|' : '';
      $string .= isset( $data['Concepto'][0]['CuentaPredial']['numero'] ) ? $data['Concepto'][0]['CuentaPredial']['numero'].'|' : '';
    } else {
      for( $i = 0; $i < $count; ++$i ) {
        $string .= isset( $data['Concepto'][$i]['cantidad'] ) ? $data['Concepto'][$i]['cantidad'].'|' : '';
        $string .= isset( $data['Concepto'][$i]['unidad'] ) ? $data['Concepto'][$i]['unidad'].'|' : '';
        $string .= isset( $data['Concepto'][$i]['noIdentificacion'] ) ? $data['Concepto'][$i]['noIdentificacion'].'|' : '';
        $string .= isset( $data['Concepto'][$i]['descripcion'] ) ? $data['Concepto'][$i]['descripcion'].'|' : '';
        $string .= isset( $data['Concepto'][$i]['valorUnitario'] ) ? $data['Concepto'][$i]['valorUnitario'].'|' : '';
        $string .= isset( $data['Concepto'][$i]['importe'] ) ? $data['Concepto'][$i]['importe'].'|' : '';
        $string .= isset( $data['Concepto'][$i]['InformacionAduanera']['numero'] ) ? $data['Concepto'][$i]['InformacionAduanera']['numero'].'|' : '';
        $string .= isset( $data['Concepto'][$i]['InformacionAduanera']['fecha'] ) ? $data['Concepto'][$i]['InformacionAduanera']['fecha'].'|' : '';
        $string .= isset( $data['Concepto'][$i]['InformacionAduanera']['aduana'] ) ? $data['Concepto'][$i]['InformacionAduanera']['aduana'].'|' : '';
        $string .= isset( $data['Concepto'][$i]['CuentaPredial']['numero'] ) ? $data['Concepto'][$i]['CuentaPredial']['numero'].'|' : '';
      }
    }
    unset( $count );

    // Retencion
    if ( !isset( $data['Retencion'] ) ) {
      die( 'You must provide at least one Retencion in your array'."\n" );
    }
    $count = count( $data['Retencion'] );
    if ( $count == 2 ) {
      $string .= isset( $data['Retencion'][0]['impuesto'] ) ? $data['Retencion'][0]['impuesto'].'|' : '';
      $string .= isset( $data['Retencion'][0]['importe'] ) ? $data['Retencion'][0]['importe'].'|' : '';
    } else {
      for( $i = 0; $i < $count; ++$i ) {
        $string .= isset( $data['Retencion'][$i]['impuesto'] ) ? $data['Retencion'][$i]['impuesto'].'|' : '';
        $string .= isset( $data['Retencion'][$i]['importe'] ) ? $data['Retencion'][$i]['importe'].'|' : '';
      }
    }
    unset( $count );
    $string .= isset( $data['Retencion']['totalImpuestosRetenidos'] ) ? $data['Retencion']['totalImpuestosRetenidos'].'|' : '';

    // Traslado
    if ( isset( $data['Traslado'] ) ) {
      $count = count( $data['Traslado'] );
      if ( $count == 2 ) {
        $string .= isset( $data['Traslado'][0]['Impuesto'] ) ? $data['Traslado'][0]['Impuesto'].'|' : '';
        $string .= isset( $data['Traslado'][0]['tasa'] ) ? $data['Traslado'][0]['tasa'].'|' : '';
        $string .= isset( $data['Traslado'][0]['importe'] ) ? $data['Traslado'][0]['importe'].'|' : '';
      } else {
        for( $i = 0; $i < $count; ++$i ) {
          $string .= isset( $data['Traslado'][$i]['Impuesto'] ) ? $data['Traslado'][$i]['Impuesto'].'|' : '';
          $string .= isset( $data['Traslado'][$i]['tasa'] ) ? $data['Traslado'][$i]['tasa'].'|' : '';
          $string .= isset( $data['Traslado'][$i]['importe'] ) ? $data['Traslado'][$i]['importe'].'|' : '';
        }
      }
      unset( $count );
      $string .= isset( $data['Traslado']['totalImpuestosTraslados'] ) ? $data['Traslado']['totalImpuestosTraslados'].'|' : '';
    }

    return utf8_encode( preg_replace( '/(.*)\|$/', '$1', $string ).'||' );
  }

  /**
   * Returns the private key from DER to PEM format, uses openssl from shell
   *
   * @param string $key_path the path of the private key in DER format
   * @param string $password the private key password
   * @return string the private key in a PEM format
   */
  public static function getPrivateKey ( $key_path, $password )
  {
    $cmd = 'openssl pkcs8 -inform DER -in '.$key_path.' -passin pass:'.$password;
    exec( $cmd, $result );
    if ( $result > 1 ) {
      $response = '';
      foreach ( $result as $line ) {
        $response .= $line."\n";
      }
      return $response;
    }
    return $result[0];
  }

  /**
   * Return the certificate from DER to PEM on two formats, uses openssl from shell
   * if to_string is true resutns the certificate in a string as is (multiline)
   * but if set to false returns only the certificate in a one line string.
   *
   * @param string $cer_path the path of the certificate in DER format
   * @param boolean $to_string a flag to set the format required
   * @return string the certificate in PEM format
   */
  public static function getCertificate ( $cer_path, $to_string = true )
  {
    $cmd = 'openssl x509 -inform DER -outform PEM -in '.$cer_path.' -pubkey';
    exec( $cmd, $result );

    $response = '';

    if ( $to_string ) {

      if ( $result > 1 ) {
        $response = '';
        foreach ( $result as $line ) {
          $response .= $line."\n";
        }
      } else {
        $response = $result[0];
      }

    } else {

      $size = sizeof( $result );
      $flag = false;

      for ( $i = 0; $i < $size; ++$i ) {
        if ( strstr( $result[$i], "END CERTIFICATE" ) ) {
          $flag = false;
        }
        if ( $flag ) {
          $response .= trim( $result[$i] );
        }
        if ( strstr( $result[$i],"BEGIN CERTIFICATE" ) ) {
          $flag = true;
        }
      }

      unset( $flag );
      unset( $size );
      unset( $result );
    }

    return $response ? $response : false;
  }

  /**
   * Signs data with the key and returns it in a base64 string
   *
   * @param string $key string containing the key in PEM format
   * @param string $data data to sign
   * @return string the signed data in base64
   */
  public static function signData ( $key, $data )
  {
    $pkeyid = openssl_get_privatekey( $key );

    if ( openssl_sign( $data, $cryptedata, $pkeyid, OPENSSL_ALGO_MD5 ) ) {

      openssl_free_key( $pkeyid );

      return base64_encode( $cryptedata );
    }
  }

  /**
   * Returns the serial number from a DER certificate, uses openssl from shell
   *
   * @param string $cer_path the certificate path in DER format
   * @return string the serial number of the certificate in ASCII
   */
  public static function getSerialFromCertificate ( $cer_path )
  {
    $cmd = 'openssl x509 -inform DER -outform PEM -in '.$cer_path.
           ' -pubkey > '.$cer_path.'.pem';
    exec( $cmd );
    unset( $cmd );

    exec( 'openssl x509 -in '.$cer_path.'.pem -serial -noout', $serial );

    unlink( $cer_path.'.pem' );

    if ( isset( $serial[0] ) && $serial[0] ) {

      if ( preg_match( "/([0-9]{40})/", $serial[0], $match ) ) {

        $array = explode( "-", chunk_split( $match[1], 2, "-" ) );

        $response = '';
        foreach ( $array as $value ) {
          if ( $value ) {
            $response .= chr( hexdec( $value ) );
          }
        }
        unset( $array );
      }
      unset( $serial );
    }

    return isset( $response ) && $response ? $response : false;
  }
}
