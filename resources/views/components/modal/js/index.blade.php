@includeWhen(!is_null($configFile), $configFile)

<script>
    $(document).ready(function () {
        let config;
        try {
            config = {{ $configVarName }};
        } catch (e) {
            config = {};
        }

        //Modal listeners events
        $(document).on("show.bs.modal", "#{{ $id }}", function () {
            let hasOnShowEvent = config
                && config.events
                && config.events.onShow

            if ( hasOnShowEvent ) {
                config.events.onShow();
            }
        });

        $(document).on("shown.bs.modal", "#{{ $id }}", function () {
            let hasOnShownEvent = config
                && config.events
                && config.events.onShown

            if ( hasOnShownEvent ) {
                config.events.onShown();
            }
        });

        $(document).on("hide.bs.modal", "#{{ $id }}", function () {
            let hasOnHideEvent = config
                && config.events
                && config.events.onHide

            if ( hasOnHideEvent ) {
                config.events.onHide();
            }
        });

        $(document).on("hidden.bs.modal", "#{{ $id }}", function () {
            let hasOnHiddenEvent = config
                && config.events
                && config.events.onHidden

            if ( hasOnHiddenEvent ) {
                config.events.onHidden();
            }
        });

        $(document).on("hidePrevented.bs.modal", "#{{ $id }}", function () {
            let hasOnHidePreventedEvent = config
                && config.events
                && config.events.onHidePrevented

            if ( hasOnHidePreventedEvent ) {
                config.events.onHidePrevented();
            }
        });
    });
</script>
