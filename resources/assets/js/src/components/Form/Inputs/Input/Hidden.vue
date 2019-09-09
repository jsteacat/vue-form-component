<script>
    import Text from "./Text";
    
    export default {
        name: 'input-hidden',
        mixins: [Text],
        data() {
            return {
                type: 'hidden',
            };
        },
    }
</script>
