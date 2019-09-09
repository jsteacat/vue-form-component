<script>
    export default {
        name: 'processor',
        data() {
            return {
                processing: false,
            };
        },
        methods: {
            startProcessing() {
                this.processing = true;
            },
            stopProcessing() {
                this.processing = false;
            },
        },
    }
</script>
