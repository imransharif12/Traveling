@extends('template')
@section('main')
<div class="container mb-4 margin-top-85 min-height">
	<div class="d-flex justify-content-center">
		<div class="p-5 mt-5 mb-5 border w-450" >
			@if(Session::has('message'))
				<div class="row mt-3">
					<div class="col-md-12 p-2 text-center text-14 alert {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
						<a href="#"  class="close text-18" data-dismiss="alert" aria-label="close">&times;</a>
						{{ Session::get('message') }}
					</div>
				</div>
			@endif
               
			<form id="contact_form" method="post" action="javascript:;"  accept-charset='UTF-8'>
				{{ csrf_field() }}
                <div class="form-group col-sm-12 p-0">
                    <label for="first_name">{{ trans('messages.login.name') }} <span class="text-13 text-danger">*</span></label>
					<input type="text" class="form-control text-14" value="" name="name" placeholder = "{{trans('messages.login.name')}}">
				</div>



				<div class="form-group col-sm-12 p-0">
                    <label for="first_name">{{ trans('messages.login.email') }} <span class="text-13 text-danger">*</span></label>
					@if ($errors->has('email'))
						<p class="error">{{ $errors->first('email') }}</p>
					@endif
					<input type="email" class="form-control text-14" value="{{ old('email') }}" name="email" placeholder = "{{trans('messages.contact.email')}}">
				</div>


                
                <div class="form-group col-sm-12 p-0">
                    <label for="first_name">{{ trans('messages.contact.message') }} <span class="text-13 text-danger">*</span></label>

					<textarea type="textarea" class="form-control text-14" value="{{ old('email') }}" name="message" placeholder = "{{trans('messages.contact.message')}}"></textarea>
				</div>


				<div class="form-group col-sm-12 p-0" >
					<button type='submit' id="btn" class="btn pb-3 pt-3  button-reactangular text-15 vbtn-success w-100 rounded"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
							<span id="btn_next-text">{{trans('messages.contact.submit')}}</span>
					</button>
				</div>
			</form>

		
		</div>
	</div>
</div>
@stop

@section('validation_script')
<script type="text/javascript">
$('#contact_form').on('submit', function(e) {
    e.preventDefault(); 
    $.ajax({
        type: "POST",
        url:"{{ route('contact_us.store') }}",
        data: $(this).serialize(),
        success: function(data) {
        if(data.code==200){
            $("#contact_form")[0].reset();
            alert("Record Submit Succefully")
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
		submitHandler: function(form)
        {
 			$("#btn").on("click", function (e)
            {
            	$("#btn").attr("disabled", true);
                e.preventDefault();
            });


            $(".spinner").removeClass('d-none');
            $("#btn_next-text").text("{{trans('messages.login.login')}}..");
            return true;
        },
		messages: {
			email: {
				required:  "{{ __('messages.jquery_validation.required') }}",
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
