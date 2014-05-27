<div id="wpsl-wrap" class="wrap wpsl-add-stores">
	<h2>WP Store Locator</h2>
    <?php settings_errors(); ?>
    
    <?php echo $this->create_menu(); ?>
    
    <form method="post" action="" accept-charset="utf-8">
        <input type="hidden" name="wpsl_actions" value="add_new_store" />
        <?php wp_nonce_field( 'wpsl_add_new_store' ); ?>
        <div class="wpsl-add-store">
            <div class="metabox-holder">
                <div class="postbox">
                    <h3><span><?php _e( 'Centre details', 'wpsl' ); ?></span></h3>
                    <div class="inside">
                        <p>
                            <label for="wpsl-store-name"><?php _e( 'Centre Name:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-name" name="wpsl[store]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['store'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( !empty( $_POST['wpsl']['store'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['store'] ) );  } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-address"><?php _e( 'Address:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-address" name="wpsl[address]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['address'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( !empty( $_POST['wpsl']['address'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['address'] ) );  } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-address2"><?php _e( 'Address 2:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-address2" name="wpsl[address2]" type="text" class="textinput" value="<?php if ( !empty( $_POST['wpsl']['address2'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['address2'] ) );  } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-city"><?php _e( 'City:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-city" name="wpsl[city]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['city'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( !empty( $_POST['wpsl']['city'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['city'] ) );  } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-state"><?php _e( 'County:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-state" name="wpsl[state]" type="text" class="textinput" value="<?php if ( !empty( $_POST['wpsl']['state'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['state'] ) );  } ?>" />
                        </p>                        
                        <p>
                            <label for="wpsl-store-zip"><?php _e( 'Post Code:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-zip" name="wpsl[zip]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['zip'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( !empty( $_POST['wpsl']['zip'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['zip'] ) );  } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-country"><?php _e( 'Country:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-country" name="wpsl[country]" type="text" class="textinput <?php if ( isset( $_POST['wpsl'] ) && empty( $_POST['wpsl']['country'] ) ) { echo 'wpsl-error'; } ?>" value="<?php if ( !empty( $_POST['wpsl']['country'] ) ) { echo esc_attr( stripslashes( $_POST['wpsl']['country'] ) );  } else { echo esc_attr( stripslashes( $this->settings['editor_country'] ) ); } ?>" />
                            <input id="wpsl-country-iso" type="hidden" name="wpsl[country-iso]" value="<?php if ( !empty( $_POST['wpsl']['country-iso'] ) ) { echo esc_attr( $_POST['wpsl']['country-iso'] );  } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-url"><?php _e( 'Link:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-url" name="wpsl[url]" type="text" class="textinput" value="<?php if ( !empty( $_POST['wpsl']['url'] ) ) { echo esc_url( $_POST['wpsl']['url'] ); } ?>" placeholder="/centres/<center name>">
                            <em class="nwm-desc"><?php _e( 'This will link to the individual centre page. Do not leave a trailing slash!', 'nwm' ); ?></em>
                        </p>
                        <p>
                            <label for="wpsl-store-lat"><?php _e( 'Latitude:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-lat" name="wpsl[lat]" type="text" class="textinput" value="<?php if ( !empty( $_POST['wpsl']['lat'] ) ) { echo esc_attr( $_POST['wpsl']['lat'] ); } ?>" />
                        </p>
                        <p>
                            <label for="wpsl-store-lng"><?php _e( 'Longitude:', 'wpsl' ); ?></label>
                            <input id="wpsl-store-lng" name="wpsl[lng]" type="text" class="textinput" value="<?php if ( !empty( $_POST['wpsl']['lng'] ) ) { echo esc_attr( $_POST['wpsl']['lng'] ); } ?>" />
                        </p>  
                        <p class="wpsl-submit-wrap">
                            <input id="wpsl-lookup-location" type="submit" name="wpsl-lookup-location" class="button-primary" value="<?php _e( 'Preview location on the map', 'wpsl' ); ?>" />
                            <em class="nwm-desc"><?php _e( 'You can adjust the location by dragging the marker around', 'wpsl' ); ?></em>
                        </p>
                         <p><input id="wpsl-add-store" type="submit" name="wpsl-add-store" class="button-primary" value="<?php _e( 'Add Centre', 'wpsl' ); ?>" /></p>
                     </div>
                </div>
            </div> 
        
            <div id="wpsl-gmap-wrap"></div>
        </div>
          
    </form>

</div>