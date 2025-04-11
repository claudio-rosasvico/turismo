<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .mb-5 {
            margin-bottom: 3rem !important;
        }

        .mt-5 {
            margin-top: 2rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .mt-2 {
            margin-top: 0.5rem !important;
        }

        .h4 {
            font-size: 1.3rem;
            font-weight: bold;
        }

        .h5 {
            font-size: 1.0rem;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .border-0 {
            border: none !important;
        }

        .pb-0 {
            padding-bottom: 0 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #000;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
            padding: 8px;
        }

        .celda-distribuida {
            display: block;
            height: 200px;
            position: relative;
        }

        .celda-distribuida p {
            margin: 0;
            position: absolute;
        }

        .celda-distribuida p:nth-child(1) {
            top: 0;
        }

        .celda-distribuida p:nth-child(3) {
            top: 40px;
        }

        .celda-distribuida p:nth-child(5) {
            top: 80px;
        }

        .celda-distribuida p:nth-child(6) {
            top: 120px;
        }

        .fs-4 {
            font-size: 0.8rem;
        }

        .nuevo-hoja {
            page-break-before: always;
        }
    </style>
</head>

<body>
    @php ($count = 1)
    @foreach ($proveedores as $proveedor)


        <div class="mb-5 mt-5 {{ $count > 1 && !is_int($count/2) ? 'nuevo-hoja' : '' }}">
            <p class="h4 mb-2">
                Recibí del Servicio Administrativo Contable de la Gobernación Oficina 16- Primer Piso-Casa de Gobierno
                las
                Solicitudes de Cotización con APERTURA en <strong>FECHA: {{ date('d/m/Y', strtotime($cotizacion->fecha_llamado)) }}, HORA :
                    {{ $cotizacion->hora_llamado }}</strong>.
            </p>

            <p class="mt-2">
                PLIEGO DE CONDICIONES Nº {{ $cotizacion->numero }}/2025 - Expte.: {{ $cotizacion->expediente }}
            </p>

            <table class="table">
                <tr class="border-0">
                    <th class="text-center pb-0 border-0 align-bottom" style="width: 10%;">NÚMERO</th>
                    <th class="text-center pb-0 border-0 align-bottom" style="width: 20%;">CASA DE COMERCIO</th>
                    <th class="text-center pb-0 border-0 align-bottom" style="width: 30%;">FIRMA ACLARACIÓN Y DNI</th>
                    <th class="text-center pb-0 border-0 align-bottom" style="width: 25%;">SELLO DE LA CASA</th>
                    <th class="text-center pb-0 border-0 align-bottom" style="width: 15%;">FECHA/HORA</th>
                </tr>

                <tr class="table-bordered" style="height-max: 20px">
                    <th class="text-center border-botom-0" style="width: 10%;">{{ $count }}</th>
                    <th class="border-botom-0" style="width: 20%;">
                        <div>
                            <p class="text-center h5 mt-3">{{ $proveedor->nombre }}</p>
                            <br>
                            <br>
                            <br>

                            <p class="fs-4">{{ $proveedor->domicilio }}</p>
                        </div>
                    </th>
                    <th class="border-botom-0" style="width: 30%;">
                        <div class="celda-distribuida">
                            <p>Firma:</p>
                            <br>
                            <p>Aclaración</p>
                            <br>
                            <p>DNI:</p>
                        </div>
                    </th>

                    <th class="border-botom-0" style="width: 25%;">
                        
                    </th>
                    <th class="border-botom-0" style="width: 15%;">
                        
                    </th>
                </tr>
            </table>
        </div>
        <br>

        @php ($count++)
    @endforeach
</body>

</html>