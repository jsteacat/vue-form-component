<template>
    <div id="top-dialog" :class="wrapperClass">
        <div
            class="dialog alert"
            :class="visibleClass('alert')"
            v-html="message"
            @click="clear"
        ></div>
    
        <div
            class="dialog warning"
            :class="visibleClass('warning')"
            v-html="message"
            @click="clear"
        ></div>
    
        <div
            class="dialog confirm"
            :class="visibleClass('confirm')"
        >
            <p v-html="message"></p>
            <nav>
                <span v-if="!processing" class="small button" @click="makeCall">Да</span>
                <span v-else class="small disabled button">
                    <i class="fas fa-spinner fa-spin fa-fw"></i>
                </span>
                <span class="small success button" @click="clear">Нет</span>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'top-dialog',
        props: {
            sessionDialog: {
                type: Object,
                default: () => { return {} },
            },
        },
        data() {
            return {
                id: null,
                type: null,
                timeout: null,
                message: '',
                processing: false,
                url: null,
                data: {},
                methodType: 'get',
            };
        },
        computed: {
            isVisible() {
                return this.message !== '';
            },
            wrapperClass() {
                return {
                    'overlay': this.isVisible && this.typeIs('confirm'),
                };
            },
        },
        created() {
            EventBus.listen('clear-top-dialog', this.clear);
            EventBus.listen('top-alert', this.alertEvent);
            EventBus.listen('top-warning', this.warningEvent);
            EventBus.listen('top-confirm', this.confirmEvent);
        },
        mounted() {
            if (Object.keys(this.sessionDialog).length) {
                setTimeout(() => {
                    EventBus.fire(this.sessionDialog.type, {
                        id: 'session-' + this.sessionDialog.type,
                        message: this.sessionDialog.message,
                    });
                }, 500);
            }
        },
        methods: {
            typeIs(type) {
                return this.type === type;
            },
            visibleClass(type) {
                return {
                    'active': this.isVisible && this.typeIs(type),
                };
            },
            clear(data = null) {
                this.clearCountDown();
                this.type = null;
                this.message = '';
                this.url = null;
                this.data = {};
                this.methodType = 'get';
                this.processing = false;
                
                EventBus.fire(this.id + '-cleared', data || {});
            },
            clearCountDown() {
                if (!this.timeout) return;
                clearTimeout(this.timeout);
                this.timeout = null;
            },
            alert(data, type) {
                this.clear();
                this.id = data.id;
                this.type = type;
                this.message = data.message;
                this.countDown();
            },
            alertEvent(data) {
                this.alert(data, 'alert');
            },
            warningEvent(data) {
                this.alert(data, 'warning');
            },
            confirmEvent(dataIn) {
                this.clear();
                const { id, url, message, data, method } = dataIn;
                this.id = id;
                this.message = message;
                this.type = 'confirm';
                if (url) this.url = url;
                if (data) this.data = data;
                if (method) this.methodType = method.toLocaleLowerCase();
            },
            countDown() {
                this.timeout = setTimeout(() => {
                    this.clear();
                }, 7000);
            },
            makeCall() {
                this.processing = true;
                if (this.url) {
                
                } else {
                    this.success();
                }
            },
            success(response) {
                EventBus.fire(this.id + '-called', {
                    response,
                    dialog: this,
                });
            }
        },
    };
</script>
