    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

		<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap4.js"></script>

		<script>
			$(document).ready( function () {
					$('#employee-table').DataTable();
			} );

			$('.alert').alert();
		</script>

		<script>
			$(document).ready(function () {
				$('.confirm-delete').click(function (e) { 
					e.preventDefault();
					
					confirmDialog = confirm('Are you sure you want to delete this data?');

					if (confirmDialog) {
						let id = $(this).val();

						$.ajax({
							type: "DELETE",
							url: "/employee/confirmdelete/"+id,
							success: function (response) {
								alert('Data deleted successfully!');
								window.location.reload();
							}
						});
					}
				});
			})
		</script>
  </body>
</html>
