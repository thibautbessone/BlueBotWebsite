<!--
Author : Blue
Version : 0.2
-->

<nav class="blue darken-2" role="navigation">
    <div class="nav-wrapper container">
        <img id="navbarIcon" src="img/bluebot.png">
        <a id="logo-container" href="./" class="brand-logo">BlueBot</a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="navList" class="right hide-on-med-and-down">
            <li class="home active"><a>Home</a></li>
            <li class="commands"><a>Commands</a></li>
            <li class="soundlist"><a href="./sound_list.php">Sound list</a></li>
            <li><a href="#sound_modal"><i class="material-icons left">add</i>Add a sound</a></li>
            <?php
                if(!isset($_SESSION['userID'])) {
                    echo "<li><a href=\"php/oauth/login.php\"><i class=\"material-icons left\">account_circle</i>Login with Discord</a></li>";
                } else {
                    echo "<li id=\"user\"><img id=\"userAvatar\" src=\"" . $_SESSION['avatar'] . "\">" . $_SESSION['username'] . "#" . $_SESSION['discrim'] . "</li>";
                    echo "<li><a href=\"php/oauth/logout.php\"><i class=\"material-icons left\">highlight_off</i>Logout</a></li>";
                }
            ?>
        </ul>

        <ul id="nav-mobile" class="light side-nav blue darken-2">
            <div id="navMIcon">
                <img id="navMobileIcon" src="img/bluebot.png">
            </div>
            <li class="home active"><a>Home</a></li>
            <li class="commands"><a>Commands</a></li>
        </ul>
    </div>
</nav>