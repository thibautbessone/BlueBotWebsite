/* Author : Blue
 Version : 0.1
 */

$(document).ready(function(){
    $('.modal').modal({
            dismissible: true, // Modal can be dismissed by clicking outside of the modal
            opacity: .5, // Opacity of modal background
            inDuration: 250, // Transition in duration
            outDuration: 200, // Transition out duration
            startingTop: '5%', // Starting top style attribute
            endingTop: '10%' // Ending top style attribute
        }
    );

    $('#sound_form').submit(function () {
        //var form_data = new FormData(document.getElementById('sound_form'));
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            contentType: false,
            processData: false,
            data: new FormData(document.getElementById('sound_form'))
        }).done(function (result) {
            console.log(result);
            var data = JSON.parse(result);
            if(data.success === true) {
                Materialize.toast('<i class="material-icons prefix">done</i>' + "&nbsp;&nbsp;" + data.message, 3000, 'green');
            } else {
                Materialize.toast('<i class="material-icons prefix">error</i>' + "&nbsp;&nbsp;" + data.message, 3000, 'red');
            }
        });
        return false;
    });

    $('#upload_button').click(function () {
        $('#sound_form').submit();
    })
});