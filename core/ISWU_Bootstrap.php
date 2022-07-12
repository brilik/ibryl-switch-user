<?php

namespace ISWU_Core;

class ISWU_Bootstrap {

	/**
	 * inits core.
	 *
	 * @return void
	 */
	public static function init() {
		( new ISWU_Ajax() );
		add_action( 'init', function () {
			if ( wp_doing_ajax() || is_user_logged_in() || is_admin() ) {
				( new ISWU_Assets() );
			}
		} );
	}
}