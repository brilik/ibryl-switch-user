<?php

namespace ISWU_Core;

class ISWU_Ajax {

	/**
	 * Inits ajax.
	 */
	public function __construct() {
		add_action( 'wp_ajax_switch_user_get_users', [ $this, 'get_users' ] );
		add_action( 'wp_ajax_switch_user_set_user', [ $this, 'set_user' ] );
	}

	/**
	 * Gets all users.
	 *
	 * @return void
	 */
	public function get_users() {
		$users = get_users( [
			'order' => 'ASC',
		] );

		$response = [];

		foreach ( $users as $user ) {
			$name = [];
			if ( false === empty ( $user->first_name ) ) {
				$name[] = $user->first_name;
			}
			if ( false === empty ( $user->last_name ) ) {
				$name[] = $user->last_name;
			}
			if ( empty ( $user->first_name ) && empty ( $user->last_name ) ) {
				$name[] = $user->display_name;
			}

			$roles = implode( ' ', $user->roles );
			$name  = implode( ' ', $name );

			$response[] = [
				'id'   => $user->id,
				'name' => ucfirst( $name ),
				'role' => ucfirst( $roles ),
			];
		}

		wp_send_json_success( $response );
	}

	public function set_user() {
		$id        = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
		$user_info = get_userdata( $id ?? get_current_user_id() );

		wp_set_current_user( $id, $user_info->user_login );
		wp_set_auth_cookie( $id );

		wp_send_json_success( [
			'id'      => $user_info->user_login,
			'message' => "You are logged in as {$user_info->user_login}",
		], 200 );
	}
}