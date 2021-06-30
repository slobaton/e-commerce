<script>
    function generateCustomButtons () {
        let buttons = [];
        let customButtonsConfig = filterCustomButtons();

        if (_.isArray(customButtonsConfig)) {
            customButtonsConfig.forEach(currentButton => {
                buttons.push(generateButton(currentButton));
            });
        }

        return buttons;
    }

    function filterCustomButtons () {
        let customButtons = [];
        let hasCustomButtons =
            datatableConfig.custom &&
            datatableConfig.custom.buttons &&
            datatableConfig.custom.buttons.length > 0;

        if (hasCustomButtons && _.isArray(datatableConfig.custom.buttons)) {
            customButtons = _.filter(datatableConfig.custom.buttons, function(currentButton) {
                return currentButton.hasPermission;
            });
        }

        return customButtons;
    }

    function generateButton(button) {
        if (button.tooltip) {
            let tooltipAttr = {
                'data-toggle': 'tooltip',
                'data-placement': button.tooltip.placement,
                'title': button.tooltip.text
            };
            _.assign(button.attr, tooltipAttr);
        }

        let element = {
            extend: `${ button.selection || ''}`,
            text: `<i class="${button.icon}"></i> ${button.text}`,
            className: button.className,
            action: function (evt, dt) {
                let rows = dt.rows( { selected: true } ).data();
                button.action(evt, rows, dt)
            },
            attr: button.attr
        };

        if (element.attr && element.attr.id) {
            element.attr.id = `${element.attr.id}`
        }

        return element;
    }
</script>
