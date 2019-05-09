<?php
require_once 'PHPUnit/Autoload.php';
class MyProceduralTest extends \PHPUnit\Framework\TestCase {

    /*
     * Testing the upload video function
     */

    public function testAddition(){
        include('C:\xampp\htdocs\attendance\uploadtest.php'); 
        $result = video_upload("C:\Users\pcroot\Desktop\alper.mp4","alper");
        $this->assertEquals(true, $result);
    }
}
?>