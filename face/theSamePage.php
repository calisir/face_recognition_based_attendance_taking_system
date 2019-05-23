<?php
    //echo exec("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok1.py -f C:/xampp/htdocs/face/videos/cng492 -o C:/xampp/htdocs/face/videos/cng492dataset");
    //echo exec("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok2.py --dataset C:/xampp/htdocs/face/videos/cng492dataset --encodings C:/xampp/htdocs/face/videos/cng492model/cng492");
    echo shell_exec("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok0.py -i C:/xampp/htdocs/face/videos/cng492dataset/alper/301810_alper.jpg -e C:/xampp/htdocs/face/videos/cng492model/eleven");
    //echo shell_exec("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok3.py --image C:/xampp/htdocs/face/videos/demo.png");


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