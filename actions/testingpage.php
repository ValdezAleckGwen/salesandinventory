<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<title></title>
</head>
<body>
<div id="hotdog">hotdog</div>
</body>
</html>
<script>
$(document).ready(function(){

	var error = '';
	$.ajax({
	url: "testing.php",
	method: "POST",
	
	success	: function (data) {
		error += data;
		$('#hotdog').html(error);

	}
	});

});
</script>