<?php
	include("../server/connection.php");
	include '../set.php';
	$sql = "SELECT * FROM sales,sales_product,customer WHERE sales.reciept_no = sales_product.reciept_no AND sales.customer_id=customer.customer_id	";
	$result = mysqli_query($db,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php 
			include('../sales/base.php');
		?>
		<div>
			<div>
				<h1 class="ml-4 pt-2" align="left">Sales Records</h1>
			</div>
			<div class="table-responsive pl-5 pr-5">
			<table class="table table-striped" id="sales_table" style="margin-top: -22px;">
				<thead class="bg-info">
					<tr>
						<th scope="col" class="column-text">Receipt No.</th>
						<th scope="col" class="column-text">Username</th>
						<th scope="col" class="column-text">Customer Name</th>
						<th scope="col" class="column-text">Total</th>
						<th scope="col" class="column-text">Date</th>
						<th scope="col" class="column-text">Action</th>
					</tr>
				</thead>
					<?php 
						while($row = mysqli_fetch_array($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['reciept_no'];?></td>
						<td><?php echo $row['username'];?></td>
						<td><?php echo $row['firstname'].'&nbsp'.$row['lastname'];?></td>
						<td>₱<?php echo $row['price'];?></td>
						<td><?php echo $row['date'];?></td>
						<td>
							<a name="Details" title="Details" style='font-size:10px; border-radius:5px;padding:4px;' href="reciept_details.php?id=<?php echo $row['reciept_no'];?>" class="btn btn-info btn-xs">Details</a>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
	<script src="../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#sales_table').dataTable();
			
		});
	</script>
</body>
</html>
<script>
	$(function () {
  		$('[data-toggle="popover"]').popover()
	});
	$(document).ready(function(){
	/* function for activating modal to show data when click using ajax */
	$(document).on('click', '.view_data', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view_cashflow.php",  
				method:"POST",  
				data:{id:id},  
				success:function(data){  
					$('#Contact_Details').html(data);  
					$('#dataModal').modal('show');  
				}  
			});  
		}            
	});   
 });  

</script>