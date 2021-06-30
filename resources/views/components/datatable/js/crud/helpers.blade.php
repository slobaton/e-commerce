<script>
    const MODAL_CREATE = 'create';
    const MODAL_EDIT   = 'edit';
    const SELECTED_ROW = 0;
    const TABLE_ID = '{{ $id }}';
    let datatableCrudValidator,
        modalMode,
        seletedRow;
</script>
@once
    @include('components.common.js.crud')
    @include('components.datatable.js.crud.common')
@endOnce
@include('components.datatable.js.crud.delete')
@include('components.datatable.js.crud.create')
@include('components.datatable.js.crud.edit')
<script>
const crudButtonsConfig = [{
    type: 'create',
    text: 'Crear',
    icon: 'fas fa-plus-square',
    className: 'btn btn-secondary btn-sm',
    action: createFn,
    tooltip: {
        placement: 'top',
        text: 'Crea un nuevo elemento'
    },
    attr:  {
        id: 'create-btn-datatable'
    }
}, {
    extend: 'selectedSingle',
    type: 'edit',
    text: 'Editar',
    icon: 'fas fa-edit',
    className: 'btn btn-warning btn-sm edit-btn',
    action: editFn,
    tooltip: {
        placement: 'top',
        text: 'Edita el elemento seleccionado'
    },
    attr:  {
        id: 'edit-btn-datatable',
        disabled: true
    }
}, {
    extend: 'selected',
    type: 'delete',
    text: 'Eliminar',
    icon: 'fas fa-trash-alt',
    className: 'btn btn-danger btn-sm delete-btn rounded-right',
    action: deleteFn,
    tooltip: {
        placement: 'top',
        text: 'Elimina el o los elementos seleccionados'
    },
    attr:  {
        id: 'delete-btn-datatable',
        disabled: true
    }
}];

function buildCrudButtons () {

    const hasCrudActions =
        datatableConfig.crud &&
        datatableConfig.crud.buttons &&
        datatableConfig.crud.buttons.length > 0;


    if (!hasCrudActions) {
        return [];
    }
    const buttons = _.map(crudButtonsConfig, function( action ) {
        const currentActionBtn = _.find(
            datatableConfig.crud.buttons,
            button => { return action.type == button.type; }
        );

        let hasPermission = currentActionBtn && currentActionBtn.hasPermission;

        if (currentActionBtn && hasPermission) {
            const tooltip = currentActionBtn.tooltip || action.tooltip;
            const attributes = currentActionBtn.attr || action.attr;
            return {
                ...action,
                text: `<i class="${currentActionBtn.icon || action.icon}"></i>
                    &nbsp;${ currentActionBtn.text || action.text }`,
                className: currentActionBtn.class || action.className,
                extend: `${ currentActionBtn.selection || action.extend || ''}`,
                attr: generateAttributes(tooltip, attributes)
            }
        }
        return null;
    });

    return _.filter(buttons, currentBtn => currentBtn);
}

function generateAttributes (tooltip, attributes) {
    let attr = attributes || {};

    if (tooltip) {
        let tooltipAttr = {
            'data-toggle': 'tooltip',
            'data-placement': tooltip.placement,
            'title': tooltip.text
        };
        _.assign(attr, tooltipAttr)
    }

    return attr;
}
</script>
