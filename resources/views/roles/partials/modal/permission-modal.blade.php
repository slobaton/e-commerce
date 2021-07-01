<form id="rol-permiso-crud-form">
    <x-modal
        id="rol-permiso-crud-modal"
        backdrop="static"
        keyboard="false"
        focus="false"
        title="Asignar Permisos"
        size="xl"
        headerBgColor="white"
        btnCloseColor="secondary"
        configFile="roles.partials.modal.config"
        configVarName="configModal">
        @csrf
        @include('roles.partials.modal.form')
        <x-slot name="submitButton">
            <button
                type="button"
                id="rol-permiso-submit-button"
                class="btn btn-blue-stone">
                <i class="fas fa-share-square"></i> {{ __('Enviar') }}
            </button>
        </x-slot>
    </x-modal>
</form>
