(function($) {
	$(document).ready( function() {
		$( '#cstmsrch_settings_form input' ).bind( "change click select", function() {
			if ( $( this ).attr( 'type' ) != 'submit' ) {
				$( '.updated.fade' ).css( 'display', 'none' );
				$( '#cstmsrch_settings_notice' ).css( 'display', 'block' );
			};
		});
	});
})(jQuery);
