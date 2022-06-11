<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="https://coupon-code-gyrovi.herokuapp.com">Gyrovi App</a>
		</div>
	</nav>
    <div class="col-md-12">
	
		<h3 class="text-primary">Shop With Us!</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<br />
		<br />
			<div class="col-md-12" style="border:1px solid #ccc; padding:10px; margin:23px;">
				<center><img src="https://cdn.sastodeal.com/catalog/product/8/1/81ulnpn3zpl._ac_sl1500__1__1_1_1.jpg" width="15%"/></center>
				<center><h5>Phone For Sale</h5></center>
				<center><h5>&#36;1000</h5></center>
				<br />
	            <center><input type="text" placeholder="Place Coupon Code Here" class="form-control col-md-3" id="codeValue"/></center><br>
                <center><a href="#" style="color:white;" class="btn bg-primary">Check Coupon Code</a></center>
			
            </div>
			
    </div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#generate').on('click', function(){
			$.get("get_coupon.php", function(data){
				$('#coupon').val(data);
			});
		});
	});
</script>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>