<?php
/**
 * Author: Blue
 * Version : 0.4
 */

include 'views/header.html';
session_start();
$directory = "/data/bluebot/soundboard";
$aliasDirectory = "/sounds";
if(isset($_GET['desiredServer'])) {
    $directory = $directory . "/" . $_GET['desiredServer'];
    $aliasDirectory = $aliasDirectory . "/" . $_GET['desiredServer'];
}

//COMMENT THE @ for invalid path warnings
$scan = @scandir($directory, SCANDIR_SORT_NONE);
$scanned_directory = @array_filter(@scandir($directory), function($file) {
    global $directory;
    return !is_dir($directory . "/" . $file);
});
@sort($scanned_directory, SORT_STRING | SORT_FLAG_CASE);
?>

<div id="serverIDInput">
    <div class="row">
        <div class="col s12">
            <form method="get">
                <span>If you want to see your server soundboard, enter your server ID :</span>
                <div class="input-field inline s8">
                    <input id="input_text" name="desiredServer" type="text" data-length="18">
                    <label for="input_text">your ID here</label>
                </div>
                <button class="btn waves-effect waves-light blue darken-2" type="submit">Go
                    <i class="material-icons right">chevron_right</i>
                </button>
            </form>
        </div>

    </div>
</div>
<div>
    <ul id="soundList" class="collection with-header">
        <li class="collection-header item"><h4>Sound list</h4></li>
        <?php
        if(is_array($scanned_directory)) {
            foreach ($scanned_directory as $key => $value) {
                echo '<li class="collection-item item"><div>' . $value . '<audio preload="none" id="' . $value . '" src="' . $aliasDirectory . '/' . $value . '"></audio>';
                if(isset($_GET['desiredServer'])) {
                    echo '<a href="php/download_sound.php?sound=' . $value . '&desiredServer=' . $_GET['desiredServer'] . '"  class="secondary-content"><i  id="dlIcon" class="material-icons">file_download</i></a>';
                } else {
                    echo '<a href="php/download_sound.php?sound=' . $value . '"  class="secondary-content"><i id="dlIcon" class="material-icons">file_download</i></a>';
                }
                echo '<div class="secondary-content">
                    <i id="soundIcon" onclick="document.getElementById(\'' . $value . '\').play()"  class="material-icons">volume_up</i>
                </div></div></li>';
            }
        } else {
            echo '<p style="text-align: center">If there is no sound listed, make sure that you uploaded at least one or that you provided the right server ID.</p>';
        }
        ?>
    </ul>
</div>



