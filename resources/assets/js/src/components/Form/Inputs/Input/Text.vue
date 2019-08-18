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
            type="text"
            :group="group"
            :name="name"
            :id="identity"
            :value="value"
            :placeholder="placeholder"
            :maxlength="maxlength"
            :autocomplete="autocomplete"
            :class="inputCssClass"
            v-focus="focus"
            v-on="inputCallback"
        >
    </div>
</template>
<script>
    import Error from '../../Validator/Error';
    import Validation from '../../Validator/Validation';
    import Helper from '../../../../core/Helper';

    export default {
        name: 'input-text',
        components: { Validation },
        props: {
            group: {
                type: String,
            },
            label: {
                type: String,
            },
            name: {
                type: String,
                required: true,
            },
            id: {
                type: String,
            },
            value: {
                default: '',
            },
            currentValue: {
                default: '',
            },
            placeholder: {
                type: String,
            },
            focus: {
                type: Boolean,
                default: false,
            },
            maxlength: {
                type: String,
            },
            autocomplete: {
                type: String,
            },
            validation: {
                type: [Array, Object],
                default: () => [],
            },
            error: {
                type: Object,
                default: () => new Error,
            },
            visible: {
                type: Boolean,
                default: true,
            },
            inputCssClass: {
                type: String,
            },
            validationCssClass: {
                type: String,
            },
            wrapperCssClass: {
                type: String,
            },
            wrapperErrorCssClass: {
                type: String,
                default: 'invalid',
            },
            wrapperCssStyle: {
                type: String,
            },
            wrapperErrorCssStyle: {
                type: String,
            },
        },
        data() {
            return {
                identity: this.id ? this.id : this.name,
                displayValidation: false,
                isVisible: this.visible,
            };
        },
        computed: {
            inputCallback() {
                return Object.assign({}, this.$listeners, {
                    input: event => {
                      this.emit(event.target.value);
                    },
                });
            },
            isInvalid() {
                return this.error.has(this.name);
            },
            showValidation() {
                return this.isInvalid && this.displayValidation;
            },
            computedValidationCssClass() {
                return {
                    [this.validationCssClass]: this.isInvalid,
                };
            },
            computedWrapperCssClass() {
                return [
                    {
                        [this.wrapperErrorCssClass]: this.isInvalid,
                    },
                    this.wrapperCssClass,
                ];
            },
            computedWrapperCssStyle() {
                return [
                    {
                        [this.wrapperErrorCssStyle]: this.isInvalid,
                    },
                    this.wrapperCssStyle,
                ];
            },
        },
        mounted() {
            this.emit(this.currentValue);
            this.initialize();
        },
        methods: {
            emit(value) {
                this.$emit('input', value);
            },
            initialize() {
                if (Helper.isEmpty(this.validation)) return;
                
                let rules = this.validation;
                
                if (!Array.isArray(this.validation)) {
                    this.displayValidation = true;
                    rules = Object.keys(this.validation);
                }
                
                EventBus.fire('initialize-' + this.group, {
                    field: this.name,
                    rules
                });
            },
        },
    }
</script>
