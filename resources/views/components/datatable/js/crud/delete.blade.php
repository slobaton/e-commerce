<script>
    const deleteFn = (evt, datatable, button, config) => {
        const selectedRowsCount = datatable.rows( { selected: true } ).count();
        let url, params;
        const hasMultipleDelete = `{{ json_encode(Route::has("{$crud['uri']}.destroy-multiple")) }}`;

        params = {
            _token: '{{ csrf_token() }}'
        }

        if (selectedRowsCount > 1 && hasMultipleDelete) {
            const selectedRows = datatable.rows( { selected: true } ).data();
            let ids = [];
            selectedRows.toArray().forEach(currentRow => ids.push(currentRow.id));
            url = `{{
                isset($crud['uri']) && Route::has("{$crud['uri']}.destroy-multiple")
                    ? route("{$crud['uri']}.destroy-multiple")
                    : ''
            }}`;

            params['ids'] = ids;
        }

        if (selectedRowsCount === 1) {
            let uri = `{{ isset($crud['uri']) ? route("{$crud['uri']}.destroy", "##") : ''}}`;
            let firstRow = datatable.rows( { selected: true } ).data()[SELECTED_ROW];
            url = _.replace(uri, '##', firstRow.id);
        }

        if (selectedRowsCount > 0 && url) {
            Swal.fire({
                title: '¿Está seguro de eliminar los elementos seleccionados?',
                text: "El registro no estará disponible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    axios.delete(url, params)
                        .then(function ({ data: { data: message } }) {
                            datatable.ajax.reload();
                            datatable.rows().deselect();
                            Swal.fire({
                                title: '¡Exito!',
                                text: message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        })
                        .catch(function ({ response: { data, status } }) {
                            const { message, code } = data;
                            if (status !== 422) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: message,
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });
                }
            });
        }
    }
</script>
