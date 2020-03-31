	<!DOCTYPE html>
	<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="jquery.cookie.js"></script>


	<script>
	$(document).ready(function(){

		
user_id= $.cookie("user_id");


if(user_id===undefined)
{
	window.location.href="index.php";
}
		
    is_user=<?php  if(isset($_GET["is_user"])){ echo $_GET["is_user"];}else{echo 0;}; ?>;

	$.ajax({
	url: 'getUserDropdownDetails.php',
	type: 'post',
	success: function(response){
	response = JSON.parse(response);
	total_select=response.length
	var row="<option>Select User Name</option>";
	for(i=0;i<total_select;i++){

	j=i+1;

	row=row+'<option value="'+response[i].id+'">'+response[i].username+'</option>';

	}

	$("#username").html(row)

	}


	});


	$("#unitcost").change(function(){
		unitcost=$("#unitcost").val()
		quantity=$("#quantity").val()
		total=unitcost*quantity;
		$("#total").val(total)
	})
	$("#quantity").change(function(){
		unitcost=$("#unitcost").val()
		quantity=$("#quantity").val()
		total=unitcost*quantity;
		$("#total").val(total)
	})


$(".save_details").click(function(){

	user_id=$("#username").val().trim();
	unitcost=$("#unitcost").val().trim();
	quantity=$("#quantity").val().trim();
	total=$("#total").val().trim();
	

	user_id_length=user_id.length
	unitcost_length=unitcost.length
	quantity_length=quantity.length
	total_length=total.length

	if(user_id== "" || user_id_length==0)
	{
	alert("please select username")
	return false
	}
	if(unitcost== "" || unitcost_length==0)
	{
	alert("please unitcost password")
	return false
	}
	if(quantity== "" || quantity_length==0)
	{
	alert("please quantity password")
	return false
	}if(total== "" || total_length==0)
	{
	alert("Total should not be zero")
	return false
	}
	
	
	$.ajax({
	url: 'save_logistics_details.php',
	type: 'post',
	data: "user_id=" + user_id + "&unitcost="+ unitcost+ "&quantity="+ quantity+ "&total="+ total,
	success: function(response){
	response = JSON.parse(response);

	if(response.success!=0 || response.success!="")
	{
	alert("Logistics details saved successfully!!")

	if(is_user==1)
	{
	window.location.href="getLogisticInfoBasedOnUser.php";
	}else if(is_user==2)
	{
	window.location.href="get_all_logistics_details.php";
	}else{
	window.location.href="dashboard.php";
	}

	}else{
	alert("Invalid username and password")
	location.reload()
	}

	}
	});


	});

	});
	</script>
	</head>
	<body>
	<div class="container">

<p>&nbsp;</p>
	<div class="row">
	<div class="col-md-6 col-md-offset-4"><h4>Add logistics Info</h4></div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div class="col-md-6 col-md-offset-3">
	
	<div class="row">
	<div class="col-sm-2" >
	<label for="username">User Name</label>
	</div>
	<div class="col-sm-10">
	<div class="form-group">
	<select id="username">
		
		
	</select>

	</div>
	</div>

	</div>
	<div class="row">
	<div class="col-sm-2" >
	<label for="unitcost">Unit Cost</label>
	</div>
	<div class="col-sm-5">
	<div class="form-group ">
	<input class="form-control" type="number" id="unitcost" placeholder="Enter unit cost" >

	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-2" >
	<label for="quantity">Quantity.</label>
	</div>
	<div class="col-sm-5">
	<div class="form-group ">
	<input class="form-control" type="number" id="quantity" placeholder="Enter quantity">
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-2" >
	<label for="email">Total</label>
	</div>
	<div class="col-sm-5">
	<div class="form-group ">
	<input class="form-control" id="total" placeholder="Enter email" id="total" type="text" disabled>

	</div>
	</div>
	</div>

	<div class="row">
	<div class="col-sm-2" >

	</div>
	<div class="col-sm-5">
	<div class="form-group ">
	<button class="btn btn-success save_details" type="Submit">save</button>


	</div>
	</div>
	</div>
	
	</div>
	</div> 
	</div>
	</body>
	</html>