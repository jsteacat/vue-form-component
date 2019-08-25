<template>
    <form @submit.prevent="onSubmit" novalidate>
        <slot
            :group="group"
            :fields="fields"
            :validation="validationSet"
            :error="error"
            :reset="reset"
            :clear="clear"
            :submit="onSubmit"
            :enable="enable"
            :disable="disable"
            :processing="processing"
            :isDisabled="isDisabled"
        />
    </form>
</template>
<script>
    import Behaviour from './Behaviour';
    import Error from './Validator/Error';
    import Validator from './Validator/Validator';
    import AjaxCaller from "../../mixins/AjaxCaller";
    import Disabler from "../../mixins/Disabler";
    import ErrorHandler from "../../core/ErrorHandler";

    export default {
        name: 'form-wrapper',
        mixins: [AjaxCaller, Disabler],
        props: {
            group: {
                type: String,
                require: true,
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
            EventBus.listen('reset-' + this.group, this.reset);
            EventBus.listen('clear-' + this.group, this.clear);
            EventBus.listen('disabled-started-' + this.group, this.disable);
            EventBus.listen('disabled-ended-' + this.group, this.enable);
        },
        mounted() {
            if (this.isDisabled) {
                EventBus.fire('disable-started-' + this.group);
            }
        },
        methods: {
            startProcessingAjaxCallEvent() {
                EventBus.fire('disable-started-' + this.group);
            },
            stopProcessingAjaxCallEvent() {
                EventBus.fire('disable-ended-' + this.group);
            },
            initialize(data) {
                if (!this.validationSet.hasOwnProperty(data.field)) {
                    this.validationSet[data.field] = data.rules;
                }
            },
            disable() {
                Disabler.methods.disable.call(this);
            },
            reset() {
                if (this.isDisabled) return;
                this.cleanse('reset-form');
            },
            clear() {
                if (this.isDisabled) return;
                this.cleanse('clear-form');
            },
            cleanse(event) {
                this.clearNotifications();
                EventBus.fire(event + '-' + this.group);
            },
            clearNotifications() {
                this.error.clear();
                EventBus.fire('clear-top-dialog');
            },
            onSubmit() {
                if(this.eventSubmitOnly) return;
                this.submitEvent();
            },
            submitEvent() {
                if (this.isDisabled) return;
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
