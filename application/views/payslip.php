<div class="container my-5" id="pageprint">
	<div class="row justify-content-center">
		<div class="col-md-11">
			<div class="d-flex justify-content-between align-items-end">
				<div>
				<img width="200" src="<?= base_url('assets/commissionease-logo-blue.png') ?>" alt="logo">
				</div>
				<div>
				<h3>Payslip</h3>
				</div>
			</div>
			<div class="d-flex justify-content-between py-1 px-2 mt-5" style="background: #cdcdcd">
				<div class="d-flex">
					<div><b>Sales Representative No:</b> <?php echo str_pad(intVal($payroll[0]['sales_rep_id']),4,"0",STR_PAD_LEFT) ?></div>
					<div class="ms-3"><?= $payroll[0]['name'] ?></div>
				</div>
				<div>
				 	<?= $payroll[0]['from_date'] ?> - <?= $payroll[0]['to_date'] ?>
				</div>
			</div>
			<div class="d-flex justify-content-between mt-5">
				<div>
					<div><b>Produced on:</b></div>
					<div class="ms-3">
						<div><?= $current_date_time; ?></div>
						<div><?= $payroll[0]['name'] ?></div>
						<div>543 Meda Street Atom, AnyCity</div>
					</div>
				</div>
				<div>
					<div><b>Produced by:</b></div>
					<div class="ms-3">
						<div>CommissionEase</div>
						<div>123 Elm Street
						Springfield, Anytown</div>
						<div>www.commissionease.com</div>
					</div>
				</div>
				<div>
					<div><b>Statement Week:</b> <?php
						$date=date_create($payroll[0]['to_date']);
						echo date_format($date,"Ym");
					
					?></div>
					<div><b>Statement Date:</b> <?php
						$date=date_create($payroll[0]['to_date']);
						echo date_format($date,"Y-m-d");
					
					?></div>
					<div><b>Payment Type:</b> Debit Card</div>
				</div>
			</div>
			<hr>
			<div class="mt-4">
				<div class="mb-3 d-flex justify-content-between py-1 px-2" style="background: #cdcdcd">
					<h5 style="margin: 0">Commission Details</h5>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Client Name</th>
							<th>Commission Received</th>
							<th>Tax on Commission</th>
							<th>Sales Representative's Commission</th>
							<th>Net Commission to Sales Representative</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($commission_details as $comm): ?>
						<tr>
							<td><?= $comm['client_name'] ?></td>
							<td>$<?= $comm['commission_received'] ?></td>
							<td>$<?= $comm['tax_on_commission'] ?></td>
							<td>$<?= $comm['sales_commision'] ?></td>
							<td>$<?= $comm['net_sales_commision'] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				<table class="table table-bordered mt-2" style="width: 300px">
					<thead>
						<tr>
							<th>Bonuses</th>
							<th>Total Earnings</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>$<?= $payroll[0]['bonus']; ?></td>
							<td>$<?= $total_earnings; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	function generatePDF() {

        const element = document.getElementById("pageprint");
        html2pdf().set({
            margin: [0, 0, 0, 0],
            filename: "CommissionEase Payslip for <?= $payroll[0]['name']; ?>",
            html2canvas: { scale: 1, scrollY: 0 },
            jsPDF: { unit: 'pt', format: 'letter', orientation: 'portrait' }
        }).from(element).toPdf().get('pdf').then(function (pdf) {
            var totalPages = pdf.internal.getNumberOfPages();

			for (var i = 1; i <= totalPages; i++) {
                pdf.setPage(i);
                pdf.text(" ", 20, 20); // Padding Top
                pdf.text(" ", 20, pdf.internal.pageSize.getHeight() - 20); // Padding Bottom
            }
        }).save().then(() => {
        });
    }

    function downloadCode(){
        generatePDF();
    }
	downloadCode();
</script>
