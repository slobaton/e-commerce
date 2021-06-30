<script>
    const createFn = ( evt, datatable, node, config ) => {
        let modalTitle = "{{ isset($crud['modal']['create_title']) ? $crud['modal']['create_title'] : '' }}";

        modalMode = MODAL_CREATE;
        $(`#{{ $crud['modal']['id'] }}-modal-title`).html(modalTitle);
        $(`#{{ $crud['modal']['id'] }}`).modal('show');
    }

    const create = ( form, datatable ) => {
        let url = `{{ isset($crud['uri']) ? route("{$crud['uri']}.store") : ''}}`;
        let data = serializeData(form, datatableConfig);

        let customResetForm = datatableConfig.crud.customResetForm;
        makeRequest({
            url,
            data,
            method: 'POST',
            form,
            resetForm: customResetForm
        });
    }
</script>
