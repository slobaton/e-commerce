<form id="{{$id}}-form-crud">
    <x-modal
        :id="$crud['modal']['id']"
        backdrop="static"
        keyboard="false"
        focus="false"
        :title="$crud['modal']['create_title']"
        :size="$crud['modal']['size']"
        headerBgColor="$crud['modal']['header_color']"
        btnCloseColor="secondary"
        configFile="components.datatable.partials.config"
        configVarName="configCrudModal">
        @csrf
        @isset($crud['crud_template'])
            @include($crud['crud_template'])
        @endisset
        <x-slot name="submitButton">
            <button
                type="submit"
                id="{{$id}}-submit-button"
                class="btn btn-dark">
                <i class="fas fa-share-square"></i> {{ __('Enviar') }}
            </button>
        </x-slot>
    </x-modal>
</form>
