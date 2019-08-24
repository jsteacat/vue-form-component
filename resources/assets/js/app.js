require('./bootstrap');
require('./directives');
require('./components');

(new Vue({ el: '#app'}));
// (new Vue({
//     el: '#app',
//     mounted() {
//         EventBus.listen('testButton-called', response => {
//             response.dialog.clear({ success: true });
//         });
//
//         EventBus.listen('testButton-cleared', response => {
//             if (!response.success) return;
//             EventBus.fire('submit-update-form');
//         });
//     },
//     methods: {
//         trigger() {
//             EventBus.fire('top-confirm', {
//                 id: 'testButton',
//                 message: 'Testing event handling',
//             });
//         },
//     },
// }));
