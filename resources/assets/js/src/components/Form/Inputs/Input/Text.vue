<template>
    <input
        type="text"
        :group="group"
        :name="name"
        :id="identity"
        :value="value"
        :placeholder="placeholder"
        :maxlength="maxlength"
        :autocomplete="autocomplete"
        v-focus="focus"
        v-on="inputCallback"
    >
</template>
<script>
    import Helper from '../../../../core/Helper';

    export default {
        name: 'input-text',
        props: {
            group: {
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
        },
        data() {
            return {
                identity: this.id ? this.id : this.name,
                displayValidation: false,
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
