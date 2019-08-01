<template>
    <form novalidate>
        <slot
            :group="group"
            :fields="fields"
            :validation="validation"
        />
    </form>
</template>
<script>
    export default {
        name: 'form-wrapper',
        props: {
            group: {
                type: String,
            },
            behaviour: {
                type: String,
            },
        },
        data() {
            return {
                fields: {},
                validation: {},
            };
        },
    }
</script>
