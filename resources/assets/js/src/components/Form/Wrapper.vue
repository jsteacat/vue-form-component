<template>
    <form novalidate>
        <slot
            :group="group"
            :fields="fields"
            :validation="validationSet"
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
                validationSet: {},
            };
        },
        created() {
            EventBus.listen('initialize-' + this.group, this.initialize);
        },
        methods: {
            initialize(data) {
                if (!this.validationSet.hasOwnProperty(data.field)) {
                    this.validationSet[data.field] = data.rules;
                }
            },
        },
    }
</script>
