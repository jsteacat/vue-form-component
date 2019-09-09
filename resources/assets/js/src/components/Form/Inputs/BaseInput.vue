<script>
    import Error from '../Validator/Error';
    import Validation from '../Validator/Validation';
    import Helper from '../../../core/Helper';
    import Disabler from "../../../mixins/Disabler";
    export default {
        name: 'base-input',
        mixins: [Disabler],
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
            options: {
                type: [Array, Object, String],
                default: () => [],
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
            wrapperErrorCssClass: {
                type: String,
                default: 'invalid',
            },
            wrapperErrorCssStyle: {
                type: String,
            },
            listen: {
                type: String,
            },
            fire: {
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
            isInvalid() {
                return this.error.has(this.name);
            },
            showValidation() {
                return this.isInvalid && this.displayValidation;
            },
            computedValidationCssClass() {
                return { [this.validationCssClass]: this.isInvalid };
            },
            computedWrapperCssClass() {
                return { [this.wrapperErrorCssClass]: this.isInvalid };
            },
            computedWrapperCssStyle() {
                return { [this.wrapperErrorCssStyle]: this.isInvalid };
            },
        },
        methods: {
            emit(value, event = 'input') {
                this.emitFireEvent(value);
                this.$emit(event, value);
            },
            emitFireEvent(value) {
                if (this.fire) {
                    EventBus.fire(this.fire, value);
                }
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
            registerListeners() {
                EventBus.listen('reset-form-' + this.group, this.reset);
                EventBus.listen('clear-form-' + this.group, this.clear);
            },
            reset() {
                console.log('Please provide reset method implementation for ' + this.name);
            },
            clear() {
                console.log('Please provide clear method implementation for ' + this.name);
            },
            getOptionId(option) {
                if (option.id) return option.id;
                return this.name + '-' + option.value;
            },
        },
        watch: {
            disabled(isDisabled) {
                if (isDisabled) this.disable();
                else this.enable();
            },
        },
    }
</script>
