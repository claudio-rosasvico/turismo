<x-layouts.app>
    <x-slot name="title">
        Cotizaciones
    </x-slot>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4 class="card-title"><a href="{{ route('cotizaciones.index') }}"><i class="fa-solid fa-arrow-left" style="font-size: 1rem"></i></a>  Ver Cotización de {{ $cotizacion->nombre }}</h4>
                            </div>

                            
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <p><i class="fa-regular fa-folder-open"></i><strong>Expediente:</strong>
                                        {{ $cotizacion['expediente'] }}
                                        <br><i class="fa-regular fa-dollar"></i> <strong> Precio Estimado:</strong>
                                        {{ ' $' . number_format($cotizacion['precio_estimado'], 2, ',', '.') }}
                                        <br><i class="fa-regular fa-calendar"></i> <strong> Fecha de
                                            Autorización:</strong>
                                        {{ $cotizacion['fecha_autorizacion'] ? date('d-m-Y', strtotime($cotizacion['fecha_autorizacion'])) : '' }}

                                </div>
                                <div class="col-4">
                                    <p><i class="fa-regular fa-calendar"></i> <strong> Fecha de Reso de
                                            Llamado:</strong>
                                        {{ $cotizacion['fecha_reso_llamado'] ? date('d-m-Y', strtotime($cotizacion['fecha_reso_llamado'])) : '' }}
                                        <br><i class="fa-regular fa-hashtag"></i><strong>Nº de Cotización:</strong>
                                        {{ $cotizacion['numero'] }}
                                        <br><i class="fa-regular fa-calendar"></i> <strong> Fecha de Llamado:</strong>
                                        {{ $cotizacion['fecha_llamado'] ? date('d-m-Y', strtotime($cotizacion['fecha_llamado'])) : '' }}
                                        <br><i class="fa-regular fa-clock"></i> <strong> Hora de Llamado:</strong>
                                        {{ $cotizacion['hora_llamado'] ? date('H:i', strtotime($cotizacion['hora_llamado'])) : '' }}
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p><i class="fa-regular fa-calendar"></i> <strong> Fecha de Reso.
                                            Adjudicación:</strong>
                                        {{ $cotizacion['fecha_reso_adjudicacion'] ? date('d-m-Y', strtotime($cotizacion['fecha_reso_adjudicacion'])) : '' }}
                                        <br><i class="fa-regular fa-hashtag"></i><strong>Nº de Resolución:</strong>
                                        {{ $cotizacion['nro_reso_adjudicacion'] }}
                                        <br><i class="fa-regular fa-folder-open"></i><strong>Descripción:</strong>
                                        {{ $cotizacion['descripcion'] }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Agregar oferta
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col col-lg-6 mt-2">
                    @livewire('cotizacion.item', ['cotizacion_id' => $cotizacion->id])
                </div>
                <div class="col col-lg-6 mt-2">
                    @livewire('cotizacion.orden-compra-cotizacion', ['cotizacion_id' => $cotizacion->id])
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
