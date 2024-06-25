
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="d-flex justify-content-center">
				<img width="357" src="<?= base_url('assets/commissionease-logo-blue.png') ?>" alt="logo">
			</div>
			<h5 class="mt-5">Login to your Account</h5>
			<form id="loginForm">
				<div class="mb-3">
					<label for="username" class="form-label">Username</label>
					<input value="admin" type="text" class="form-control" id="username" name="username" required>
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<input value="password" type="password" class="form-control" id="password" name="password" required>
				</div>
				<button type="submit" class="btn btn-primary w-100">Login</button>
			</form>
			<div id="alert" class="alert mt-3 d-none"></div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#loginForm').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= base_url('login') ?>',
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(response) {
					if (response.status == 'success') {
						alert(response.message)
						// window.location.href = 'dashboard'; // Redirect to dashboard or another page
					} else {
						$('#alert').removeClass('d-none').addClass('alert-danger').text(response.message);
					}
				}
			});
		});
	});
</script>
