<div>
    @include('layouts.navbars.guest.login')
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-left bg-transparent">
                            @if ($showDemoNotification)
                                <div wire:model.live="showDemoNotification"
                                    class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                    <span
                                        class="alert-text text-white">{{ __(' You are in a demo version, you can\'t update the
                                        profile.') }}</span>
                                    <button wire:click="$set('showDemoNotification', false)" type="button"
                                        class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @endif
                            <h4 class="mb-0">{{ __('¿Olvido su contraseña? Ingrese su email aquí') }}</h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit="recoverPassword" action="#" method="POST" role="form text-left">
                                <div>
                                    <label for="email">{{ __('Email') }}</label>
                                    <div class="@error('email')border border-danger rounded-3 @enderror">
                                        <input wire:model.live="email" id="email" type="email" class="form-control"
                                            placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                    </div>
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn bg-gradient-success w-100 mt-4 mb-0">{{ __('Recuperar Contraseña') }}</button>
                                </div>
                            </form>
                            @if ($showSuccesNotification)
                                <div wire:model.live="showSuccesNotification"
                                    class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                    <span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>
                                    <span
                                        class="alert-text text-white">{{ __(' Se ha enviado un correo electrónico para restablecer su contraseña') }}</span>
                                    <button wire:click="$set('showSuccesNotification', false)" type="button"
                                        class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @endif

                            @if ($showFailureNotification)
                                <div wire:model.live="showFailureNotification"
                                    class="mt-3 alert alert-warning alert-dismissible fade show" role="alert">
                                    <span class="alert-text text-white">
                                        {{ __('Usted no está registrado, por favor registrese') }}
                                        <a class="text-success" href="{{ route('sign-up') }}">aquí</a></span>
                                    <button wire:click="$set('showFailureNotification', false)" type="button"
                                        class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                            style="background-image:url('../assets/img/carnaval.png')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
