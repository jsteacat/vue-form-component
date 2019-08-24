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
    import Behaviour from './Behaviour';
    import Error from './Validator/Error';
    import Validator from './Validator/Validator';
    import AjaxCaller from "../../mixins/AjaxCaller";
    import ErrorHandler from "../../core/ErrorHandler";

    export default {
        name: 'form-wrapper',
        mixins: [AjaxCaller],
        props: {
            group: {
                type: String,
            },
            behaviour: {
                type: String,
            },
            eventSubmitOnly: {
                type: Boolean,
            },
        },
        data() {
            return {
                fields: {},
                validationSet: {},
                error: new Error,
            };
        },
        computed: {
            requestData() {
                return this.fields;
            },
        },
        created() {
            EventBus.listen('submit-' + this.group, this.submitEvent);
            EventBus.listen('initialize-' + this.group, this.initialize);
        },
        methods: {
            initialize(data) {
                if (!this.validationSet.hasOwnProperty(data.field)) {
                    this.validationSet[data.field] = data.rules;
                }
            },
            reset() {
            
            },
            onSubmit() {
                if(this.eventSubmitOnly) return;
                this.submitEvent();
            },
            submitEvent() {
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
                EventBus.fire('clear-top-dialog');
                this.makeAjaxCall(this.callSuccessful, this.callFailed); // from AjaxCaller mixin
            },
            callSuccessful(response) {
                try {
                    Behaviour[this.behaviour ? this.behaviour : response.data.behaviour](this, response);
                } catch (error) {
                    ErrorHandler.showError({
                        message: 'Invalid form behaviour',
                    });
                    this.stopProcessingAjaxCall(); // from AjaxCaller mixin
                }
            },
            callFailed(error) {
                // ErrorHandler is globally in bootstrap.js
                ErrorHandler.showError(error, this.stopProcessingAjaxCall);
            },
        },
    }
</script>
