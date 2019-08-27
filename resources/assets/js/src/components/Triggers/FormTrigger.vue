<script>
    import Trigger from "./Trigger";

    export default {
        name: 'form-trigger',
        mixins: [Trigger],
        props: {
            fire: {
                type: String,
                required: true,
            },
        },
        created() {
            EventBus.listen('submission-started-' + this.group, () => {
                if (this.isSubmit) {
                    this.processing = true;
                }
            });
    
            EventBus.listen('submission-ended-' + this.group, () => {
                this.processing = false;
            });
        },
        methods: {
            trigger() {
                if (this.isDisabled) return;
                EventBus.fire(this.fire + '-' + this.group);
            },
        },
    }
</script>
