$(function(){
    $('.form').on('submit', function(event){
        event.preventDefault();
        var $form = $( this );
        //console.log($form);
        sendAjaxRequest( $form );
    });
});


function sendAjaxRequest( $form ){
    var imageData = getImageData( $form );
    // $('#auc-qrcode').html('<img src="'+imageData.url+'">');   
    // $('#auc-qrcode').removeClass('d-none'); 
    // $('.status').addClass('d-none');
    // $('.status').html('');


    if( imageData ){
        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method'),
            data: {data: imageData },
            success: function( response ){
                response = JSON.parse( response );

                if( response.status == 'success' ){
                    $('#auc-qrcode').html('<img src="'+response.url+'">');   
                    $('#auc-qrcode').removeClass('d-none'); 
                    $('.status').addClass('d-none');
                    $('.status').html('');
                }
                else{
                    // error handling goes here..
                }
            },
            error: function( response ){

            }

        });
    }

}

function getImageData( $form ){
    var urlText = '';

    $.each( $form.serializeArray(), function( index, input ){
        urlText = urlText +" "+ input.value;
        // console.log(input.value);
    });
    // console.log(urlText);

    if( urlText && urlText.length ){
    
        $('#auc-qrcode').addClass('d-none');

        new QRCode( $('#auc-qrcode')[0], urlText );

        $('.status').removeClass('d-none');
        $('.status').html('Processing Request...!')

        var canvas = $('#auc-qrcode canvas');

        var img = canvas.get(0).toDataURL("image/png");
        return img;
    }

    return null;
} 
