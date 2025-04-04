<x-layouts.app>
    <x-slot name="title">
        Contrato
    </x-slot>

    <div class="card mb-2">
        <div class="card-header">
            <h4 class="card-title">Contrato de {{ $contrato->nombre }}</h4>


            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h6><strong>Expediente:</strong> {{ $contrato->expediente }}</h6>
                        <h6><i class="fa-regular fa-calendar"></i> <strong> Fecha de Inicio:</strong>
                            {{ date('d-m-Y', strtotime($contrato['fecha_inicio'])) }}</h6>
                        <h6><i class="fa-regular fa-calendar"></i> <strong> Fecha de Fin:</strong>
                            {{ date('d-m-Y', strtotime($contrato['fecha_fin'])) }}</h6>
                    </div>
                    <div class="col-6">
                        <h6><strong>Proveedor:</strong> {{ $contrato->proveedor->nombre }}</h6>
                        <h6><i class="fa-solid fa-dollar-sign"></i><strong> Monto Total:</strong>
                            {{ ' $' . number_format($contrato['monto_total'], 2, ',', '.') }}</h6>
                        <h6><i class="fa-solid fa-dollar-sign"></i><strong> Monto Mensual:</strong>
                            {{ ' $' . number_format($contrato['monto_mensual'], 2, ',', '.') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-2">
        @livewire('contratos.pagos', ['contrato' => $contrato])
    </div>
</x-layouts.app>
