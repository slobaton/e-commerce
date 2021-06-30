@push('css')
    @once
        @include('components.datatable.css.index')
    @endonce
@endpush
<div class="card">
    <div class="d-flex flex-column card-body">
        <table id="{{$id}}" class="table table-sm table-bordered table-hover table-layout table-head-fixed">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@push('js')
    @includeWhen(!is_null($crud) && array_key_exists('config_file', $crud), $crud['config_file'])

    @include('components.datatable.js.crud.index')
    @include('components.datatable.js.custom-actions.index')
    @once
        {{-- <script src="{{ asset('slimScroll/jquery.slimscroll.min.js')}}"></script> --}}
    @endonce
    <script>
        let datatableComponent;
        const crudButtons = buildCrudButtons();
        const datatableSelection = datatableConfig.selection && datatableConfig.selection.style
            ? datatableConfig.selection.style
            : 'single';

        let createColResizable = () => {
            $("#{{$id}} thead tr th").resizable({
                handles: 'e',
                minWidth: 50
            });
        };

        $(document).ready(function () {
            datatableComponent = $('#{{$id}}').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                lengthMenu: [[10, 15, 20, 25, 50, -1], [10, 15, 20, 25, 50, 'Todo']],
                select: datatableSelection,
                buttons: crudButtons,
                dom:
                    "<'row'<'col-md-8 crud-buttons'B><'col-md-4'f>>" +
                    "<'row'<'col-sm-12 col-12'<'.scrollable-table table-responsive't><'p-5'r>>>" +
                    "<'row custom-pagination d-flex flex-wrap'<'col-sm-12 col-md-3 mt-3'l><'col-sm-12 col-md-5 text-center align-self-center'i><'col-sm-12 col-md-4 mt-3'p>>",
                language: {
                    sProcessing: `
                        Procesando... <br/>
                        <img
                            src=\"{{ asset('images/datatable/loading-bar.gif') }}\"
                            alt='animated'
                        />`,
                    url: `{{ asset('js/datatable/lang/es.json') }}`
                },
                ajax: {
                    url: '{{ route($route) }}',
                    data: function ( d ) {
                        try {
                            // bindExtraParamsFilter(d);
                        } catch (error) {
                            console.warn('La tabla no tiene ningún filtro');
                        }
                    }
                },
                columns: @json($columns),
                order: @json($order),
                pageLength: 20,
                drawCallback: function () {
                    $('#{{$id}}_paginate ul.pagination').addClass("pagination-sm");
                    $('div.scrollable-table').css({
                        'max-height': '25vh',
                        'min-height': '65vh',
                    });
                },
                initComplete: function(settings, json) {
                    datatableComponent.buttons(0, null)
                        .container()
                        .appendTo(`#{{ $id }}_wrapper .crud-buttons`);
                    $('input[type=search]').attr('placeholder', 'Buscar...');

                    let parentNode = document.getElementById('{{$id}}_processing').parentNode;
                    parentNode.classList.remove("p-5");

                    // $('div.scrollable-table').slimScroll({
                    //     height: '100%',
                    //     width: '100%',
                    //     size: '8px',
                    //     color: '#11505d',
                    //     opacity: '0.7',
                    //     axis: 'both',
                    // });

                    createColResizable();
                }
            });

            new $.fn.dataTable.Buttons( datatableComponent, {
                buttons: generateCustomButtons()
            });
        });
    </script>
@endpush
