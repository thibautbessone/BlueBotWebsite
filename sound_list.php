<?php
/**
 * Author: Blue
 * Version : 0.1
 */

include 'views/header.html';
$directory = "/home/bluebot/soundboard";
$scan = scandir($directory, SCANDIR_SORT_NONE);
$scanned_directory = array_diff($scan, array('..', '.'));
//print_r($scanned_directory);


sort($scanned_directory, SORT_STRING | SORT_FLAG_CASE);
?>
<div>
    <ul id="soundList" class="collection with-header">
        <li class="collection-header item"><h4>Sound list</h4></li>
        <?php

        foreach ($scanned_directory as $key => $value) {
            echo '<li class="collection-item item"><div>' . $value . '<a href="php/download_sound.php?sound=' . $value . '"  class="secondary-content"><i  id="dlIcon" class="material-icons">file_download</i></a></div></li>';
        }
        ?>
    </ul>
</div>



