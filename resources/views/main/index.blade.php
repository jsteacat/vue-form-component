@extends('template.app')

@section('content')

{{--    <button type="button" class="button" @click="trigger">TRIGGER</button>--}}

    <form-wrapper
            group="update-form"
            action="{{ route('main.store') }}"
            behaviour="confirmWithDialogAndClear"
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
                        />

                    </div>

                    <div class="cell small-12 medium-6">

                        <input-text
                                :group="props.group"
                                name="last_name"
                                v-model="props.fields.last_name"
                                maxlength="30"
                                autocomplete="family-name"
                                :validation="['required', 'min:2', 'max:30']"
                                :error="props.error"
                                current-value="Stalenin"
                        >
                            <validation
                                label="Family Name: *"
                                id="last_name"
                                name="last_name"
                                :show="props.error.has('last_name')"
                                :validation="{
                                    'required': 'Укажите фамилию',
                                    'min:2': 'Минимум 2 символа',
                                    'max:30': 'Максимум 30 символов'
                                }"
                                :error="props.error"
                            />
                        </input-text>

                    </div>

                </div>

            </fieldset>

            @include('template.partials.form-buttons-attached')

        </div>

    </form-wrapper>

@endsection

@push('footer-scripts')
    <script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
@endpush
