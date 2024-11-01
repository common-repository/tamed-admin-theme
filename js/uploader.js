jQuery(document).ready(function($){

  $('#upload_image_button').click(function() {

    var send_attachment_bkp = wp.media.editor.send.attachment;

    wp.media.editor.send.attachment = function(props, attachment) {

        $('#tmd-logo-preview img').attr('src', attachment.url);
        $('#upload_image').val(attachment.url);

        wp.media.editor.send.attachment = send_attachment_bkp;
    }

    wp.media.editor.open();

    return false;
});

});