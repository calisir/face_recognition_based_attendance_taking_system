<?php
    // Train kısmı
    ini_set('max_execution_time', 30000000000);
    if(isset($_POST["selCourse"])){
        $course = $_POST["selCourse"];
        echo exec("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok1.py -f C:/xampp/htdocs/face/videos/courses/$course -o C:/xampp/htdocs/face/videos/dataset/$course");
        echo exec("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok2.py --dataset C:/xampp/htdocs/face/videos/dataset/$course --encodings C:/xampp/htdocs/face/videos/models/$course");
    }
    header("location: instructor.php");

    // Detection kısmı
    //echo shell_exec("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok0.py -i C:/xampp/htdocs/face/videos/cng492dataset/alper/301810_alper.jpg -e C:/xampp/htdocs/face/videos/cng492model/eleven");
    //echo shell_exec("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok0.py -i C:/xampp/htdocs/face/videos/raspberrydengelecek.jpg -e C:/xampp/htdocs/face/videos/models/dersadi");



            // if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
            // {
            //     func();
            // }
            // function func()
            // {
            //    echo shell_exec("python /opt/lampp/htdocs/attendance/a.py");
            // }


        // function trainAll()
        // {
        //     #ok2 : python ok2.py --dataset /opt/lampp/htdocs/attendance/videos/cng492dataset/ --encodings /opt/lampp/htdocs/attendance/videos/cng492model/cng492

        //     $output1 = shell_exec('python /opt/lampp/htdocs/attendance/videos/ok1.py -f /opt/lampp/htdocs/attendance/videos/cng492 -o /opt/lampp/htdocs/attendance/videos/cng492dataset/');
        //     //$output2 = shell_exec('python ok2.py --dataset /opt/lampp/htdocs/attendance/videos/cng492dataset/ --encodings /opt/lampp/htdocs/attendance/videos/cng492model/cng492');
        //     echo "All students have been trained."; 
        // }

        // if(array_key_exists('test',$_POST)){
        // testfun();
        // }

        ?>