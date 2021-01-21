<h1>Theme options</h1>
<form method="post" action="">
    <table>
        <tr>
            <td>Ảnh</td>
            <td>
                <input class="img-input" type="hidden" name="logo" value="<?php echo $logo; ?>" />
                <img class="img-image" src="<?php echo $logo; ?>" width="500px" height="200px">
                <button class="btn img-button" type="button">Upload</button>
            </td>
        </tr>
        <tr>
            <td>Chọn id danh mục</td>
            <td>
                <select name="osdm">
                    <?php
                        $terms = get_terms('category', array(
                            'parent'=> 0,
                            'hide_empty' => false
                        ) );
                        foreach($terms as $term){
                            $b = $term->term_id;
                            $c = $term->name;

                            $osdm = get_option('theme_option_danh_muc');
                            ?>
                                <option value="<?php echo $b; ?>" <?php if($osdm == $b) { echo 'selected="selected"'; } ?> >
                                    <?php echo $c; ?>
                                </option>
                            <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="save-theme-option" value="Lưu"/></td>
        </tr>
    </table>
</form>


<?php
    if ( ! did_action( 'wp_enqueue_media' ) ) { wp_enqueue_media(); }
?>

<!--js popup media image-->
<script type="text/javascript">
    jQuery(function($){
        // on upload button click
        $('body').on( 'click', '.img-button', function(e){
     
            e.preventDefault();
     
            var button = $(this),
            custom_uploader = wp.media({
                title: 'Insert image',
                library : {
                    type : 'image' // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                },
                button: {
                    text: 'Use this image' // button label text
                },
                multiple: false
            }).on('select', function() { // it also has "open" and "close" events
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                // button.html('<img src="' + attachment.url + '">').next().val(attachment.id).next().show();
                $( ".img-input" ).attr( "value", attachment.url );
                $( ".img-image" ).attr( "src", attachment.url );
            }).open();
        });
    });
</script>


