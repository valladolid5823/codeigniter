
<style>
	.close {
		position: absolute;
		top: -10px;
		right: 0px;
	}
</style>
<div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center">Create Payroll</h3>
				 <!-- Alert to display response -->
				 <div id="alert" class="alert mt-3 d-none" role="alert"></div>
                <form id="payrollForm" method="post">
                    <div class="mb-3">
                        <label for="sales_representative" class="form-label">Sales Representative</label>
                        <select class="form-select" id="sales_representative" name="sales_representative" required>
                            <option value="">Select</option>
                            <!-- Populate options dynamically from database or any other source -->
							 <?php foreach($profiles as $profile): ?>
								<option value="<?= $profile->id; ?>"><?= $profile->name; ?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row mb-3">
					<div class="col-6">
                        <label for="from_date" class="form-label">From Date</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" required>
                    </div>
                    <div class="col-6">
                        <label for="to_date" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" required>
                    </div>
					</div>
					<div class="mb-3">
                        <label for="bonus" class="form-label">Bonuses</label>
						<div class="input-group">
							<div class="input-group-text">$</div>
							<input type="number" class="form-control" id="bonus" name="bonus" required>
						</div>
					</div>
                    <div id="clients_container">
                    </div>
                   <div class="d-flex">
				   	<button	button type="button" class="btn btn-success" id="add_client_btn" onclick="addClient()">Add New Client</button>
					<button type="submit" class="btn btn-primary ms-3">Create Payroll</button>
				   </div>
                </form>
            </div>
        </div>
    </div>

    <script>
		let client_index = 0;
		function addClient() {
			let new_client_html = `
				<div id="client-row${client_index}"" class="position-relative">
					<div class="row mb-3">
						<div class="col-6">
							<label for="client_name_${client_index}" class="form-label">Client Name</label>
							<input type="text" class="form-control" id="client_name_${client_index}" name="client_name[]" required>
						</div>
						<div class="col-6">
							<label for="commission_${client_index}" class="form-label">Commission Received</label><div class="input-group">
							<div class="input-group-text">$</div>
								<input type="number" class="form-control" id="commission_${client_index}" name="client_commission[]" required>
							</div>
						</div>
					</div>
					<div class="close ${client_index == 0 ? 'd-none' : ''}">
						<button type="button" class="btn btn-danger" onclick="deleteClientRow(${client_index})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
						<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
						<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
						</svg></button>
					</div>
				</div>
			`;

			$('#clients_container').append(new_client_html);
			client_index++;
		}

		addClient();

        $(document).ready(function() {
            var client_index = 1;

            $('#payrollForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                $.ajax({
                    url: '<?= base_url('payroll/process') ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#alert').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
							addClient();
							let sales_rep_id = $('#sales_representative').val();
							console.log('sales_rep_id ', sales_rep_id)
							let baseUrl = "<?= base_url('payroll/payslip') ?>";
							let fullUrl = `${baseUrl}/${sales_rep_id}`;
							window.open(fullUrl, '_blank');
							$('#payrollForm')[0].reset(); // Reset form after successful submission
							$('#clients_container').empty();
                        } else {
                            $('#alert').removeClass('d-none alert-success').addClass('alert-danger').html(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        $('#alert').removeClass('d-none alert-success').addClass('alert-danger').text('Error occurred while processing request.');
                    }
                });
            });
        });

		function deleteClientRow(index) {
			$(`#client-row${index}`).remove();
		}
    </script>
