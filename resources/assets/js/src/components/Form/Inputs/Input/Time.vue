<script>
    import Text from "./Text";
    
    export default {
        name: 'input-time',
        mixins: [Text],
        data() {
            return {
                type: 'time',
            };
        },
    }
</script>
