<script>
    import Disabler from "../../mixins/Disabler";
    import Processor from "../../mixins/Processor";
    export default {
        name: 'app-trigger',
        mixins: [Disabler, Processor],
        props: {
            group: {
                type: String,
                required: true,
            },
            name: {
                type: String,
                default: 'items',
            },
        },
        created() {
            EventBus.listen('disabled-started-' + this.group, this.disable);
            EventBus.listen('disabled-ended-' + this.group, this.enable);
        },
        methods: {
            conditionalTrigger() {
                if (this.isDisabled) return;
                this.trigger();
            },
            trigger() {
                console.log('Действие не задано');
            },
        },
        render() {
            return this.$scopedSlots.default({
                disabled: this.isDisabled,
                processing: this.processing,
                trigger: this.conditionalTrigger,
            });
        },
    }
</script>
