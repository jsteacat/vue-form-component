<script>
    export default {
        name: 'multi-handler',
        data() {
            return {
                items: [],
            };
        },
        mounted() {
            this.registerCustomListeners();
        },
        methods: {
            registerCustomListeners() {
                EventBus.listen(this.listen, item => {
                    if (item.remove) this.remove(item);
                    else if (item.value && !this.items.includes(item.value)) this.items.push(item.value);
                    this.evaluate();
                });
            },
            remove(item) {
                this.items = this.items.filter(elem => elem !== item.value);
            },
            evaluate() {},
        },
    }
</script>
