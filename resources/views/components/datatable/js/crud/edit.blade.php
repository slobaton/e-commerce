<script>
    const editFn = ( evt, dt, node, config ) => {
        const arraykey = datatableConfig.crud.fields;
        let uri = `{{ isset($crud['uri']) ? route("{$crud['uri']}.show", "##") : ''}}`;
        let firstRow = dt.rows( { selected: true } ).data()[SELECTED_ROW];
        let url = _.replace(uri, '##', firstRow.id);

        let modalTitle = "{{ isset($crud['modal']['update_title']) ? $crud['modal']['update_title'] : '' }}";

        modalMode = MODAL_EDIT;
        selectedRow = firstRow;

        axios.get(url)
            .then(function ({ data: { data, code }, status }) {
                $(`#{{ $crud['modal']['id'] }}-modal-title`).html(modalTitle);
                _.forEach(arraykey, function (value, key) {
                    if (value.type === 'checkbox') {
                        $('#{{$id}}-form-crud').find(`input[name = ${key}]`).prop("checked", data[key]);
                    }

                    if (value.type === 'textarea') {
                        $('#{{$id}}-form-crud').find(`textarea[name = ${key}]`).val(data[key]);
                    }

                    if (value.type === 'select') {
                        $('#{{$id}}-form-crud').find(`select[name = ${key}]`).val(data[key]);
                    }

                    if (!value.type || value.type === 'input') {
                        $('#{{$id}}-form-crud').find(`input[name = ${key}]`).val(data[key]);
                    }

                    if (value.customRetrieve) {
                        value.customRetrieve(data, key);
                    }
                });
                $(`#{{ $crud['modal']['id'] }}`).modal('show');
            })
            .catch(function (error) {
                const { response: { data, status } } = error;
                errorMessage(data.message);
                console.error(data.message);
            })
    };

    const edit = (form) => {
        try {
            let uri = `{{ isset($crud['uri']) ? route("{$crud['uri']}.update", "##") : ''}}`;
            let url = _.replace(uri, '##', selectedRow.id);
            let data = serializeData(form, datatableConfig);
            let customResetForm = datatableConfig.crud.customResetForm;

            makeRequest({
                url,
                data,
                method: 'PATCH',
                form,
                resetForm: customResetForm
            });
        } catch (error) {
            console.error(error);
        }

    }
</script>
