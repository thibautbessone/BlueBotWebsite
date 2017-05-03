<!--
Author : Blue
Version : 0.2
-->

<div id="commandsPage">
    <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="mdi-content-send brown-text"></i></h3>
                    <h4>BlueBot Commands</h4>
                    <p>All commands are prefixed with a ! by default. However, this prefix is customizable.</p>
                    <p>Help for each command is available by typing !command help .</p>
                    <?php
                    include 'commands/utility.html';
                    include 'commands/moderation.html';
                    include 'commands/fun.html';
                    include 'commands/misc.html';
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>