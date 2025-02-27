<x-layouts.app>
    <x-slot name="title">
        Contratos
    </x-slot>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">Contratos</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @livewire('contratos.index')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-layouts.app>