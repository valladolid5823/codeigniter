
<div class="container my-5">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5>
							Update Employee
							<a href="<?php echo base_url('employee') ?>" class="btn btn-danger float-right" >Back</a>
						</h5>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('employee/update/'. $employee->id) ?>" method="POST">
							<div class="form-group">
								<label for="">First Name</label>
								<input type="text" name="first_name" value="<?php echo $employee->first_name; ?>" class="form-control">
								<small class="text-danger" ><?php echo form_error('first_name'); ?></small>
							</div>

							<div class="form-group">
								<label for="">Last Name</label>
								<input type="text" name="last_name" value="<?php echo $employee->last_name; ?>"  class="form-control">
								<small class="text-danger" ><?php echo form_error('last_name'); ?></small>
							</div>

							<div class="form-group">
								<label for="">Phone Number</label>
								<input type="text" name="phone" value="<?php echo $employee->phone; ?>" class="form-control">
								<small class="text-danger" ><?php echo form_error('phone'); ?></small>
							</div>

							<div class="form-group">
								<label for="">Email Address</label>
								<input type="text" name="email" value="<?php echo $employee->email; ?>" class="form-control">
								<small class="text-danger" ><?php echo form_error('email'); ?></small>
							</div>

							<div class="form-group">
								
								<button class="btn btn-primary" type="submit">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

