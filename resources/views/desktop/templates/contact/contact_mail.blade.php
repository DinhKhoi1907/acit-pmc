@extends('desktop.master')





@section('element_detail','main_page_detail fix_detail_menu')

@section('element_menu','shadow-shadow1')



@section('page_detail','page_detail')



@section('banner')

    @include('desktop.layouts.banner')

@endsection



@section('content')



<div class="pt-0 pb-0 md:pb-20" id="frm-contact">

    @include('desktop.templates.contact.contact')

</div>



@endsection



<!--css thêm cho mỗi trang-->

@push('css_page')

    {{-- <link href="{{asset('css/contact.css')}}" rel="stylesheet"> --}}

@endpush



<!--js thêm cho mỗi trang-->

@push('js_page')

<script src="https://www.google.com/recaptcha/api.js?render={{ config('recapcha.site_key_google') }}"></script>

<script>

    function submitContactForm() {

        window.grecaptcha.ready(function () {



            var $formContact = $('form[id="frm_contact"]');



            if ($formContact.length) {

                $formContact.submit(function (e) {

                    e.preventDefault();



                    var action = 'contact/submit';



                    window.grecaptcha.execute(SITE_KEY_GOOGLE, {action: action}).then(function (token) {

                        var $recaptchaAction = $('#recaptcha_action');

                        var $recaptchaToken = $('#recaptcha_token');



                        if ($recaptchaAction.length) {

                            $recaptchaAction.val(action);

                        } else {

                            $formContact.append('<input type="hidden" name="recaptcha_action" id="recaptcha_action" value="' + action + '" />');

                        }

                        if ($recaptchaToken.length) {

                            $recaptchaToken.val(token);

                        } else {

                            $formContact.append('<input type="hidden" name="recaptcha_token" id="recaptcha_token" value="' + token + '" />');

                        }



                        $formContact.unbind('submit');//.submit();

                    });

                });

            } // End if

        })

    }

    $(document).ready(function () {

        submitContactForm();

    });

</script>

@endpush





@push('strucdata')

    @include('desktop.layouts.strucdata')

@endpush
