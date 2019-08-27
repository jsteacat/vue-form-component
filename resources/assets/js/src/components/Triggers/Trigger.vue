<template>
    <span :class="cssClass" v-html="label" @click="trigger"></span>
</template>

<script>
    import Disabler from "../../mixins/Disabler";

    export default {
        name: 'app-trigger',
        mixins: [Disabler],
        props: {
            group: {
                type: String,
                required: true,
            },
            isSubmit: {
                type: Boolean,
                default: false,
            },
            name: {
                type: String,
                default: 'items',
            },
            restingLabel: {
                type: String,
                default: 'SUBMIT',
            },
            restingCssClass: {
                type: String,
            },
            restingIcon: {
                type: String,
            },
            workingLabel: {
                type: String,
                default: 'PROCESSING',
            },
            workingCssClass: {
                type: String,
            },
            workingIcon: {
                type: String,
            },
        },
        data() {
            return {
                processing: false,
            };
        },
        computed: {
            cssClass() {
                if (this.processing) return [this.workingCssClass ? this.workingCssClass : this.restingCssClass, 'disabled'];
                return [this.restingCssClass, { disabled: this.isDisabled }];
            },
            label() {
                if (this.processing) {
                    return (this.workingIcon ? `<i class="${this.workingIcon}"></i> ` : '') + this.workingLabel;
                }
                return (this.restingIcon ? `<i class="${this.restingIcon}"></i> ` : '') + this.restingLabel;
            },
        },
        created() {
            EventBus.listen('disabled-started-' + this.group, this.disable);
            EventBus.listen('disabled-ended-' + this.group, this.enable);
        },
        methods: {
            trigger() {
                console.log('Действие не задано');
            },
        },
    }
</script>
