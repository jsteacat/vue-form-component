export default class EventBus {
    
    constructor() {
        this.bus = new Vue;
    }
    
    fire(events, ...data) {
        this.wrapper(
            events,
            () => this.bus.$emit(events, ...data),
            idx => this.bus.$emit(events[idx], ...data)
        );
    }
    
    listen(events, callback) {
        this.wrapper(
            events,
            () => this.bus.$on(events, callback),
            idx => this.bus.$on(events[idx], callback)
        );
    }
    
    wrapper(events, ifNotArray, otherwise) {
        if (!Array.isArray(events)) {
            ifNotArray();
            return;
        }
    
        for (const idx in events) {
            otherwise(idx);
        }
    }
}

