<?php
if(isset($_POST['submit'])){
	$file = $_FILES['file'];
	$studentid = $_GET['name'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type']; 

	$fileExtArray = explode('.', $fileName);
	$fileExt = strtolower(end($fileExtArray));

	$allowed = array('mov', 'mp4');

	if (in_array($fileExt, $allowed)){
		if ($fileError === 0){
			if ($fileSize < 150000000){
				$fileNameNew = $studentid.'.'.$fileExt;
				
				//$destination = '/home/senior/Desktop/senior/videos/'.$fileNameNew;
				$destination = 'C:/xampp/htdocs/attendance/videos/'.$fileNameNew;

				move_uploaded_file($fileTmpName, $destination);
				header("Location: success.php");				
			} else {
				echo "The file is too big!";
			}
		} else {
			echo "There was an error uploading your file!";
		}
	} else {
		echo "You cannot upload files of this type!";
	}

}
?>
