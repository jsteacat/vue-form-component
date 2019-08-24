export default class Behaviour {
    
    static confirmWithDialogAndReset(form, response) {
        
        form.stopProcessingAjaxCall();
        form.reset();
        
        EventBus.fire('top-alert', {
            id: form.group,
            message: response.data.message,
        })
    }
    
    static redirect(form, response) {
        window.location.href = response.data.url;
    }
    
    static reload() {
        window.location.reload(true);
    }
    
    static sleep(form) {
        form.stopProcessingAjaxCall();
    }
    
}
