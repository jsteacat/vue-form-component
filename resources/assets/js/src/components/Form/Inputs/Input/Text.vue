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
        },
        data() {
            return {
                identity: this.id ? this.id : this.name,
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
        },
        methods: {
            emit(value) {
                this.$emit('input', value);
            },
        },
    }
</script>
