<script>
    let firstRow;
    const asignPermissionFn = (e, dt, node, config)=> {
        // let data  = (dt.rows( { selected: true }).data());
        // let uri = `{{route("role-permission.show", "##")}}`;
        // firstRow = data[0];
        // let url = _.replace(uri, '##', firstRow.id);
        // $('#rol-permiso-crud-form').trigger('reset');
        // axios.get(url)
        //     .then(function ({ data: { data, code }, status }) {
        //         _.forEach(data, function (value) {
        //             var nombre = "#" + value.name;
        //             $(nombre).prop('checked', true);
        //         });
        //         $('#rol-permiso-crud-modal').modal('show');
        //     })
        //     .catch(function (error) {
        //         const { response: { data, status } } = error;
        //         errorMessage(data.message);
        //         console.error(data.message);
        //     })
    }
    const datatableConfig = {
        crud: {
            buttons: [{
                type: 'create',
                hasPermission: true
            }, {
                type: 'edit',
                hasPermission: true,//@json(auth()->user()->can('edit-role')),
                selection: 'selectedSingle',
            }, {
                type: 'delete',
                hasPermission: true,//@json(auth()->user()->can('delete-role')),
                selection: 'selected'
            }],
            fields: {
                name: {
                    type: 'input'
                }
            },
            validation: {
                rules: {
                    name: {
                        required: true
                    }
                },
                messages:{
                    name: {
                        required: "Ingrese el nombre del Rol",
                    },
                },
            },
        },
        custom: {
            buttons: [{
                type : "asignPermission",
                text: 'Asignar Permisos',
                icon: 'fas fa-plus-square',
                className: 'btn btn-info btn-sm',
                action: asignPermissionFn,
                tooltip: {
                    placement: 'top',
                    text: 'Asignar Permisos Al Rol Seleccionado'
                },
                attr:  {
                    id: 'asignPermissionBtn',
                    disabled: true
                },
                selection: 'selectedSingle',
                hasPermission: @json(auth()->user()->can('show-role-permission'))
            }],
        },
        selection: {
            style: 'single', //multi, single
        },
    }
    $(document).ready(function () {
        $('#rol-permiso-submit-button').click(function (e) {
            let uri = `{{route("role-permission.update", "##")}}`;
            let url = _.replace(uri, '##', firstRow.id);
            let data =  $('#rol-permiso-crud-form').serialize();
            let method = 'PATCH'
            $(this).html('Enviando...');
            axios({ method, url, data })
                .then(function (response) {
                    let { data:{ data: message } } = response;
                    successMessage(message);
                     $('#rol-permiso-submit-button').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                     $('#rol-permiso-crud-form').trigger('reset');
                     $('#rol-permiso-crud-modal').modal('hide');
                })
                .catch(function (error) {
                    const { response: { data, status } } = error;
                    errorMessage(data.message);
                    console.error(data.message);
                    $('#rol-permiso-submit-button').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                    $("#rol-permiso-crud-form").validate().showErrors(data.responseJSON);
                })
        });
    });
</script>
@include('roles.partials.modal.permission-modal')
