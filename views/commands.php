<!--
Author : Blue
Version : 0.3
-->

<div id="commandsPage">
    <div id="index-banner" class="parallax-container parallaxCommands">
        <div class="section no-pad-bot">
            <div class="container">
                <h4 class="header center blue-text text-darken-2">BlueBot Commands</h4>
                <div class="row center">
                    <h5 class="header col s12 light">All commands are prefixed with a ! by default. However, this prefix is customizable.</h5>
                    <h5 class="header col s12 light">Help for each command is available by typing !command help.</h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img id="parallaxBg" src="img/code.png" alt="code background"></div>
    </div>
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 center">
                    <?php
                    include 'commands/utility.html';
                    include 'commands/moderation.html';
                    include 'commands/fun.html';
                    include 'commands/misc.html';
                    include 'commands/owner.html';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>