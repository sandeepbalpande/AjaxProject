
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="jquery.cookie.js"></script>

<script>

$(document).ready(function(){


user_id= $.cookie("user_id");


if(user_id===undefined)
{
	window.location.href="index.php";
}


$.ajax({
url: 'viwe_all_logistics_info_details.php',
type: 'post',
success: function(response){
response = JSON.parse(response);

total_data=response.length
var row="";
var allowed="";
is_allowed=response[0].is_allowed;

if(is_allowed==1)
{
allowed=allowed+'<a href="dashboard.php?is_user=2" class="btn btn-primary pull-center">View Users List</a><a href="add_logistics_details.php?is_user=2" class="btn btn-primary pull-right">Add Logistic</a>';
}else if(is_allowed==0){
allowed=allowed+'<a href="" class="btn btn-primary pull-right" onclick="abc()">Not Alloed to Add Logistic</a>';
}

for(i=0;i<total_data;i++){

j=i+1;


row=row+'<tr><td>'+j+'</td><td>'+response[i].username+'</td><td>'+response[i].unitcost+'</td><td>'+response[i].qunatity+'</td><td>'+response[i].total_amount+'</td><td><input type="button" onclick="update_logistics('+response[i].id+')" style="background-color:lightgreen" value="update"></td><td><input type="button" onclick="delete_logistics('+response[i].id+')" style="background-color:red" value="Delete"></td></tr>';

}



$(".logistics_details").html(row);
$(".allowed").html(allowed);

}
});

$(".logout").click(function(){
$.removeCookie('user_id');

window.location.href="index.php";


});

});

</script>
<script>
	function abc()
	{
		alert("Admin is not given permission to add logistics")
	}

	function update_logistics(id)
	{
            window.location.href="update_logistics_info.php?id="+id+"&is_user="+2;
	}
	function delete_logistics(id)
	{
	var is_delete=confirm("Do you want to delete logistics info")
	if(is_delete)
	{
	$.ajax({
	url: 'delete_logistics_details.php',
	type: 'post',
	data: "id=" + id,
	success: function(response){

	alert("logistics details deleted successfully")
	location.reload();

	}
	});
	}


}
</script>

</head>
<body>

<div class="container">
<p>&nbsp;</p>

<div class="pull-right">
<button class="btn btn-danger logout" href="">Log Out</button> 
</div>
<p>&nbsp;</p>
<h2>Logistics Details</h2> 
<a class="allowed"></a>
<p>&nbsp;</p>


<table class="table">
<thead>
<tr>
<th>Sno.</th>
<th>User Name</th>
<th>Unit Cost</th>
<th>Quantity</th>
<th>Total</th>
<th colspan="2">Action</th>
</tr>
</thead>
<tbody class="logistics_details">

</tbody>
</table>
</div>

</body>
</html>
<?php


?>