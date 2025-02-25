<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Recibidos</title>
    <style>
        .celda-distribuida {
            display: flex;
            flex-direction: column;
            /* Apila los elementos verticalmente */
            justify-content: space-between;
            /* Distribuye el espacio entre los elementos */
            height: 100px;
            /* Ajusta la altura según tus necesidades */
        }
    </style>
</head>

<body>
    @php ($count = 1)
    @foreach ($proveedores as $proveedor)
        <br>
        <br>

        <div class="mb-5 mt-5">
            <p class="h4 mb-2">
                Recibí del Servicio Administrativo Contable de la Gobernación Oficina 16- Primer Piso-Casa de Gobierno
                las
                Solicitudes de Cotización con APERTURA en <strong>FECHA: {{ $cotizacion->fecha_llamado }}, HORA :
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

                <tr class="table-bordered" style="height: 200px">
                    <th class="text-center border-botom-0" style="width: 10%;">{{ $count }}</th>
                    <th class="border-botom-0" style="width: 20%;">
                        <div class="">
                            <p class="text-center h5 mt-3">{{ $proveedor->proveedor->nombre }}</p>
                            <br>
                            <br>
                            <br>

                            <p class="fs-4">{{ $proveedor->proveedor->domicilio }}</p>
                        </div>
                    </th>
                    <th class="border-botom-0" style="width: 30%;">
                        <div class="celda-distribuida">
                            <p>Firma:</p>
                            <br>
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
        <br>
        @php ($count++) 
    @endforeach

</body>

</html>
