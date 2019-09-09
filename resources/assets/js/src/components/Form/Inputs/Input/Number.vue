<script>
    import Text from "./Text";
    
    export default {
        name: 'input-number',
        mixins: [Text],
        data() {
            return {
                type: 'number',
            };
        },
    }
</script>
