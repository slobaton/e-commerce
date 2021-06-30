<script>
    let configCrudModal = {
        events: {
            onShow: () => {
                let customOnShowModal = datatableConfig.crud.customOnShowModal;

                if (_.isFunction(customOnShowModal)) {
                    customOnShowModal();
                }
            },
            onHidden: () => {
                let customResetForm = datatableConfig.crud.customResetForm;

                resetFormValidator(
                    datatableCrudValidator,
                    `${TABLE_ID}-form-crud`,
                    customResetForm
                );
            },
        }
    };
</script>
