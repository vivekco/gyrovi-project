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
				<center style="color:rgb(238, 45, 55)"><h6 id="discount"></h6></center>
				<center style="color:rgba(57, 197, 22, 0.74)"><h6 id="new"></h6></center>
				<br />
				<input type="hidden" id="price" value="1000"/>
	            <center><input type="text" placeholder="Place Coupon Code Here" class="form-control col-md-3" id="codeValue"/></center><br>
                <center><a href="#" id = "applyCoupon" style="color:white;" class="btn bg-primary">Check Coupon Code</a></center>
			
            </div>
			
    </div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
<script type="text/javascript">
	 $("#applyCoupon" ).click(function( event ) {
      
	  let code = $('#codeValue').val();
      let price = $('#price').val();
	  var postData = "coupon_code=" + code + "&price=" + price; 
	  var uri = "https://coupon-code-gyrovi.herokuapp.com/api/apply-coupon";
      $.ajax({
        url: uri,
        method: "POST",
		data: postData,
        cache: false,
        dataType: 'json',
        beforeSend: function(){
        // Handle the beforeSend event
        },
        complete: function(){
        // Handle the complete event
        },
        success: function (data, textStatus, xhr) {
            if (xhr.status === 201) {
                let msg = data.data.status;
				let price = data.data.price;
				if(data.data.status == "Success"){
                let discountT = "";
		     	if(price.discount_type == "percentdiscount"){
                    discountT = " ("+price.discount_v+"% OFF)";
				 }
                  $("#discount").text("Discount: $"+price.discount+discountT);
				  $("#new").text("New Price: $"+(price.original_price-price.discount));
				} else {
                bootbox.alert({
                size: "small",
                title: "ALERT",
                message: msg 
                })
		        }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            let response = JSON.parse(jqXHR.responseText);
            let msg = response.message;
            bootbox.alert({
                size: "small",
                title: "ALERT",
                message: msg
            })
        }
    });
});
</script>
</body>

</html>