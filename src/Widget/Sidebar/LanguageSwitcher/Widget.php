<?php # -*- coding: utf-8 -*-

declare( strict_types = 1 );

namespace Inpsyde\MultilingualPress\Widget\Sidebar\LanguageSwitcher;

use Inpsyde\MultilingualPress\Common\Type\Language;
use Inpsyde\MultilingualPress\Widget\Sidebar\RegistrableWidget;
use Inpsyde\MultilingualPress\Widget\Sidebar\SelfRegisteringWidget;
use Inpsyde\MultilingualPress\Widget\Sidebar\View;

/**
 * Language switcher widget.
 *
 * @package Inpsyde\MultilingualPress\Widget\Sidebar\LanguageSwitcher
 * @since   3.0.0
 */
final class Widget extends \WP_Widget implements RegistrableWidget {

	use SelfRegisteringWidget;

	/**
	 * @var View
	 */
	private $view;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @since 3.0.0
	 *
	 * @param View $view Widget view object.
	 */
	public function __construct( View $view ) {

		parent::__construct( 'Mlp_Widget', __( 'Language Switcher', 'multilingualpress' ), [
			'classname'                   => 'mlp_widget',
			'description'                 => __( 'MultilingualPress Translations', 'multilingualpress' ),
			'customize_selective_refresh' => true,
		] );

		$this->view = $view;
	}

	/**
	 * Renders the widget's admin view.
	 *
	 * @since 3.0.0
	 *
	 * @param array $instance Widget settings.
	 *
	 * @return void
	 */
	public function form( $instance ) {

		$instance = (array) $instance;
		?>
		<p>
			<?php
			$id = $this->get_field_id( 'mlp_widget_title' );
			?>
			<label for="<?php echo esc_attr( $id ); ?>"><?php esc_html_e( 'Title', 'multilingualpress' ); ?></label><br>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'mlp_widget_title' ) ); ?>"
				value="<?php echo esc_attr( $instance['widget_title'] ?? '' ); ?>"
				class="widefat" id="<?php echo esc_attr( $id ); ?>">
		</p>
		<p>
			<?php
			$id = $this->get_field_id( 'mlp_widget_link_type' );

			$options = [
				Language::NATIVE_NAME  => __( 'Native name', 'multilingualpress' ),
				Language::CUSTOM_NAME  => __( 'Custom name', 'multilingualpress' ),
				Language::ENGLISH_NAME => __( 'English name', 'multilingualpress' ),
				Language::HTTP_CODE    => __( 'Language code', 'multilingualpress' ),
				Language::CODE_SHORT   => __( 'Language code (short)', 'multilingualpress' ),
				Language::NONE         => __( 'None', 'multilingualpress' ),
			];

			$link_type = $instance['widget_link_type'] ?? '';
			?>
			<label for="<?php echo esc_attr( $id ); ?>"><?php esc_html_e( 'Link text', 'multilingualpress' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'mlp_widget_link_type' ) ); ?>" class="widefat"
				id="<?php echo esc_attr( $id ); ?>" autocomplete="off">
				<?php foreach ( $options as $value => $text ) : ?>
					<option value="<?php echo esc_attr( $value ); ?>"<?php selected( $value, $link_type ); ?>>
						<?php echo esc_html( $text ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<?php
			$id = $this->get_field_id( 'mlp_widget_show_current_blog' );
			?>
			<label for="<?php echo esc_attr( $id ); ?>">
				<input type="checkbox"
					name="<?php echo esc_attr( $this->get_field_name( 'mlp_widget_show_current_blog' ) ); ?>" value="1"
					id="<?php echo esc_attr( $id ); ?>"
					<?php checked( ! empty( $instance['widget_show_current_blog'] ) ); ?>>
				<?php esc_html_e( 'Show current site', 'multilingualpress' ); ?>
			</label>
		</p>
		<p>
			<?php
			$id = $this->get_field_id( 'mlp_widget_toggle_view_on_translated_posts' );
			?>
			<label for="<?php echo esc_attr( $id ); ?>">
				<input type="checkbox"
					name="<?php echo esc_attr( $this->get_field_name( 'mlp_widget_toggle_view_on_translated_posts' ) ); ?>"
					value="1" id="<?php echo esc_attr( $id ); ?>"
					<?php checked( ! empty( $instance['widget_toggle_view_on_translated_posts'] ) ); ?>>
				<?php esc_html_e( 'Show links for translated content only.', 'multilingualpress' ); ?>
			</label>
		</p>
		<p>
			<?php
			// TODO: Inject language manager settings page, and reference the capability...
			if ( current_user_can( 'manage_network_options' ) ) {
				// translators: %s: settings page URL.
				$message = __( 'Languages are sorted by <a href="%s">priority</a>.', 'multilingualpress' );
				$message = sprintf(
					$message,
					// TODO: ... as well as the URL.
					esc_url( network_admin_url( 'settings.php?page=language-manager' ) )
				);

				$tags = [
					'a' => [
						'href' => true,
					],
				];

				echo wp_kses( $message, $tags );
			} else {
				esc_html_e( 'Languages are sorted by priority.', 'multilingualpress' );
			}
			?>
		</p>
		<?php
	}

	/**
	 * Updates the widget settings.
	 *
	 * @since 3.0.0
	 *
	 * @param array $new_instance New widget settings.
	 * @param array $instance     Current widget settings.
	 *
	 * @return array Update widget settings.
	 */
	public function update( $new_instance, $instance ) {

		$new_instance = (array) $new_instance;

		$instance = (array) $instance;

		$instance['widget_title'] = esc_html( $new_instance['mlp_widget_title'] ?? '' );

		$instance['widget_link_type'] = esc_attr( $new_instance['mlp_widget_link_type'] ?? '' );

		$instance['widget_show_current_blog'] = (int) (
			isset( $new_instance['mlp_widget_show_current_blog'] )
			&& 1 === (int) $new_instance['mlp_widget_show_current_blog']
		);

		$instance['widget_toggle_view_on_translated_posts'] = (int) (
			isset( $new_instance['mlp_widget_toggle_view_on_translated_posts'] )
			&& 1 === (int) $new_instance['mlp_widget_toggle_view_on_translated_posts']
		);

		return $instance;
	}

	/**
	 * Renders the widget's front end view.
	 *
	 * @since 3.0.0
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Widget settings.
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {

		$this->view->render( (array) $args, (array) $instance, $this->id_base );
	}
}
