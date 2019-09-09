<script>
    import Text from "./Text";
    
    export default {
        name: 'input-email',
        mixins: [Text],
        data() {
            return {
                type: 'email',
            };
        },
    }
</script>
