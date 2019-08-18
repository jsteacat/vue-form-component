import Rule from './Rule';

export default class Validator {
    
    constructor(wrapper, resolve, reject) {
        this.fields = wrapper.fields;
        this.validationSet = wrapper.validationSet;
        this.errors = {};
        
        Promise.all(this.promises()).then(resolve).catch(error => {
            wrapper.error.set(this.errors);
            reject({ message: error });
        });
        
    }
    
    promises() {
        
        let promises = [];
        
        for (let field in this.validationSet) {
            promises.push(this.validate(field));
        }
        
        return promises;
        
    }
    
    validate(field) {
        return new Promise((resolve, reject) => {
            const
                rules = this.validationSet[field],
                rulesCount = rules.length,
                value = this.getValue(field);
            
            for (let index in rules) {
                if (!this.errors.hasOwnProperty(field)) {
                    let [rule, params] = rules[index].split(':');
                    
                    try {
                        
                        if (!Rule[rule](value, params)) {
                            this.errors[field] = rule;
                            reject('Поле некорректно');
                        }
                        
                    } catch(error) {
                        reject(`Ошибка валидации: ${rule}`);
                    }
                }
                
                if ((parseInt(index) + 1) === rulesCount) {
                    resolve();
                }
            }
        });
    }
    
    getValue(field) {
        return field.split('.').reduce((acc, current) => {
            return acc[current];
        }, this.fields);
    }
    
}
