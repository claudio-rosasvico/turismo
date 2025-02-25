<x-layouts.app>
    <x-slot name="title">
        Partidas
    </x-slot>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">Ver Cotizaciones</h4>
                            </div>

                            <div>
                                <a name="" id="" class="btn btn-primary"
                                    href="{{ route('cotizaciones.create') }}" role="button">Cargar Cotización</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @livewire('cotizacion.index')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
