<script>
    import Text from "./Text";
    
    export default {
        name: 'input-password',
        mixins: [Text],
        data() {
            return {
                type: 'password',
            };
        },
    }
</script>
