<?php

            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
            {
                func();
            }
            function func()
            {
               echo shell_exec("python /opt/lampp/htdocs/attendance/a.py");
            }


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