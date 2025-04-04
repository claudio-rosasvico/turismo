<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>3022436- COTEJO - ACOMPRA DE ARTICULOS DE PROMOCION Y FACHADA DE LA SECRETARIA .xls</title>
    <meta name="author" content="Claudio Rosas Vico" />
    <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
    <style type="text/css">

        h4 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8.5pt;
        }

        .s1 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
        }

        .s2 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
        }

        h3 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 11pt;
        }

        .h2 {

            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        .s3 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        p {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
            margin: 0pt;
        }

        .h1 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: italic;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
        }

        .s4 {

            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 7.5pt;
        }

        .s5 {

            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
        }

        .s6 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: italic;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
        }

        .s7 {

            font-family: century-gothic, sans-serif;
            font-style: italic;
            font-weight: bold;
            text-decoration: none;
            font-size: 7pt;
        }

        .s8 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 10.5pt;
        }

        .s9 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 9.5pt;
        }

        .s10 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8.5pt;
        }

        .s11 {
            color: black;
            font-family: century-gothic, sans-serif;
            font-style: italic;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }

        .nuevo-proveedor {
            page-break-before: always;
        }
    </style>
</head>

<body>
    @php($count = 1)
    @foreach ($proveedores as $proveedor)
        <div class="{{ $count > 1 ? 'nuevo-proveedor' : '' }}">
            <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;"><span>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img width="268" height="46"
                                    src="/public/assets/img/Logo-gobernacion.png" />
                            </td>
                        </tr>
                    </table>
                </span></p>
            <h4 style="padding-top: 8pt;padding-left: 235pt;text-indent: 0pt;text-align: left;">PLIEGO DE CONDICIONES Nº
                {{ $cotizacion->numero }}/2025 <span style="color: white">_____________</span> <span class="s1">Nº </span><span
                    class="s2">{{ $count }}</span></h4>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <h3 style="padding-left: 116pt;text-indent: 0pt;text-align: left;">APERTURA: FECHA:
                {{ date('d/m/Y', strtotime($cotizacion->fecha_llamado)) }} <span class="h2">HORA : {{ $cotizacion->hora_llamado }}</h3>
            <p style="padding-top: 1pt;padding-left: 7pt;line-height: 111%;text-align: left;">APERTURA
                DIR. DE ADMINISTRACION CONTABLE - SECRETARIA DE TURISMO DIRECCION LAPRIDA Nº5</p>
            <p style="padding-top: 5pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">SEÑORES: <span
                    class="h1">{{ $proveedor->proveedor->nombre }}</span></p>
            <p style="padding-top: 4pt;text-indent: 0pt;text-align: left;"><br /></p>
            <p class="s4" style="padding-left: 7pt;text-indent: 0pt;text-align: left;">{{ $cotizacion->expediente }}
                <span class="s5">SECRETARIA DE TURISMO</span>
            </p>
            <p class="s6"
                style="padding-top: 6pt;padding-bottom: 1pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">
                Sírvase cotizarnos los artículos que detallamos a continuación:</p>
            <table style="border-collapse:collapse;margin-left:6.06999pt" cellspacing="0">
                <tr style="height:12pt">
                    <td
                        style="width:46pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s7"
                            style="padding-top: 3pt;text-indent: 0pt;line-height: 7pt;text-align: center;">
                            Renglón
                        </p>
                    </td>
                    <td
                        style="width:250pt;border-top-style:solid;border-top-width:1pt;;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;">
                        <p class="s7"
                            style="padding-top: 3pt;text-indent: 0pt;line-height: 7pt;text-align: center;">
                            Artículos y Especificaciones</p>
                    </td>
                    <td
                        style="width:35pt;border-top-style:solid;border-top-width:1pt;;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;">
                        <p class="s7"
                            style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                            Unidad</p>
                    </td>
                    <td
                        style="width:27pt;border-top-style:solid;border-top-width:1pt;;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;">
                        <p class="s7"
                            style="padding-top: 3pt;padding-left: 1pt;text-indent: 0pt;line-height: 7pt;text-align: center;">
                            Cantidad</p>
                    </td>
                    <td
                        style="width:51pt;border-top-style:solid;border-top-width:1pt;;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;">
                        <p class="s7"
                            style="padding-top: 3pt;padding-left: 8pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                            P.Unitario</p>
                    </td>
                    <td
                        style="width:54pt;border-top-style:solid;border-top-width:1pt;;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;">
                        <p class="s7"
                            style="padding-top: 3pt;padding-left: 9pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                            Imp.
                            Total</p>
                    </td>
                </tr>
                @php($countItem = 1)
                @foreach ($cotizacion->items as $item)
                    <tr style="height:24pt">
                        <td
                            style="width:46pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                            <p class="s8"
                                style="padding-top: 6pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                                {{ $countItem }}
                            </p>
                        </td>
                        <td
                            style="width:250pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                            <p class="s9"
                                style="padding-top: 6pt; padding-left: 3pt;text-indent: 0pt;line-height: 11pt;text-align: left;">
                                {{ $item->descripcion }}</p>
                        </td>

                        <td
                            style="width:27pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                            <p class="8"
                                style="padding-top: 6pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                                {{ $item->unidad }}
                            </p>
                        </td>
                        <td
                            style="width:27pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                            <p class="s8"
                                style="padding-top: 6pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                                {{ $item->cantidad }}
                            </p>
                        </td>
                        <td
                            style="width:27pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                        </td>
                        <td
                            style="width:27pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                        </td>
                    </tr>
                    @php($countItem++)
                @endforeach
                @while ($countItem < 55)
                    <tr style="height:24pt">
                        <td
                            style="width:46pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                            <p class="s8"
                                style="padding-top: 6pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                            </p>
                        </td>
                        <td
                            style="width:250pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                            <p class="s9"
                                style="padding-top: 6pt; padding-left: 1pt;text-indent: 0pt;line-height: 11pt;text-align: left;">
                            </p>
                        </td>

                        <td
                            style="width:27pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                            <p class="8"
                                style="padding-top: 6pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                            </p>
                        </td>
                        <td
                            style="width:27pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                            <p class="s8"
                                style="padding-top: 6pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                            </p>
                        </td>
                        <td
                            style="width:27pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                        </td>
                        <td
                            style="width:27pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                        </td>
                    </tr>
                    @php($countItem++)
                @endwhile
                <tr style="height:30pt">
                    <td
                        style="width:46pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    </td>
                    <td
                        style="width:250pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s10" style="padding-left: 7pt;text-indent: 0pt;line-height: 9pt;text-align: left;">
                            {{ $cotizacion->descripcion_anexo }}</p>

                    </td>
                    <td
                        style="width:35pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    </td>
                    <td
                        style="width:27pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    </td>
                    <td
                        style="width:51pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    </td>
                    <td
                        style="width:54pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    </td>
                </tr>
                <tr style="height:10pt">
                    <td
                        style="width:46pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    </td>
                    <td
                        style="width:250pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    </td>
                    <td
                        style="width:35pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    </td>
                    <td style="width:78pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                        colspan="2">
                        <p class="s11"
                            style="padding-left: 26pt;text-indent: 0pt;line-height: 8pt;text-align: left;">
                            Total
                            $</p>
                    </td>
                    <td
                        style="width:54pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    </td>
                </tr>
            </table>

            <p style="padding-top: 5pt;text-indent: 0pt;text-align: left;"><br /></p>
            <p class="s6" style="padding-left: 7pt;text-indent: 0pt;text-align: left;">IMPORTE TOTAL EN LETRAS :
            </p>
            @php($count++)
            <br>
            <br>
        </div>
    @endforeach

</body>

</html>
