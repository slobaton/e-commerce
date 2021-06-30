<script>
    const makeRequest = ({ url, data, method, form, resetForm }) => {
        let headers = { accept: 'application/json', 'accept-enconding': 'application/json' }
        axios({ method, url, data, headers })
            .then(function (response) {
                let { data:{ data: message } } = response;
                successMessage(message);
                resetFormValidator(
                    datatableCrudValidator,
                    '{{$id}}-form-crud',
                    resetForm
                );
                datatableComponent.ajax.reload();
                $(`#{{ $crud['modal']['id'] }}`).modal('hide');
            })
            .catch(function (error) {
                const { response: { data, status } } = error;

                if (status !== 422) {
                    errorMessage(data.message);
                } else {
                    // $(form).validate().showErrors(data);
                    errorMessage(data.message);
                }
            }).then(function () {
                changeButton();
            });
    }

    const serializeData = (form, configFile) => {
        try {
            let hasCustomSerialize =
                configFile &&
                configFile.crud &&
                configFile.crud.customSerializeData;

            if (hasCustomSerialize) {
                let serialize = configFile.crud.customSerializeData;
                return serialize(form);
            }

            let data = $(form).serialize();

            return data;
        } catch (error) {
            console.error(error);
        }
    }

    const changeButton = () => {
        $(`#{{$id}}-submit-button`).prop("disabled", false);
        $('#close-modal-id').prop('disabled', false)
        $(`#{{$id}}-submit-button`).html(`
            <i class="fas fa-share-square"></i> {{ __('Enviar') }}
        `);
    };
</script>
