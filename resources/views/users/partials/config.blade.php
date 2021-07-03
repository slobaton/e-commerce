<script>
    let firstRow;
    const asignPermissionFn = (e, dt, node, config) => {
        let data  = (dt.rows( { selected: true }).data());
        firstRow = data[0];
        let uri = `{{route("user-permission.show", "##")}}`;
        let url = _.replace(uri, '##', firstRow.id);
        $('#user-permiso-crud-form').trigger('reset');
        axios.get(url)
            .then(function ({ data: { data, code }, status }) {
                _.forEach(data, function (value) {
                    var nombre = "#" + value.name;
                    $(nombre).prop('checked', true);
                });
                $('#user-permiso-crud-modal').modal('show');
            })
            .catch(function (error) {
                const { response: { data, status } } = error;
                errorMessage(data.message);
                console.error(data.message);
            })
    }
    const asignRoleFn  = (e, dt, node, config) => {
        let data  = (dt.rows( { selected: true }).data());
        firstRow = data[0];
        let uri = `{{route("user-role.show", "##")}}`;
        let url = _.replace(uri, '##', firstRow.id);
        $('#user-rol-crud-form').trigger('reset');
        axios.get(url)
            .then(function ({ data: { data, code }, status }) {
                _.forEach(data, function (value) {
                    var nombre = "#" + value.name;
                    $(nombre).prop('checked', true);
                });
                $('#user-rol-crud-modal').modal('show');
            })
            .catch(function (error) {
                const { response: { data, status } } = error;
                errorMessage(data.message);
                console.error(data.message);
            })
    }
    const datatableConfig = {
        crud: {
            buttons: [{
                type: 'create',
                hasPermission: true,
            }, {
                type: 'edit',
                hasPermission: true,
                selection: 'selectedSingle', // selected, selectedSingle
            }, {
                type: 'delete',
                hasPermission: true,
                selection: 'selected'
            }],
            fields: {
                name: {
                    type: 'input'
                },
                email: {
                    type: 'input',
                },
                password: {
                    type: 'input'
                },
                password_confirmation: {
                    type: 'input'
                }
            },
            validation: {
                rules: {
                    name: {
                        required: true,
                        // lettersonly: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: {
                            depends: function () {
                                return modalMode === MODAL_CREATE;
                            }
                        },
                        minlength: 6,
                    },
                    password_confirmation:{
                        required:{
                            depends: function () {
                                return modalMode === MODAL_CREATE;
                            }
                        },
                        equalTo: "#password",
                        minlength: 6,
                    },
                },
                messages:{
                    name: {
                        required:"Ingrese el nombre completo",
                        lettersonly: jQuery.validator.addMethod("lettersonly", function(value, element) {
                            return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ, ]+$/i.test(value);
                        }, "Solo se permiten letras"),
                    },
                    email: {
                        required: "El correo electronico es requerido",
                        email: "El correo electrónico no es válido",
                    },
                    password: {
                        required: "La contraseña es requerida",
                        minlength: jQuery.validator.format("Requiere mas de {0} caracateres!"),
                    },
                    password_confirmation: {
                        required: "Ingrese la confirmación de la contraseña",
                        equalTo: "Las contraseñas no coinciden",
                        minlength: jQuery.validator.format("Requiere mas de {0} caracateres!"),
                    },
                },
            },
            customSerializeData: (form) => { //no  requerido
                return $(form).find(":input").filter(function () {
                    return $.trim(this.value).length > 0
                }).serialize();
            },
            customResetForm: (formId, form) => { // no requerido
                console.log('reset form');
            }
        },
        custom: {
            buttons: [{
                text: 'Asignar Rol',
                icon: 'fas fa-plus-square',
                className: 'btn btn-sm ml-2',
                action: asignRoleFn,
                attr:  {
                    id: 'asignRolBtn',
                    disabled: true
                },
                tooltip: {
                    placement: 'top',
                    text: 'Asignar Roles Al Usuario Seleccionado'
                },
                selection: 'selectedSingle',
                hasPermission: true
            }],
        },
        selection: {
            style: 'single', //multi, single
        },
    }
    $(document).ready(function () {
        $('#user-permiso-submit-button').click(function (e) {
            let uri = `{{route("user-permission.update", "##")}}`;
            let url = _.replace(uri, '##', firstRow.id);
            let data =  $('#user-permiso-crud-form').serialize();
            let method = 'PATCH';
            $(this).html('Enviando...');
            axios({ method, url, data })
                .then(function (response) {
                    let { data:{ data: message } } = response;
                    successMessage(message);
                    $('#user-permiso-submit-button').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                    $('#user-permiso-crud-form').trigger('reset');
                    $('#user-permiso-crud-modal').modal('hide');
                })
                .catch(function (error) {
                    const { response: { data, status } } = error;
                    errorMessage(data.message);
                    console.error(data.message);
                    $('#user-permiso-submit-button').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                    $("#user-permiso-crud-form").validate().showErrors(data.responseJSON);
                })
        });
        $('#user-rol-submit-button').click(function (e) {
            let uri = `{{route("user-role.update", "##")}}`;
            let url = _.replace(uri, '##', firstRow.id);
            let data =  $('#user-rol-crud-form').serialize();
            let method = 'PATCH';
            $(this).html('Enviando...');
            axios({ method, url, data })
                .then(function (response) {
                    let { data:{ data: message } } = response;
                    successMessage(message);
                    $('#user-rol-submit-button').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                    $('#user-rol-crud-form').trigger('reset');
                    $('#user-rol-crud-modal').modal('hide');
                })
                .catch(function (error) {
                    const { response: { data, status } } = error;
                    errorMessage(data.message);
                    console.error(data.message);
                    $('#user-rol-submit-button').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                    $('#user-rol-crud-form').validate().showErrors(data.responseJSON);
                })
        });
    });
</script>
@include('users.partials.modal.permission-modal')
@include('users.partials.modal.role-modal')
