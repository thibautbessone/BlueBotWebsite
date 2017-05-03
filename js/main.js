/* Author : Blue
 Version : 0.2
 */

$(document).ready(function () {

    //Homepage
    $('#commandsPage').hide();

    $('.parallax').parallax();
    //On click on menu tab
    $('#navList li').on('click', function () {
        //Unselect all the tabs
        $('#navList li').each(function() {
            $(this).removeClass('active');
        });
        //Select the clicked tab
        $(this).addClass('active');
    });

    $('#commands').on('click', function () {
        $('#homePage').fadeOut(function () {
            $('#commandsPage').fadeIn();
        });
    });

    $('#home').on('click', function () {
        $('#commandsPage').fadeOut( function () {
            $('#homePage').fadeIn();
        });
    });
});
