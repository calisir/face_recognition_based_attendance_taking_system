<?php

include('session.php');

if(isset($_POST['submit'])){
	$file = $_FILES['file'];
	$studentid = $LOGGED_USER;

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

				$servername = "127.0.0.1:3307";
                $username = "root";
                $password = "";
				$dbname = "attendance";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
				}
				
                $sql = "SELECT course FROM enrolled WHERE student = $studentid;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
						//$destination = '/home/senior/Desktop/senior/videos/'.$fileNameNew;
						$destFolder = 'C:/xampp/htdocs/face/videos/courses/'.$row["course"];
						$destination = 'C:/xampp/htdocs/face/videos/courses/'.$row["course"].'/'.$fileNameNew;

						if (!file_exists($destFolder)) {
							mkdir($destFolder, 0777, true);
						}

						copy($fileTmpName, $destination);
						//move_uploaded_file($fileTmpName, $destination);
					}
				}

				$sql = "UPDATE student SET videoStatus=1 WHERE id = $studentid;";
                $result = $conn->query($sql);

				$conn->close(); // Closing Connection

				
				header("location: success.php");				
			} else {
				echo "The file is too big!";
				header("location: index.php");					
			}
		} else {
			echo "There was an error uploading your file!";
			header("location: index.php");	
		}
	} else {
		echo "You cannot upload files of this type!";
		header("location: index.php");	
	}
}
?>
