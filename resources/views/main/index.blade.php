@extends('template.app')

@section('content')

    <form-wrapper group="update-form" v-cloak>

        <div slot-scope="props">

            <fieldset class="fieldset">

                <legend>Personal details</legend>

                <div class="grid-x grid-margin-x">

                    <div class="cell small-12 medium-6">

                        <input-text
                                :group="props.group"
                                name="firstName"
                                id="first-name"
                                v-model="props.fields.firstName"
                                placeholder="First Name"
                                maxlength="20"
                                autocomplete="given-name"
                                focus
                        />

                    </div>

                    <div class="cell small-12 medium-6">

                        <input-text
                                :group="props.group"
                                name="lastName"
                                id="last-name"
                                v-model="props.fields.lastName"
                                placeholder="Family Name"
                                maxlength="20"
                                autocomplete="family-name"
                        />

                    </div>

                </div>

            </fieldset>

        </div>

    </form-wrapper>

@endsection

@push('footer-scripts')
    <script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
@endpush
