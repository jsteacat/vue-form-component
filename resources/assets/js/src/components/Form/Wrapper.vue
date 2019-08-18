<template>
    <form @submit.prevent="onSubmit" novalidate>
        <slot
            :group="group"
            :fields="fields"
            :validation="validationSet"
            :error="error"
            :submit="onSubmit"
        />
    </form>
</template>
<script>
    import Error from './Validator/Error';
    import Validator from './Validator/Validator';

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
                error: new Error,
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
            onSubmit() {
                this.validate().then(this.makeCall).catch(this.callFailed);
            },
            validate() {
                return new Promise((resolve, reject) => {
                    if (!this.requiresValidation()) {
                        resolve();
                        return;
                    }
                    
                    this.error = new Error;
                    
                    new Validator(this, resolve, reject);
                });
            },
            requiresValidation() {
                // not computed because cashing
                return Object.keys(this.validationSet).length > 0;
            },
            makeCall() {
            
            },
            callFailed(error) {
                // console.log(error);
                ErrorHandler.showError(error);
            },
        },
    }
</script>
