<div class="grid-x">

    <div class="cell small-12 medium-3 large-2">

        <button
            type="submit"
            class="expanded button"
            v-show="!props.processing"
        >
            <i class="fas fa-check fa-fw"></i>
            SUBMIT
        </button>

        <button
            type="button"
            disabled
            class="button"
            v-show="props.processing"
        >
            <i class="fas fa-spinner fa-spin fa-fw"></i>
            PROCESSING
        </button>

    </div>

    <div class="cell small-12 medium-6 large-4 medium-offset-3 large-offset-6 medium-text-right">

        <nav class="expanded button-group">

            <button
                type="button"
                class="alert button"
                @click="props.reset"
            >
                <i class="fas fa-eraser fa-fw"></i>
                RESET
            </button>

            <button
                    type="button"
                    class="warning button"
                    @click="props.clear"
            >
                <i class="fas fa-times fa-fw"></i>
                CLEAR
            </button>

        </nav>

    </div>

</div>
