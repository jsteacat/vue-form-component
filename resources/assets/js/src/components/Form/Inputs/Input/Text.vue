<template>
    <div v-show="isVisible" :class="computedWrapperCssClass" :style="computedWrapperCssStyle">
        <slot>
            <validation
                :label="label"
                :id="identity"
                :name="name"
                :show="showValidation"
                :css-class="computedValidationCssClass"
                :validation="validation"
                :error="error"
            />
        </slot>
        <input
            :type="type"
            :group="group"
            :name="name"
            :id="identity"
            :value="value"
            :placeholder="placeholder"
            :maxlength="maxlength"
            :autocomplete="autocomplete"
            :class="inputCssClass"
            :disabled="isDisabled"
            v-focus="focus"
            v-on="inputListeners"
        >
    </div>
</template>
<script>
    import BaseInput from "../BaseInput";

    export default {
        name: 'input-text',
        mixins: [BaseInput],
        data() {
            return {
                type: 'text',
            };
        },
        computed: {
            inputListeners() {
                return Object.assign({}, this.$listeners, {
                    input: event => {
                        this.emit(event.target.value);
                    },
                });
            },
        },
        mounted() {
            this.emit(this.currentValue);
            this.initialize();
            this.registerListeners();
        },
        methods: {
            reset() {
                this.emit(this.currentValue);
            },
            clear() {
                this.emit('');
            },
        },
    }
</script>
