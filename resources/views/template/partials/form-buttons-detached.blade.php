<div class="grid-x">

    <div class="cell small-12 medium-3 large-2">

        <form-trigger
            group="{{ $group }}"
            fire="submit"
            :is-submit="true"
            resting-css-class="expanded button"
        ></form-trigger>

    </div>

    <div class="cell small-12 medium-6 large-4 medium-offset-3 large-offset-6 medium-text-right">

        <nav class="expanded button-group">

            <form-trigger
                group="{{ $group }}"
                fire="reset"
                resting-css-class="alert button"
            >
                <template slot="label-on">
                    <i class="fas fa-eraser fa-fw"></i> RESET
                </template>
            </form-trigger>
            <form-trigger
                group="{{ $group }}"
                fire="clear"
                resting-css-class="warning button"
            >
                <template slot="label-on">
                    <i class="fas fa-times fa-fw"></i> CLEAR
                </template>
            </form-trigger>

        </nav>

    </div>

</div>

