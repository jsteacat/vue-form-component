<template>
    <div
        v-show="visible"
        :class="computedWrapperCssClass"
        :style="computedWrapperCssStyle"
        class="checkbox-group-item"
    >
        <input
            type="checkbox"
            v-model="checked"
            :id="identity"
            :name="name"
            :disabled="isDisabled"
            :autocomplete="autocomplete"
            :indeterminate.prop="indeterminate"
            :class="inputCssClass"
            @change="update"
        >
        <validation
            :label="label"
            :id="identity"
            :name="name"
            :show="showValidation"
            :validation="validation"
            :error="error"
            :css-class="computedValidationCssClass"
        ></validation>
    </div>
</template>

<script>
    import BaseInput from "../../BaseInput";
    import MultiHandler from "../../../../../mixins/MultiHandler";

    export default {
        name: 'master-checkbox',
        mixins: [BaseInput, MultiHandler],
        props: {
            total: {
                type: Number,
                required: true,
            },
            fire: {
                type: String,
                required: true,
            },
        },
        data() {
            return {
                checked: false,
                indeterminate: false,
            };
        },
        methods: {
            evaluate() {
                const length = this.items.length;
                this.checked = length === this.total;
                this.indeterminate = length > 0 && length < this.total;
            },
            update() {
                EventBus.fire(this.fire, this.checked);
            },
        },
    }
</script>
