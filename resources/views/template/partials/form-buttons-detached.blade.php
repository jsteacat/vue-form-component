<div class="grid-x">

    <div class="cell small-12 medium-3 large-2">

        <form-trigger
            group="{{ $group }}"
            fire="submit"
            :is-submit="true"
            resting-label="SUBMIT"
            resting-css-class="expanded button"
            resting-icon="fas fa-check fa-fw"
            working-icon="fas fa-spinner fa-spin fa-fw"
        ></form-trigger>

    </div>

    <div class="cell small-12 medium-6 large-4 medium-offset-3 large-offset-6 medium-text-right">

        <nav class="expanded button-group">

            <form-trigger
                    group="{{ $group }}"
                    fire="reset"
                    resting-label="RESET"
                    resting-css-class="alert button"
                    resting-icon="fas fa-eraser fa-fw"
                    working-icon="fas fa-spinner fa-spin fa-fw"
            ></form-trigger>
            <form-trigger
                    group="{{ $group }}"
                    fire="clear"
                    resting-label="CLEAR"
                    resting-css-class="warning button"
                    resting-icon="fas fa-times fa-fw"
                    working-icon="fas fa-spinner fa-spin fa-fw"
            ></form-trigger>

        </nav>

    </div>

</div>

