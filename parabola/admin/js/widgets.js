/*!
 * Loading Media upload for custom widget
 */

jQuery(document).ready( function(){
var parabola_uploadparent = 0;
 function media_upload( button_class) {
    var _custom_media = true,
    _orig_send_attachment = wp.media.editor.send.attachment;
    jQuery('body').on('click',button_class, function(e) {
	parabola_uploadparent = jQuery(this).closest('div');
        var button_id ='#'+jQuery(this).attr('id');
        /* console.log(button_id); */
        var self = jQuery(button_id);
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(button_id);
        /* var id = button.attr('id').replace('_button', ''); */
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media  ) {
               /* jQuery('.custom_media_id').val(attachment.id); */  
               parabola_uploadparent.find('.slideimages').val(attachment.url);
			   parabola_uploadparent.find('.slideimages').trigger('change');
               /* jQuery('.custom_media_image').attr('src',attachment.url).css('display','block'); */
            } else {
                return _orig_send_attachment.apply( button_id, [props, attachment] );
            }
        }
        wp.media.editor.open(button);
        return false;
    });
}
media_upload( '.upload_image_button');
});