<?php # -*- coding: utf-8 -*-

declare( strict_types = 1 );

namespace Inpsyde\MultilingualPress\Module\CustomPostTypeSupport;

use Inpsyde\MultilingualPress\Common\Nonce\Nonce;
use Inpsyde\MultilingualPress\Common\Setting\SettingsBoxViewModel;

use function Inpsyde\MultilingualPress\nonce_field;

/**
 * Custom post type support settings box.
 *
 * @package Inpsyde\MultilingualPress\Module\CustomPostTypeSupport
 * @since   3.0.0
 */
final class CustomPostTypeSupportSettingsBox implements SettingsBoxViewModel {

	/**
	 * @var Nonce
	 */
	private $nonce;

	/**
	 * @var \WP_Post_Type[]
	 */
	private $post_types;

	/**
	 * @var PostTypeRepository
	 */
	private $repository;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @since 3.0.0
	 *
	 * @param PostTypeRepository $repository Post type repository object.
	 * @param Nonce              $nonce      Nonce object.
	 */
	public function __construct( PostTypeRepository $repository, Nonce $nonce ) {

		$this->repository = $repository;

		$this->nonce = $nonce;
	}

	/**
	 * Returns the description.
	 *
	 * @since 3.0.0
	 *
	 * @return string The description.
	 */
	public function description(): string {

		return __(
			'In some cases the correct pretty permalinks are not available across multiple sites. Test it, and activate dynamic permalinks for those post types to avoid 404 errors. This will not change the permalink settings, just the URLs in MultilingualPress.',
			'multilingualpress'
		);
	}

	/**
	 * Returns the ID of the container element.
	 *
	 * @since 3.0.0
	 *
	 * @return string The ID of the container element.
	 */
	public function id(): string {

		return 'mlp-cpt-support-settings';
	}

	/**
	 * Returns the ID of the form element to be used by the label in order to make it accessible for screen readers.
	 *
	 * @since 3.0.0
	 *
	 * @return string The ID of the primary form element.
	 */
	public function label_id(): string {

		return '';
	}

	/**
	 * Renders the markup for the settings box.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function render() {

		if ( ! isset( $this->post_types ) ) {
			$this->post_types = $this->repository->get_custom_post_types();
		}

		if ( ! $this->post_types ) {
			return;
		}

		$supported_post_types = $this->repository->get_supported_post_types();

		nonce_field( $this->nonce );
		?>
		<table>
			<tbody>
			<?php array_walk( $this->post_types, [ $this, 'render_table_row' ], $supported_post_types ); ?>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Returns the title of the settings box.
	 *
	 * @since 3.0.0
	 *
	 * @return string The title of the settings box.
	 */
	public function title(): string {

		return __( 'Custom Post Type Support', 'multilingualpress' );
	}

	/**
	 * Renders a table row element according to the given data.
	 *
	 * @param \WP_Post_Type $post_type            Post type object.
	 * @param string        $slug                 Post type slug.
	 * @param int[]         $supported_post_types Supported post type settings.
	 *
	 * @return void
	 */
	private function render_table_row( \WP_Post_Type $post_type, string $slug, array $supported_post_types ) {

		$name = PostTypeSupportSettingsUpdater::SETTINGS_NAME;

		$id = "mlp-cpt-{$slug}";

		$post_type_setting = empty( $supported_post_types[ $slug ] )
			? PostTypeRepository::CPT_INACTIVE
			: (int) $supported_post_types[ $slug ];
		?>
		<tr>
			<td>
				<label for="<?php echo esc_attr( $id ); ?>" class="mlp-block-label">
					<?php
					$this->render_checkbox(
						"{$name}[{$slug}]",
						$id,
						PostTypeRepository::CPT_INACTIVE !== $post_type_setting
					);
					?>
					<?php echo esc_html( $post_type->labels->name ); ?>
				</label>
			</td>
			<td>
				<label for="<?php echo esc_attr( $id ); ?>|links" class="mlp-block-label">
					<?php
					$this->render_checkbox(
						"{$name}[{$slug}|links]",
						"{$id}|links",
						PostTypeRepository::CPT_QUERY_BASED === $post_type_setting
					);
					?>
					<?php esc_html_e( 'Use dynamic permalinks', 'multilingualpress' ); ?>
				</label>
			</td>
		</tr>
		<?php
	}

	/**
	 * Renders a checkbox element according to the given data.
	 *
	 * @param string $name    Name attribute value.
	 * @param string $id      ID attribute value.
	 * @param bool   $checked Checked state.
	 *
	 * @return void
	 */
	private function render_checkbox( string $name, string $id, bool $checked ) {

		printf(
			'<input type="checkbox" name="%1$s" value="1" id="%2$s"%3$s>',
			esc_attr( $name ),
			esc_attr( $id ),
			checked( $checked, true, false )
		);
	}
}
