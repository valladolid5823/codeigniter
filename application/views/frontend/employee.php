
    <div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<?php if ($this->session->flashdata('status')) : ?>
						<!-- <div class="alert alert-success"><?= $this->session->flashdata('status') ?></div> -->

						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('status') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php endif; ?>
						<h5>
							Employee Data
							<a href="<?php echo base_url('employee/add') ?>" class="btn btn-primary float-right" >Add Employee</a>
						</h5>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Phone Number</th>
									<th>Email Address</th>
									<th>Edit</th>
									<th>Delete</th>
									<th>Cofirm Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($employees as $employee) : ?>
								<tr>
									<td><?= $employee->id; ?></td>
									<td><?= $employee->first_name; ?></td>
									<td><?= $employee->last_name; ?></td>
									<td><?= $employee->phone; ?></td>
									<td><?= $employee->email; ?></td>
									<td><a href="<?php echo base_url('employee/edit/'. $employee->id) ?>" class="btn btm-sm btn-success" >Edit</a></td>
									<td><a href="<?php echo base_url('employee/delete/'. $employee->id) ?>" class="btn btm-sm btn-danger" >Delete</a></td>
									<td><button type="button" class="btn btm-sm btn-danger confirm-delete" value="<?php echo $employee->id ?>">Confirm Delete</button></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

