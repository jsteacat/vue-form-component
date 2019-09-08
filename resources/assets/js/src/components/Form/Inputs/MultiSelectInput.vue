<script>
    import BaseInput from "./BaseInput";

    export default {
        name: 'multi-select-input',
        mixins: [BaseInput],
        data() {
            return {
                selected: this.currentValue || [],
            };
        },
        methods: {
            reset() {
                if (this.currentValue) {
                    this.emit(this.selected = this.currentValue);
                    return;
                }
                this.clear();
            },
            clear() {
                this.emit(this.selected = []);
            },
            isSelected(value) {
               return this.selected.includes(value);
            },
        },
    }
</script>
