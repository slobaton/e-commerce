<script>
    const successMessage = message => {
        Swal.fire({
            title: '¡Exito!',
            text: message,
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        });
    };

    const resetFormValidator = (validator, formId, customResetForm) => {
        validator.reset();
        validator.resetForm();
        $(`#${formId}`).trigger('reset');

        if (_.isFunction(customResetForm)) {
            customResetForm(formId);
        }
    }

    const errorMessage = message => {
        let textMessage = message || 'Ha ocurrido un error inesperado';
        Swal.fire({
            title: '¡Error!',
            text: textMessage,
            icon: 'error',
            showConfirmButton: true
        });
    }
</script>
