/* Author : Blue
 Version : 0.1
 */

$(document).ready(function () {

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
        $('#siteContent').fadeOut('fast', function () {
            $('#siteContent').load('views/commands.html').fadeIn('fast');
        });
    });

    $('#home').on('click', function () {
        $('#siteContent').fadeOut('fast', function () {
            $('#siteContent').load('views/homepage.html').fadeIn('fast');
        });
    });
});