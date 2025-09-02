@props([
    // si preferís no usar .env, podés pasar el prop :chatbase-id="..."
    'chatbaseId' => config('chatbase.id'),
    'title' => config('chatbase.title', 'Asistente Turismo'),
    // nombre lógico para aislar IDs/data-attrs por si en el futuro querés otra instancia
    'name' => 'chatbase',
])

@if ($chatbaseId)
    <div {{ $attributes->merge(['class' => 'chatbase-root']) }} data-chatbase="{{ $name }}">
        <!-- Botón flotante -->
        <button type="button" class="btn btn-primary position-fixed bottom-0 end-0 m-3 shadow chatbase-toggle"
            style="z-index:1100; border-radius:999px; width:56px; height:56px;" aria-label="Abrir chat"
            aria-expanded="false">
            <i class="fa-solid fa-message"></i>
        </button>

        <!-- Panel esquina -->
        <div class="chatbase-corner d-none" role="dialog" aria-modal="true"
            aria-labelledby="chatbaseCornerTitle-{{ $name }}">
            <div class="chatbase-corner-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge text-bg-primary">Chat</span>
                    <h6 id="chatbaseCornerTitle-{{ $name }}" class="mb-0">{{ $title }}</h6>
                </div>
                <div class="d-flex align-items-center gap-1">
                    <button type="button" class="btn btn-sm btn-outline-secondary js-chatbase-min"
                        aria-label="Minimizar">—</button>
                    <button type="button" class="btn-close" aria-label="Cerrar"></button>
                </div>
            </div>

            <div class="chatbase-corner-body">
                <iframe class="chatbase-iframe" src="https://www.chatbase.co/chatbot-iframe/{{ $chatbaseId }}"
                    title="{{ $title }}" referrerpolicy="no-referrer-when-downgrade" allow="clipboard-write"
                    loading="lazy" sandbox="allow-scripts allow-forms allow-same-origin allow-popups"></iframe>
            </div>
        </div>
        <style>
            .chatbase-corner {
                position: fixed;
                right: 1rem;
                bottom: 1rem;
                width: min(420px, calc(100vw - 2rem));
                height: 560px;
                background-color: var(--bs-body-bg);
                color: var(--bs-body-color);
                border: 1px solid var(--bs-border-color);
                border-radius: var(--bs-border-radius-lg);
                box-shadow: var(--bs-box-shadow-lg);
                z-index: 1095;
                overflow: hidden;
                transform: translateY(8px);
                opacity: 0;
                transition: transform .2s ease, opacity .2s ease;
            }

            .chatbase-corner.show {
                transform: translateY(0);
                opacity: 1;
            }

            .chatbase-corner-header {
                padding: .5rem .75rem;
                border-bottom: 1px solid var(--bs-border-color);
                background: var(--bs-tertiary-bg);
            }

            .chatbase-corner-body {
                position: relative;
                width: 100%;
                height: calc(100% - 44px);
                background: var(--bs-body-bg);
            }

            .chatbase-iframe {
                display: block;
                width: 100%;
                height: 100%;
                border: 0;
            }

            .chatbase-corner.minimized {
                height: 60px;
            }

            .chatbase-corner.minimized .chatbase-corner-body {
                display: none;
            }

            @media (max-width: 576px) {
                .chatbase-corner {
                    right: .5rem;
                    bottom: .5rem;
                    width: calc(100vw - 1rem);
                    height: min(80vh, 560px);
                }
            }
        </style>
        
    </div>
@else
    {{-- Si no hay ID configurado, no renderizamos nada para evitar errores --}}
@endif
