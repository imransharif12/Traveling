@extends('template')
@section('main')
<div class="container mb-4 margin-top-85 min-height">
    <div class="d-flex justify-content-center">
        <div class="p-5 mt-5 mb-5 border w-450">
            <div class="alert alert-success text-center mb-0 d-none" role="alert" id="alert">
                Thanks for your responce
                <a href="#" class="pull-right float-right" data-dismiss="alert">×</a>
            </div>


            <form id="contact_form" method="post" action="javascript:;" accept-charset='UTF-8'>
                {{ csrf_field() }}
                <div class="form-group col-sm-12 p-0">
                    <label for="first_name">{{ trans('messages.login.name') }} <span
                            class="text-13 text-danger">*</span></label>
                    <input type="text" class="form-control text-14" value="" name="name"
                        placeholder="{{trans('messages.login.name')}}">
                </div>



                <div class="form-group col-sm-12 p-0">
                    <label for="first_name">{{ trans('messages.login.email') }} <span
                            class="text-13 text-danger">*</span></label>
                    @if ($errors->has('email'))
                    <p class="error">{{ $errors->first('email') }}</p>
                    @endif
                    <input type="email" class="form-control text-14" value="{{ old('email') }}" name="email"
                        placeholder="{{trans('messages.contact.email')}}">
                </div>



                <div class="form-group col-sm-12 p-0">
                    <label for="first_name">{{ trans('messages.contact.message') }} <span
                            class="text-13 text-danger">*</span></label>

                    <textarea type="textarea" class="form-control text-14" value="{{ old('email') }}" name="message"
                        placeholder="{{trans('messages.contact.message')}}"></textarea>
                </div>


                <div style="margin-top:10px">
                    <div style="transform: scale(0.99);" class="g-recaptcha"
                        data-sitekey="{{config('global.SITEKEY')}}">
                    </div>
                </div>
                <br>




                <div class="form-group col-sm-12 p-0">
                    <button type='submit' id="btn"
                        class="btn pb-3 pt-3  button-reactangular text-15 vbtn-success w-100 rounded"> <i
                            class="spinner fa fa-spinner fa-spin d-none"></i>
                        <span id="btn_next-text">{{trans('messages.contact.submit')}}</span>
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
@stop

@section('validation_script')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript">
    $('#contact_form').on('submit', function (e) {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            //reCaptcha not verified
            alert("Please verify you are human");
            return false;
            evt.preventDefault()

        }
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('contact_us.store') }}",
            data: $(this).serialize(),
            success: function (data) {
                if (data.code == 200) {
                    $("#contact_form")[0].reset();
                    $('.alert-success').removeClass('d-none');
					grecaptcha.reset();
                }
            }
        });
    });

    function saveData(data) {
        var sortingValue = data;
        $.ajax({
            url: "webshop",
            type: 'GET',
            data: {
                sortingValue: sortingValue
            },
            dataType: 'html',
            success: function (data) {
                $('#dataAppned').empty("");
                $('#dataAppned').html(data);
                $(".bgPink").hide();
            },
            failure: function (err) {
                alert(err)
            }
        });
    }
    $(document).ready(function () {
        $('#login_form').validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 255,
                    laxEmail: true
                },

                password: {
                    required: true
                }
            },
            submitHandler: function (form) {
                $("#btn").on("click", function (e) {
                    $("#btn").attr("disabled", true);
                    e.preventDefault();
                });


                $(".spinner").removeClass('d-none');
                $("#btn_next-text").text("{{trans('messages.login.login')}}..");
                return true;
            },
            messages: {
                email: {
                    required: "{{ __('messages.jquery_validation.required') }}",
                    maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
                },

                password: {
                    required: "{{ __('messages.jquery_validation.required') }}",
                }
            }
        });
    });

</script>
@endsection
