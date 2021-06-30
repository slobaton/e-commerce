
@include('components.datatable.js.crud.helpers')
@include('components.datatable.partials.crud-modal')
<script>
    $(document).ready(function () {
        if (datatableConfig.crud && datatableConfig.crud.validation) {

            $.validator.addMethod("selectedValue", function(value, element) {
                return parseInt(value) > 0;
            });

            datatableCrudValidator = $('#{{$id}}-form-crud').validate({
                rules: datatableConfig.crud.validation.rules,
                messages: datatableConfig.crud.validation.messages,
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    let submitButton = $(this.submitButton);

                    submitButton.html(`
                        <span
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true">
                        </span> Enviando...`
                    );
                    submitButton.prop('disabled', true);
                    $('#close-modal-id').prop('disabled', true)

                    if (modalMode === MODAL_CREATE) {
                        create(form);
                    }

                    if (modalMode === MODAL_EDIT) {
                        edit(form);
                    }
                }
            });
        }
    });
</script>
