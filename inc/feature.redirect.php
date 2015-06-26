<?php # -*- coding: utf-8 -*-

add_action( 'inpsyde_mlp_loaded', 'mlp_feature_redirect' );

/**
 * Initialize the redirect controller.
 *
 * @param Inpsyde_Property_List_Interface $data Plugin data.
 *
 * @return void
 */
function mlp_feature_redirect( Inpsyde_Property_List_Interface $data ) {

	$image_url = $data->get( 'image_url' );

	$redirect = new Mlp_Redirect(
		$data->get( 'module_manager' ),
		$data->get( 'language_api' ),
		"$image_url/check.png"
	);
	$redirect->setup();

	$user = new Mlp_Redirect_User_Settings;
	$user->setup();
}
