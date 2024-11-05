<!--start footer-->
<footer class="page-footer">
  <p class="mb-0">© Dmc - <script>document.write(new Date().getFullYear())</script> Proudly Crafted By Coactive IT Solutions Private Limited.</p>
</footer>
@section('scripts') 
  	<script src="{{ URL::asset('build/plugins/validation/jquery.validate.min.js') }}"></script>
	<script src="{{ URL::asset('build/plugins/validation/validation-script.js') }}"></script>
	
	<script>
			(function () {
			  'use strict'
			  var forms = document.querySelectorAll('.needs-validation')
			  Array.prototype.slice.call(forms)
				.forEach(function (form) {
				  form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
					  event.preventDefault()
					  event.stopPropagation()
					}
					form.classList.add('was-validated')
				  }, false)
				})
			})()
	</script>
@endsection