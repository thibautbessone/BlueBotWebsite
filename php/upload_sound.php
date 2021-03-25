<?php
/**
 * Author: Blue
 * Version : 0.2
 */

session_start();

$name =  filter_var($_POST['desired_name'], FILTER_SANITIZE_STRING);
$serverId = filter_var($_POST['server_id'], FILTER_SANITIZE_NUMBER_INT);
$MAX_SIZE = 500000; //Max size of the file
$MAX_FILE_NUMBER = 76;//Max number of sounds per server +1 cause scandir is done before the actual upload
if(isset($_SESSION['addSoundAmount']) && $_SESSION['addSoundAmount'] != "402" ) {//default value
    $MAX_FILE_NUMBER += intval($_SESSION['addSoundAmount'], 10);
}
$UPLOAD_DIR = '/home/bluebot/soundboard/';
//$UPLOAD_DIR = 'soundboard/'; //testing
if (!is_dir($UPLOAD_DIR . "/" . $serverId . "/")) {
    mkdir($UPLOAD_DIR . "/" . $serverId, 0755);
}
$target_file = $UPLOAD_DIR . "/" . $serverId . "/" . $name . ".mp3";
$serverDirectory = $UPLOAD_DIR . "/" . $serverId;
$fileCount = count(scandir($serverDirectory)) -1;

//Return object
$obj = new stdClass();
$obj->success = true;
$obj->message = 'Your sound has been uploaded. Uploads left : ' . (($MAX_FILE_NUMBER -1) - $fileCount) ;
$obj->name = $name;

if($_FILES['new_sound']['error'] > 0) {
    $obj->success = false;
    $obj->message = 'Please select a file';
} else {
    require_once '../getid3/getid3.php';
    $getID3 = new getID3;
    $file = $_FILES['new_sound']['tmp_name'];
    $fileInfo = $getID3->analyze($file);

    if(file_exists($target_file)) {
        $obj->success = false;
        $obj->message = 'The name is already used';
    }

    else if(empty($name)) {
        $obj->success = false;
        $obj->message = 'No name given';
    }

    else if(strcmp($name, "help") == 0) {
        $obj->success = false;
        $obj->message = 'Naming the sound \'help\' will cause issues. Choose another name';
    }

    else if(strlen($name) > 15) {
        $obj->success = false;
        $obj->message = 'Name too long';
    }

    else if(empty($serverId) || strlen($serverId) < 17 || strlen($serverId) > 18) {
        $obj->success = false;
        $obj->message = 'Server ID not provided';
    }

    else if (strpos($name, ' ') !== false) {
        $obj->success = false;
        $obj->message = 'Name can\'t contain spaces';
    }

    else if(!isset($fileInfo['fileformat']) || strcmp($fileInfo['fileformat'], 'mp3') !== 0) {
        $obj->success = false;
        $obj->message = 'Wrong type of file - Please try again';
    }

    else if($fileInfo['filesize'] > $MAX_SIZE) {
        $obj->success = false;
        $obj->message = 'File too big';
    }

    else if(!isset($_POST['agreement'])) {
        $obj->success = false;
        $obj->message = 'Please check the box';
    }
    else if($fileCount >= $MAX_FILE_NUMBER) {
        $obj->success = false;
        $obj->message = 'Max number of sound already reached (' . ($fileCount-1) . ')'; //-1 cause +1 before
    }

    else {
        //All conditions are met
        move_uploaded_file($_FILES["new_sound"]['tmp_name'], $target_file);
    }
}
echo json_encode($obj);
