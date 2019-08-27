<script>
    import Text from "./Text";
    
    export default {
        name: 'input-date',
        mixins: [Text],
        data() {
            return {
                type: 'date',
            };
        },
    }
</script>
