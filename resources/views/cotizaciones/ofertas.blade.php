<x-layouts.app>
    <x-slot name="title">
        Cotizaciones / Ofertas
    </x-slot>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">Carga de Ofertas</h4>
                            </div>

                            <div>
                                <a name="" id="" class="btn btn-primary"
                                    href="{{ route('cotizaciones.index') }}" role="button">Volver a Cotizaciones</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @livewire('cotizacion.ofertas', ['cotizacion' => $cotizacion])
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
