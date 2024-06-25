
<div class="container my-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<h3 class="text-center">Create Sales Representative Profile</h3>
			<div id="alert" class="alert mt-3 d-none"></div>
			<form id="salesRepForm">
				<div class="mb-3">
					<label for="name" class="form-label">Name</label>
					<input type="text" class="form-control" id="name" name="name" required>
				</div>
				<div class="mb-3">
					<label for="commission_percentage" class="form-label">Commission Percentage</label>
					<input type="number" class="form-control" id="commission_percentage" name="commission_percentage" required min="0" max="100">
				</div>
				<div class="mb-3">
					<label for="tax_rate" class="form-label">Tax Rate</label>
					<input type="number" class="form-control" id="tax_rate" name="tax_rate" required min="0" max="100">
				</div>
				<div class="mb-3">
					<label for="bonuses" class="form-label">Bonuses</label>
					<div class="input-group">
						<div class="input-group-text">$</div>
						<input type="number" class="form-control" id="bonuses" name="bonuses" required>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Create Profile</button>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#salesRepForm').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= base_url('salesrep/save') ?>',
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(response) {
					if (response.status == 'success') {
						$('#alert').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
						$('#salesRepForm')[0].reset();
					} else {
						$('#alert').removeClass('d-none alert-success').addClass('alert-danger').html(response.message);
					}
				}
			});
		});
	});
</script>
