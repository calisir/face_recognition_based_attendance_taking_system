<?php
require_once 'PHPUnit/Autoload.php';
class CorrectionTest extends \PHPUnit\Framework\TestCase {

    /*
     * Testing the upload video function
     */

    public function testCorrectionFunc(){
        include('C:\xampp\htdocs\attendance\correctiontest.php'); 
        $result = correctAttendance(101,3,0);
        $this->assertEquals(true, $result);
    }
}
?>