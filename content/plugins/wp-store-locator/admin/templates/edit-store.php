<?php
$store_id = absint( $_GET['store_id'] );
$thumb = '';

if ( $store_id ) {
    $store_details = $this->get_store_data( $store_id );
    
    if ( $store_details['thumb_id'] ) {
        $thumb = wp_get_attachment_image_src( $store_details['thumb_id'], 'thumbnail' );
    }
}
?>
<div id="wpsl-wrap" class="wrap wpsl-add-stores">
    <h2 class="wpsl-edit-header"><?php _e( 'Edit ', 'wpsl' ); if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['store'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['store'] ) ); } else { echo esc_attr( stripslashes( $store_details['store'] ) ); } ?></h2>
    <?php settings_errors(); ?>
    
    <form method="post" action="" accept-charset="utf-8">
        <input type="hidden" name="wpsl_actions" value="update_store" />
        <?php wp_nonce_field( 'wpsl_update_store' ); ?>
        <div class="wpsl-add-store">
            <div class="metabox-holder">
                <div class="postbox">
                    <h3><span><?php _e( 'Centre details', 'wpsl' ); ?></span></h3>
                    <div class="inside">
                        <p>
                            <label for="wpsl-store-status"><?php _e( 'Status:', 'wpsl' ); ?></label>
                            <span class="wpsl-radioboxes">
                                <input id="wpsl-store-active" type="radio" name="wpsl[active]" <?php checked( '1', $store_details['active'], true ); ?> value="1" />
                                <label for="wpsl-store-active"><?php _e( 'active', 'wpsl' ); ?></label>
                                <input id="wpsl-store-inactive" type="radio" name="wpsl[active]" <?php checked( '0', $store_details['active'], true ); ?> value="0" />
                                <label for="wpsl-store-inactive"><?php _e( 'inactive', 'wpsl' ); ?></label>
                            </span>
                        </p>
                        <p>
                            <label for="wpsl-store-name"><?php _e( 'Centre Name:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-name" name="wpsl[store]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['store'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['store'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['store'] ) ); } else { echo esc_attr( stripslashes( $store_details['store'] ) ); } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-address"><?php _e( 'Address:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-address" name="wpsl[address]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['address'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['address'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['address'] ) ); } else { echo esc_attr( stripslashes( $store_details['address'] ) ); } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-address2"><?php _e( 'Address 2:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-address2" name="wpsl[address2]" type="text" class="textinput" value="<?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['address2'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['address2'] ) ); } else { echo esc_attr( stripslashes( $store_details['address2'] ) ); } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-city"><?php _e( 'City:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-city" name="wpsl[city]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['city'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['city'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['city'] ) ); } else { echo esc_attr( stripslashes( $store_details['city'] ) ); } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-state"><?php _e( 'County:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-state" name="wpsl[state]" type="text" class="textinput" value="<?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['state'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['state'] ) ); } else { echo esc_attr( stripslashes( $store_details['state'] ) ); } ?>" />
                        </p>                        
                        <p>
                            <label for="wpsl-store-zip"><?php _e( 'Post Code:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-zip" name="wpsl[zip]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['zip'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['zip'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['zip'] ) ); } else { echo esc_attr( stripslashes( $store_details['zip'] ) ); } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-country"><?php _e( 'Country:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-country" name="wpsl[country]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['country'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['country'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['country'] ) ); } else { echo esc_attr( stripslashes( $store_details['country'] ) ); } ?>" />
                            <input id="wpsl-country-iso" type="hidden" name="wpsl[country-iso]" value="<?php echo esc_attr( $store_details['country_iso'] ); ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-url"><?php _e( 'Link:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-url" name="wpsl[url]" type="text" class="textinput" value="<?php if ( isset( $_POST['wpsl']['url'] ) ) { echo esc_url( $_POST['wpsl']['url'] ); } else { echo esc_url( $store_details['url'] ); } ?>" placeholder="/centres/<center name>">
                            <em class="nwm-desc"><?php _e( 'This will link to the individual centre page. Do not leave a trailing slash!', 'nwm' ); ?></em>
                        </p>  
                        <p>
                            <label for="wpsl-store-lat"><?php _e( 'Latitude:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-lat" name="wpsl[lat]" type="text" class="textinput" value="<?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['lat'] ) ) { echo esc_attr( $_POST['wpsl']['lat'] ); } else { echo esc_attr( $store_details['lat'] ); } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-lng"><?php _e( 'Longitude:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-lng" name="wpsl[lng]" type="text" class="textinput" value="<?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['lng'] ) ) { echo esc_attr( $_POST['wpsl']['lng'] ); } else { echo esc_attr( $store_details['lng'] ); } ?>" />
                        </p>  
                        <p class="wpsl-submit-wrap">
                            <input id="wpsl-lookup-location" type="submit" name="wpsl-lookup-location" class="button-primary" value="<?php _e( 'Preview location on the map', 'wpsl' ); ?>" />
                            <em class="nwm-desc"><?php _e( 'You can adjust the location by dragging the marker around', 'nwm' ); ?></em>
                        </p>
                        <p>
                            <input id="wpsl-update-store" type="submit" name="wpsl-update-store" class="button-primary" value="<?php _e( 'Update Centre', 'wpsl' ); ?>" />
                        </p>
                     </div>
                </div>
            </div> 
        
            <div id="wpsl-gmap-wrap"></div>
        </div>
    </form>
</div>