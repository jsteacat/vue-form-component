@extends('template.app')

@section('content')

    @include('template.partials.form-buttons-detached', ['group' => 'update-form'])

{{--    <button type="button" class="button" @click="trigger">TRIGGER</button>--}}

    <form-wrapper
        group="update-form"
        action="{{ route('main.store') }}"
        behaviour="confirmWithDialogAndClear"
{{--        :disabled="true"--}}
        :collections="{ address: {}, colours: [] }"
        v-cloak
    >

        <div slot-scope="props">

            <fieldset class="fieldset">

                <legend>Personal details</legend>

                <div class="grid-x grid-margin-x">

                    <div class="cell small-12 medium-6">

                        <input-text
                            :group="props.group"
                            name="first_name"
                            v-model="props.fields.first_name"
                            label="First Name: *"
                            maxlength="30"
                            autocomplete="given-name"
                            focus
                            :validation="{
                                'required': 'Укажите имя',
                                'min:2': 'Минимум 2 символа',
                                'max:30': 'Максимум 30 символов'
                            }"
                            :error="props.error"
                            current-value="Stepan"
                            :disabled="props.isDisabled"
                        />

                    </div>

                    <div class="cell small-12 medium-6">

                        <input-text
                            :group="props.group"
                            name="last_name"
                            v-model="props.fields.last_name"
                            label="Family Name: *"
                            maxlength="30"
                            autocomplete="family-name"
                            :validation="{
                                'required': 'Укажите фамилию',
                                'min:2': 'Минимум 2 символа',
                                'max:30': 'Максимум 30 символов'
                            }"
                            :error="props.error"
                            current-value="Stalenin"
                            :disabled="props.isDisabled"
                        />

                    </div>

                    <div class="cell small-12 medium-6">

                        <input-email
                            :group="props.group"
                            name="email"
                            v-model="props.fields.email"
                            label="Email: *"
                            :validation="{
                                'required': 'Укажите Email',
                                'email': 'Неверный формат'
                            }"
                            :error="props.error"
                        />

                    </div>

                    <div class="cell small-12 medium-6">

                        <input-password
                            :group="props.group"
                            name="password"
                            v-model="props.fields.password"
                            label="Password: *"
                            autocomplete="off"
                            :validation="{
                                'required': 'Введите пароль',
                                'password': 'Неверный формат'
                            }"
                            :error="props.error"
                        />

                    </div>

                    <div class="cell small-12 medium-6">

                        <input-text
                            :group="props.group"
                            name="address.line_1"
                            v-model="props.fields.address.line_1"
                            label="Address line 1: *"
                            :validation="{
                                'required': 'Укажите адрес'
                            }"
                            :error="props.error"
                        />

                    </div>

                    <div class="cell small-12 medium-6">

                        <input-text
                            :group="props.group"
                            name="address.line_2"
                            v-model="props.fields.address.line_2"
                            label="Address line 2:"
                        />

                    </div>

                    <div class="cell small-12 medium-6">

                        <input-text
                            :group="props.group"
                            name="address.town"
                            v-model="props.fields.address.town"
                            label="Town: *"
                            :validation="{
                                'required': 'Укажите город'
                            }"
                            :error="props.error"
                        />

                    </div>

                    <div class="cell small-12 medium-6">

                        <input-text
                            :group="props.group"
                            name="address.post_code"
                            v-model="props.fields.address.post_code"
                            label="Post code: *"
                            :validation="{
                                'required': 'Укажите индекс'
                            }"
                            :error="props.error"
                        />

                    </div>

                </div>

            </fieldset>

            <div class="grid-x grid-margin-x">

                <div class="cell small-12 medium-6">

                    <fieldset class="fieldset">

                        <legend>Consents</legend>

                        <div class="checkbox-group">

                            <input-checkbox
                                :group="props.group"
                                name="share"
                                label="Please share my data with third party"
                                v-model="props.fields.share"
                                :validation="{
                                    'required': 'Invalid selection',
                                    'in:a': 'We have to share your data'
                                }"
                                :error="props.error"
                                current-value="a"
                                true-value="a"
                                false-value="b"
                                validation-css-class="block"
                            ></input-checkbox>

                            <input-checkbox
                                :group="props.group"
                                name="privacy"
                                label="I agree with the privacy policy"
                                v-model="props.fields.privacy"
                                :validation="{
                                    'required': 'You have to agree with our privacy policy'
                                }"
                                :error="props.error"
                                remove-when-false
                                validation-css-class="block"
                            ></input-checkbox>

                            <input-checkbox
                                :group="props.group"
                                name="terms"
                                label="I agree with the terms & conditions"
                                v-model="props.fields.terms"
                                :validation="{
                                    'accepted': 'You have to agree with our terms & conditions'
                                }"
                                :error="props.error"
                                validation-css-class="block"
                            ></input-checkbox>

                        </div>

                    </fieldset>

                </div>

                <div class="cell small-12 medium-6">

                    <fieldset class="fieldset">

                        <legend>Colours (exactly 2 items)</legend>

                        <validation
                            id="colours"
                            name="colours"
                            :show="props.error.has('colours')"
                            :validation="{
                                'required': 'Please select exactly 2 items',
                                'min:2': 'Please select exactly 2 items',
                                'max:2': 'Please select exactly 2 items',
                            }"
                            :error="props.error"
                            css-class="block"
                        ></validation>

                        <div class="checkbox-group">

                            <input-checkbox-group
                                :group="props.group"
                                name="colours"
                                :current-value="['blue']"
                                :options="[
                                    {
                                        name: 'Blue',
                                        value: 'blue'
                                    },
                                    {
                                        name: 'Green',
                                        value: 'green'
                                    },
                                    {
                                        name: 'Orange',
                                        value: 'orange'
                                    },
                                ]"
                                v-model="props.fields.colours"
                                :validation="['required', 'min:2', 'max:2']"
                                :error="props.error"
                            ></input-checkbox-group>

                        </div>

                    </fieldset>

                </div>

            </div>

{{--            <button type="button" class="button" @click="props.enable">Enable</button>--}}
{{--            <button type="button" class="button" @click="props.disable">Disable</button>--}}

            @include('template.partials.form-buttons-attached')

        </div>

    </form-wrapper>

@endsection

@push('footer-scripts')
    <script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
@endpush
