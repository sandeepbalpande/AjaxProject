	<!DOCTYPE html>
	<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="jquery.cookie.js"></script>


	<script>
	$(document).ready(function(){
	$(".login_details").click(function(){
	var username=	$("#username").val().trim();
	var password=	$("#password").val().trim();

	username_length=username.length
	password_length=password.length

	if(username== "" || username_length==0)
	{
	alert("please enter User Name")
	return false
	}
	if(password== "" || password_length==0)
	{
	alert("please enter Password")
	return false
	}
	$.ajax({
	url: 'login.php',
	type: 'post',
	data: "username=" + username + "&password="+ password,
	success: function(response){
	response = JSON.parse(response);

	if(response.success!=0 || response.success!="")
	{
	$.cookie("user_id", response.success[0].id);
	window.location.href="dashboard.php"
	}else{
	alert("Invalid username and password")
	location.reload()
	}



	}
	});

	});




	$(".save_details").click(function(){

	username=$("#username").val().trim();
	password=$("#password").val().trim();
	mobile=$("#mobile").val().trim();
	email=$("#email").val().trim();
	address=$("#address").val().trim();

   
	username_length=username.length
	mobile="91"+mobile;
	mobile_length=mobile.length
	
	
	password_length=password.length
	email_length=email.length
	address_length=address.length

	if(username== "" || username_length==0)
	{
	alert("please enter username")
	return false
	}
	if(password== "" || password_length==0)
	{
	alert("please enter password")
	return false
	}
	
	

	if(mobile ==''){
	alert("Please enter mobile number")
	$("#mobile").val("")
	//   location.reload();
	return false;
	}
	else if(mobile_length != 12)
	{
	alert("Please enter 10 digits mobile number")
	$("#mobile").val("")
	//location.reload();
	return false;
	}

	else if(!$.isNumeric($('#mobile').val())) {
	alert("Mobile number should be numbers only")
	$("#mobile").val("")
	//  location.reload();
	return false;
	}


	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	valid_email= emailReg.test(email);

	if(valid_email==false){

	alert("Please enter valid email id")
	$("#email").val("")

	return
	}
	if(email=="" || email_length==0){

	alert("Please enter email id")
	$("#email").val("")
	return

	}
	if(address== "" || address_length==0)
	{
	alert("please enter address")
	return false
	}


	$.ajax({
	url: 'save_user_details.php',
	type: 'post',
	data: "username=" + username + "&password="+ password+ "&mobile="+ mobile+ "&email="+ email+ "&address="+ address,
	success: function(response){
	response = JSON.parse(response);

	if(response.success!=0 || response.success!="")
	{
	alert("User Details saved successfully!!")
	window.location.href="index.php"
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
	<div class="col-md-6 col-md-offset-4"><h4>Add User Details</h4></div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div class="col-md-6 col-md-offset-3">
	
	<div class="row">
	<div class="col-sm-2" >
	<label for="username">User Name</label>
	</div>
	<div class="col-sm-5">
	<div class="form-group ">
	<input class="form-control" id="username" placeholder="Enter employee Name" id="username" type="text">

	</div>
	</div>

	</div>
	<div class="row">
	<div class="col-sm-2" >
	<label for="password">Password</label>
	</div>
	<div class="col-sm-5">
	<div class="form-group ">
	<input class="form-control" type="password" id="password" placeholder="Enter Password" >

	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-2" >
	<label for="mobile">Mobile No.</label>
	</div>
	<div class="col-sm-5">
	<div class="form-group ">
	<input class="form-control" type="tel" id="mobile" placeholder="Enter mobile No." maxlength="10" id="mobile" type="number">

	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-2" >
	<label for="email">Email</label>
	</div>
	<div class="col-sm-5">
	<div class="form-group ">
	<input class="form-control" id="email" placeholder="Enter email" id="email" type="text">

	</div>
	</div>
	</div>

	
	<div class="row">
	<div class="col-sm-2" >
	<label for="address">Address</label>
	</div>
	<div class="col-sm-5">
	<div class="form-group ">
	<textarea id="address" rows="4" cols="54"  id="address" placeholder="Enter address"></textarea>

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