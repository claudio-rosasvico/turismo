<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta name="author" content="Claudio Rosas Vico" />
    <style type="text/css">
        .s1 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 14pt;
        }

        h1 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 20pt;
        }

        h3 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 16pt;
            line-height: 12px;
        }

        .h2 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 18pt;
        }

        .s2 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: underline;
            font-size: 22pt;
        }

        .s3 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 22pt;
        }

        p {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 14pt;
            margin: 0pt;
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
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            
            <div style="text-align: center"> <img width="330" height="83"
                    src="/public/assets/img/Logo-gobernacion.png" style="margin: auto;" />
            </div>

            <p class="s1" style="padding-top: 9pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">DIRECCIÓN
                SERVICIO
                ADMINISTRATIVO CONTABLE GOBERNACIÓN</p>
            <p class="s1" style="padding-left: 1pt;text-indent: 0pt;text-align: center;">Provincia de Entre Ríos</p>
            <h1 style="padding-top: 16pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">DEVOLVER EL SOBRE
                CERRADO</h1>
            <h3 style="text-indent: 0pt;line-height: 27pt;text-align: center;">PROVEEDOR<span
                    class="h2">:</span><span class="s2"> {{ $proveedor->nombre }}</span></h3>
            <h3 style="padding-left: 16pt;text-indent: 0pt;text-align: center;">COTEJO DE PRECIO Nº<span
                    class="h2">:</span><span class="s2"> {{ $count }} </span><span class="s3">
                </span>PLIEGO DE
                CONDICIONES Nº<span class="h2">: </span><span class="s2">{{ $cotizacion->numero }}/2025 &nbsp;
                </span><span class="s3"> </span></h3>
            <h3 style="padding-left: 16pt;text-indent: 0pt;text-align: center;">FECHA APERTURA:<span class="s2">
                    {{ date('d/m/Y', strtotime($cotizacion->fecha_llamado)) }}
                </span><span class="s3"> </span>HORA DE APERTURA: <span
                    class="s2">{{ $cotizacion->hora_llamado }} </span></h3>
            <h3 style="padding-left: 16pt;text-indent: 0pt;text-align: center;"><span class="s3"> </span>PEDIDO
                Nº<span class="h2">:</span><span class="s2">
                    {{ $cotizacion->expediente }} </span><span class="s3"> </span>REPARTICIÓN<span class="h2">:
                </span><span class="s2">&nbsp;SECRETARÍA DE TURISMO&nbsp;&nbsp;</span></h3>
            <p style="padding-top: 4pt;text-indent: 0pt;text-align: center;"><br /></p>
            <p style="padding-left: 141pt;text-indent: -121pt;text-align: center;">LUGAR DE APERTURA: DIRECCIÓN
                ADMINISTRATIVA
                CONTABLE, SEC. DE TURISMO - (LAPRIDA 5)</p>
            <p style="padding-top: 4pt;text-indent: 0pt;text-align: center;"> SE RUEGA PUNTUALIDAD A LA HORA DE LA
                APERTURA</p>
        </div>
        @php($count++)
    @endforeach
</body>

</html>
