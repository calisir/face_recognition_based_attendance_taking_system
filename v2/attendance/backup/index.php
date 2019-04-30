<!DOCTYPE html>
<html>
<head>
	<title>ODTUclass | Video Upload</title>
</head>
<body>
	<form action="upload.php?name=<?php echo $_GET["name"] ?>" method="POST" enctype="multipart/form-data">
		<?php echo "Hello ".$_GET["name"]; ?><br>
		Please select video: <input type="file" name="file"><br>
		<button type="submit" name="submit">UPLOAD</button>
	</form>
</body>
</html>
