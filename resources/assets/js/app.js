require('./bootstrap');
require('./directives');
require('./components');

// (new Vue({ el: '#app'}));
(new Vue({
    el: '#app',
    mounted() {
    
    },
    methods: {
        trigger() {
            EventBus.fire('top-confirm', {
                id: 'testButton',
                message: 'Testing event handling',
            });
        },
    },
}));
