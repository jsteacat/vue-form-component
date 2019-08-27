<script>
    import Text from "./Text";
    
    export default {
        name: 'input-datetime',
        mixins: [Text],
        data() {
            return {
                type: 'datetime',
            };
        },
    }
</script>
