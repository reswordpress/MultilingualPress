<?php # -*- coding: utf-8 -*-

namespace PHPSTORM_META {

	override( \Inpsyde\MultilingualPress\resolve( 0 ), map( [
		'multilingualpress.active_post_types'                     => \Inpsyde\MultilingualPress\Translation\Post\ActivePostTypes::class,
		'multilingualpress.active_taxonomies'                     => \Inpsyde\MultilingualPress\Translation\Term\ActiveTaxonomies::class,
		'multilingualpress.alternate_languages'                   => \Inpsyde\MultilingualPress\Common\AlternateLanguages::class,
		'multilingualpress.asset_factory'                         => \Inpsyde\MultilingualPress\Asset\AssetFactory::class,
		'multilingualpress.asset_manager'                         => \Inpsyde\MultilingualPress\Asset\AssetManager::class,
		'multilingualpress.cache_factory'                         => \Inpsyde\MultilingualPress\Cache\CacheFactory::class,
		'multilingualpress.cache_server'                          => \Inpsyde\MultilingualPress\Cache\Server\Server::class,
		'multilingualpress.cache_server_driver'                   => \Inpsyde\MultilingualPress\Cache\Driver\CacheDriver::class,
		'multilingualpress.cache_server_network_driver'           => \Inpsyde\MultilingualPress\Cache\Driver\CacheDriver::class,
		'multilingualpress.content_relations'                     => \Inpsyde\MultilingualPress\API\ContentRelations::class,
		'multilingualpress.content_relations_table'               => \Inpsyde\MultilingualPress\Database\Table::class,
		'multilingualpress.error_factory'                         => \Inpsyde\MultilingualPress\Factory\ErrorFactory::class,
		'multilingualpress.http_post_request_globals_manipulator' => \Inpsyde\MultilingualPress\Common\HTTP\RequestGlobalsManipulator::class,
		'multilingualpress.internal_locations'                    => \Inpsyde\MultilingualPress\Common\Locations::class,
		'multilingualpress.languages'                             => \Inpsyde\MultilingualPress\API\Languages::class,
		'multilingualpress.languages_table'                       => \Inpsyde\MultilingualPress\Database\Table::class,
		'multilingualpress.meta_box_ui_registry'                  => \Inpsyde\MultilingualPress\Common\Admin\MetaBox\MetaBoxUIRegistry::class,
		'multilingualpress.nav_menu_item_repository'              => \Inpsyde\MultilingualPress\NavMenu\ItemRepository::class,
		'multilingualpress.network_plugin_deactivator'            => \Inpsyde\MultilingualPress\Installation\NetworkPluginDeactivator::class,
		'multilingualpress.nonce_factory'                         => \Inpsyde\MultilingualPress\Factory\NonceFactory::class,
		'multilingualpress.permission_callback_factory'           => \Inpsyde\MultilingualPress\Factory\PermissionCallbackFactory::class,
		'multilingualpress.post_type_repository'                  => \Inpsyde\MultilingualPress\Module\CustomPostTypeSupport\PostTypeRepository::class,
		'multilingualpress.properties'                            => \Inpsyde\MultilingualPress\Common\PluginProperties::class,
		'multilingualpress.quicklinks_settings_repository'        => \Inpsyde\MultilingualPress\Module\Quicklinks\SettingsRepository::class,
		'multilingualpress.redirect_settings_repository'          => \Inpsyde\MultilingualPress\Module\Redirect\SettingsRepository::class,
		'multilingualpress.relationships_table'                   => \Inpsyde\MultilingualPress\Database\Table::class,
		'multilingualpress.rest_response_factory'                 => \Inpsyde\MultilingualPress\Factory\RESTResponseFactory::class,
		'multilingualpress.server_request'                        => \Inpsyde\MultilingualPress\Common\Http\ServerRequest::class,
		'multilingualpress.site_relations'                        => \Inpsyde\MultilingualPress\API\SiteRelations::class,
		'multilingualpress.site_relations_table'                  => \Inpsyde\MultilingualPress\Database\Table::class,
		'multilingualpress.site_settings_repository'              => \Inpsyde\MultilingualPress\Core\Admin\SiteSettingsRepository::class,
		'multilingualpress.table_duplicator'                      => \Inpsyde\MultilingualPress\Database\TableDuplicator::class,
		'multilingualpress.table_installer'                       => \Inpsyde\MultilingualPress\Database\TableInstaller::class,
		'multilingualpress.table_list'                            => \Inpsyde\MultilingualPress\Database\TableList::class,
		'multilingualpress.table_replacer'                        => \Inpsyde\MultilingualPress\Database\TableReplacer::class,
		'multilingualpress.table_string_replacer'                 => \Inpsyde\MultilingualPress\Database\TableStringReplacer::class,
		'multilingualpress.term_translation_options_repository'   => \Inpsyde\MultilingualPress\Translation\Term\TermOptionsRepository::class,
		'multilingualpress.translations'                          => \Inpsyde\MultilingualPress\API\Translations::class,
		'multilingualpress.trasher_setting_repository'            => \Inpsyde\MultilingualPress\Module\Trasher\TrasherSettingRepository::class,
		'multilingualpress.type_factory'                          => \Inpsyde\MultilingualPress\Factory\TypeFactory::class,
		'multilingualpress.uninstaller'                           => \Inpsyde\MultilingualPress\Installation\Uninstaller::class,
		'multilingualpress.untranslated_posts_repository'         => \Inpsyde\MultilingualPress\Widget\Dashboard\UntranslatedPosts\PostsRepository::class,
		'multilingualpress.wordpress_request_context'             => \Inpsyde\MultilingualPress\Common\WordPressRequestContext::class,
		'multilingualpress.wpdb'                                  => \wpdb::class,
	] ) );

	override( new \Inpsyde\MultilingualPress\Service\Container, map( [
		'multilingualpress.accept_language_parser'                                 => \Inpsyde\MultilingualPress\Common\AcceptHeader\HeaderParser::class,
		'multilingualpress.activator'                                              => \Inpsyde\MultilingualPress\Activation\Activator::class,
		'multilingualpress.active_plugins'                                         => \Inpsyde\MultilingualPress\SiteDuplication\ActivePlugins::class,
		'multilingualpress.active_post_types'                                      => \Inpsyde\MultilingualPress\Translation\Post\ActivePostTypes::class,
		'multilingualpress.active_taxonomies'                                      => \Inpsyde\MultilingualPress\Translation\Term\ActiveTaxonomies::class,
		'multilingualpress.add_languages_to_nav_menu_nonce'                        => \Inpsyde\MultilingualPress\Common\Nonce\Nonce::class,
		'multilingualpress.alternate_language_controller'                          => \Inpsyde\MultilingualPress\Core\FrontEnd\AlternateLanguageController::class,
		'multilingualpress.alternate_language_html_link_tag_renderer'              => \Inpsyde\MultilingualPress\Core\FrontEnd\AlternateLanguageRenderer::class,
		'multilingualpress.alternate_language_http_header_renderer'                => \Inpsyde\MultilingualPress\Core\FrontEnd\AlternateLanguageRenderer::class,
		'multilingualpress.alternate_languages'                                    => \Inpsyde\MultilingualPress\Common\AlternateLanguages::class,
		'multilingualpress.alternative_language_title_customizer'                  => \Inpsyde\MultilingualPress\Module\AlternativeLanguageTitleInAdminBar\AdminBarCustomizer::class,
		'multilingualpress.alternative_language_title_site_setting'                => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingViewModel::class,
		'multilingualpress.alternative_language_titles'                            => \Inpsyde\MultilingualPress\Module\AlternativeLanguageTitleInAdminBar\AlternativeLanguageTitles::class,
		'multilingualpress.asset_factory'                                          => \Inpsyde\MultilingualPress\Asset\AssetFactory::class,
		'multilingualpress.asset_manager'                                          => \Inpsyde\MultilingualPress\Asset\AssetManager::class,
		'multilingualpress.attachment_copier'                                      => \Inpsyde\MultilingualPress\SiteDuplication\AttachmentCopier::class,
		'multilingualpress.base_path_adapter'                                      => \Inpsyde\MultilingualPress\Common\BasePathAdapter::class,
		'multilingualpress.cache_factory'                                          => \Inpsyde\MultilingualPress\Cache\CacheFactory::class,
		'multilingualpress.cache_server'                                           => \Inpsyde\MultilingualPress\Cache\Server\Server::class,
		'multilingualpress.cache_server_driver'                                    => \Inpsyde\MultilingualPress\Cache\Driver\CacheDriver::class,
		'multilingualpress.cache_server_network_driver'                            => \Inpsyde\MultilingualPress\Cache\Driver\CacheDriver::class,
		'multilingualpress.content_relations'                                      => \Inpsyde\MultilingualPress\API\ContentRelations::class,
		'multilingualpress.content_relations_table'                                => \Inpsyde\MultilingualPress\Database\Table::class,
		'multilingualpress.error_factory'                                          => \Inpsyde\MultilingualPress\Factory\ErrorFactory::class,
		'multilingualpress.front_page_translator'                                  => \Inpsyde\MultilingualPress\Translation\Translator::class,
		'multilingualpress.http_post_request_globals_manipulator'                  => \Inpsyde\MultilingualPress\Common\HTTP\RequestGlobalsManipulator::class,
		'multilingualpress.installation_checker'                                   => \Inpsyde\MultilingualPress\Installation\InstallationChecker::class,
		'multilingualpress.installer'                                              => \Inpsyde\MultilingualPress\Installation\Installer::class,
		'multilingualpress.integration.wp_cli'                                     => \Inpsyde\MultilingualPress\Integration\Integration::class,
		'multilingualpress.internal_locations'                                     => \Inpsyde\MultilingualPress\Common\Locations::class,
		'multilingualpress.language_negotiator'                                    => \Inpsyde\MultilingualPress\Module\Redirect\LanguageNegotiator::class,
		'multilingualpress.language_site_setting'                                  => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingViewModel::class,
		'multilingualpress.language_switcher_widget'                               => \WP_Widget::class,
		'multilingualpress.language_switcher_widget_view'                          => \Inpsyde\MultilingualPress\Widget\Sidebar\View::class,
		'multilingualpress.languages'                                              => \Inpsyde\MultilingualPress\API\Languages::class,
		'multilingualpress.languages_table'                                        => \Inpsyde\MultilingualPress\Database\Table::class,
		'multilingualpress.meta_box_ui_registry'                                   => \Inpsyde\MultilingualPress\Common\Admin\MetaBox\MetaBoxUIRegistry::class,
		'multilingualpress.module_manager'                                         => \Inpsyde\MultilingualPress\Module\ModuleManager::class,
		'multilingualpress.nav_menu_ajax_handler'                                  => \Inpsyde\MultilingualPress\NavMenu\AJAXHandler::class,
		'multilingualpress.nav_menu_item_deletor'                                  => \Inpsyde\MultilingualPress\NavMenu\ItemDeletor::class,
		'multilingualpress.nav_menu_item_filter'                                   => \Inpsyde\MultilingualPress\NavMenu\ItemFilter::class,
		'multilingualpress.nav_menu_item_repository'                               => \Inpsyde\MultilingualPress\NavMenu\ItemRepository::class,
		'multilingualpress.nav_menu_meta_box_model'                                => \Inpsyde\MultilingualPress\Common\Admin\MetaBoxModel::class,
		'multilingualpress.nav_menu_meta_box_view'                                 => \Inpsyde\MultilingualPress\Common\Admin\MetaBoxView::class,
		'multilingualpress.network_plugin_deactivator'                             => \Inpsyde\MultilingualPress\Installation\NetworkPluginDeactivator::class,
		'multilingualpress.new_site_settings'                                      => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingsSectionViewModel::class,
		'multilingualpress.noredirect_permalink_filter'                            => \Inpsyde\MultilingualPress\Common\Filter::class,
		'multilingualpress.noredirect_storage'                                     => \Inpsyde\MultilingualPress\Module\Redirect\NoredirectStorage::class,
		'multilingualpress.nonce_factory'                                          => \Inpsyde\MultilingualPress\Factory\NonceFactory::class,
		'multilingualpress.plugin_settings_page'                                   => \Inpsyde\MultilingualPress\Common\Admin\SettingsPage::class,
		'multilingualpress.plugin_settings_page_view'                              => \Inpsyde\MultilingualPress\Common\Admin\SettingsPageView::class,
		'multilingualpress.plugin_settings_updater'                                => \Inpsyde\MultilingualPress\Core\Admin\PluginSettingsUpdater::class,
		'multilingualpress.post_meta_box_factory'                                  => \Inpsyde\MultilingualPress\Translation\Post\MetaBoxFactory::class,
		'multilingualpress.post_meta_box_registrar'                                => \Inpsyde\MultilingualPress\Common\Admin\MetaBox\UIAwareMetaBoxRegistrar::class,
		'multilingualpress.post_relationship_control_search'                       => \Inpsyde\MultilingualPress\Translation\Post\Search\Search::class,
		'multilingualpress.post_relationship_control_search_controller'            => \Inpsyde\MultilingualPress\Translation\Post\MetaBox\Search\SearchController::class,
		'multilingualpress.post_relationship_control_search_results'               => \Inpsyde\MultilingualPress\Translation\Post\MetaBox\Search\SearchResultsView::class,
		'multilingualpress.post_relationship_control_view'                         => \Inpsyde\MultilingualPress\Translation\Post\MetaBox\RelationshipControlView::class,
		'multilingualpress.post_relationship_controller'                           => \Inpsyde\MultilingualPress\Translation\Post\RelationshipController::class,
		'multilingualpress.post_relationship_permission'                           => \Inpsyde\MultilingualPress\Translation\Post\RelationshipPermission::class,
		'multilingualpress.post_translation_advanced_ui'                           => \Inpsyde\MultilingualPress\Common\Admin\MetaBox\MetaBoxUI::class,
		'multilingualpress.post_translation_simple_ui'                             => \Inpsyde\MultilingualPress\Common\Admin\MetaBox\MetaBoxUI::class,
		'multilingualpress.post_translator'                                        => \Inpsyde\MultilingualPress\Translation\Translator::class,
		'multilingualpress.post_type_link_url_filter'                              => \Inpsyde\MultilingualPress\Common\Filter::class,
		'multilingualpress.post_type_translator'                                   => \Inpsyde\MultilingualPress\Translation\Translator::class,
		'multilingualpress.post_type_repository'                                   => \Inpsyde\MultilingualPress\Module\CustomPostTypeSupport\PostTypeRepository::class,
		'multilingualpress.post_type_support_settings_box'                         => \Inpsyde\MultilingualPress\Common\Setting\SettingsBoxViewModel::class,
		'multilingualpress.post_type_support_settings_updater'                     => \Inpsyde\MultilingualPress\Module\CustomPostTypeSupport\PostTypeSupportSettingsUpdater::class,
		'multilingualpress.properties'                                             => \Inpsyde\MultilingualPress\Common\PluginProperties::class,
		'multilingualpress.quicklinks'                                             => \Inpsyde\MultilingualPress\Module\Quicklinks\Quicklinks::class,
		'multilingualpress.quicklinks_redirect_hosts_filter'                       => \Inpsyde\MultilingualPress\Common\Filter::class,
		'multilingualpress.quicklinks_redirector'                                  => \Inpsyde\MultilingualPress\Module\Quicklinks\Redirector::class,
		'multilingualpress.quicklinks_settings_box'                                => \Inpsyde\MultilingualPress\Common\Setting\SettingsBoxViewModel::class,
		'multilingualpress.quicklinks_settings_repository'                         => \Inpsyde\MultilingualPress\Module\Quicklinks\SettingsRepository::class,
		'multilingualpress.quicklinks_settings_updater'                            => \Inpsyde\MultilingualPress\Module\Quicklinks\SettingsUpdater::class,
		'multilingualpress.redirect_request_validator'                             => \Inpsyde\MultilingualPress\Common\RequestValidator::class,
		'multilingualpress.redirect_settings_repository'                           => \Inpsyde\MultilingualPress\Module\Redirect\SettingsRepository::class,
		'multilingualpress.redirect_site_setting'                                  => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingViewModel::class,
		'multilingualpress.redirect_site_setting_updater'                          => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingUpdater::class,
		'multilingualpress.redirect_user_setting'                                  => \Inpsyde\MultilingualPress\Common\Setting\User\UserSettingViewModel::class,
		'multilingualpress.redirect_user_setting_updater'                          => \Inpsyde\MultilingualPress\Common\Setting\User\UserSettingUpdater::class,
		'multilingualpress.redirector'                                             => \Inpsyde\MultilingualPress\Module\Redirect\Redirector::class,
		'multilingualpress.relationships_site_setting'                             => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingViewModel::class,
		'multilingualpress.relationships_table'                                    => \Inpsyde\MultilingualPress\Database\Table::class,
		'multilingualpress.rest.content_relations_create_arguments'                => \Inpsyde\MultilingualPress\REST\Common\Arguments::class,
		'multilingualpress.rest.content_relations_create_handler'                  => \Inpsyde\MultilingualPress\REST\Common\Endpoint\RequestHandler::class,
		'multilingualpress.rest.content_relations_data_filter'                     => \Inpsyde\MultilingualPress\REST\Common\Response\DataFilter::class,
		'multilingualpress.rest.content_relations_delete_arguments'                => \Inpsyde\MultilingualPress\REST\Common\Arguments::class,
		'multilingualpress.rest.content_relations_delete_handler'                  => \Inpsyde\MultilingualPress\REST\Common\Endpoint\RequestHandler::class,
		'multilingualpress.rest.content_relations_formatter'                       => \Inpsyde\MultilingualPress\REST\Endpoint\ContentRelations\Formatter::class,
		'multilingualpress.rest.content_relations_post_field'                      => \Inpsyde\MultilingualPress\REST\Core\Field\Field::class,
		'multilingualpress.rest.content_relations_post_field_reader'               => \Inpsyde\MultilingualPress\REST\Common\Field\Reader::class,
		'multilingualpress.rest.content_relations_post_field_schema'               => \Inpsyde\MultilingualPress\REST\Common\Schema::class,
		'multilingualpress.rest.content_relations_read_arguments'                  => \Inpsyde\MultilingualPress\REST\Common\Arguments::class,
		'multilingualpress.rest.content_relations_read_handler'                    => \Inpsyde\MultilingualPress\REST\Common\Endpoint\RequestHandler::class,
		'multilingualpress.rest.content_relations_schema'                          => \Inpsyde\MultilingualPress\REST\Endpoint\ContentRelations\Schema::class,
		'multilingualpress.rest.content_relations_update_arguments'                => \Inpsyde\MultilingualPress\REST\Common\Arguments::class,
		'multilingualpress.rest.content_relations_update_handler'                  => \Inpsyde\MultilingualPress\REST\Common\Endpoint\RequestHandler::class,
		'multilingualpress.rest.site_relations_create_arguments'                   => \Inpsyde\MultilingualPress\REST\Common\Arguments::class,
		'multilingualpress.rest.site_relations_create_handler'                     => \Inpsyde\MultilingualPress\REST\Common\Endpoint\RequestHandler::class,
		'multilingualpress.rest.site_relations_data_filter'                        => \Inpsyde\MultilingualPress\REST\Common\Response\DataFilter::class,
		'multilingualpress.rest.site_relations_delete_arguments'                   => \Inpsyde\MultilingualPress\REST\Common\Arguments::class,
		'multilingualpress.rest.site_relations_delete_handler'                     => \Inpsyde\MultilingualPress\REST\Common\Endpoint\RequestHandler::class,
		'multilingualpress.rest.site_relations_formatter'                          => \Inpsyde\MultilingualPress\REST\Endpoint\ContentRelations\Formatter::class,
		'multilingualpress.rest.site_relations_read_arguments'                     => \Inpsyde\MultilingualPress\REST\Common\Arguments::class,
		'multilingualpress.rest.site_relations_read_handler'                       => \Inpsyde\MultilingualPress\REST\Common\Endpoint\RequestHandler::class,
		'multilingualpress.rest.site_relations_schema'                             => \Inpsyde\MultilingualPress\REST\Endpoint\ContentRelations\Schema::class,
		'multilingualpress.rest.site_relations_update_arguments'                   => \Inpsyde\MultilingualPress\REST\Common\Arguments::class,
		'multilingualpress.rest.site_relations_update_handler'                     => \Inpsyde\MultilingualPress\REST\Common\Endpoint\RequestHandler::class,
		'multilingualpress.rest_field_access'                                      => \Inpsyde\MultilingualPress\REST\Common\Field\Access::class,
		'multilingualpress.rest_field_collection'                                  => \Inpsyde\MultilingualPress\REST\Common\Field\Collection::class,
		'multilingualpress.rest_field_registry'                                    => \Inpsyde\MultilingualPress\REST\Common\Field\Registry::class,
		'multilingualpress.rest_request_field_processor'                           => \Inpsyde\MultilingualPress\REST\Common\Request\FieldProcessor::class,
		'multilingualpress.rest_response_data_access'                              => \Inpsyde\MultilingualPress\REST\Common\Response\DataAccess::class,
		'multilingualpress.rest_response_factory'                                  => \Inpsyde\MultilingualPress\Factory\RESTResponseFactory::class,
		'multilingualpress.rest_route_collection'                                  => \Inpsyde\MultilingualPress\REST\Common\Route\Collection::class,
		'multilingualpress.rest_route_registry'                                    => \Inpsyde\MultilingualPress\REST\Common\Route\Registry::class,
		'multilingualpress.rest_schema_field_processor'                            => \Inpsyde\MultilingualPress\REST\Common\Endpoint\FieldProcessor::class,
		'multilingualpress.save_plugin_settings_nonce'                             => \Inpsyde\MultilingualPress\Common\Nonce\Nonce::class,
		'multilingualpress.save_redirect_site_setting_nonce'                       => \Inpsyde\MultilingualPress\Common\Nonce\Nonce::class,
		'multilingualpress.save_redirect_user_setting_nonce'                       => \Inpsyde\MultilingualPress\Common\Nonce\Nonce::class,
		'multilingualpress.save_site_settings_nonce'                               => \Inpsyde\MultilingualPress\Common\Nonce\Nonce::class,
		'multilingualpress.save_trasher_setting_nonce'                             => \Inpsyde\MultilingualPress\Common\Nonce\Nonce::class,
		'multilingualpress.search_translator'                                      => \Inpsyde\MultilingualPress\Translation\Translator::class,
		'multilingualpress.server_request'                                         => \Inpsyde\MultilingualPress\Common\Http\ServerRequest::class,
		'multilingualpress.site_data_deletor'                                      => \Inpsyde\MultilingualPress\Core\SiteDataDeletor::class,
		'multilingualpress.site_duplication_activate_plugins_setting'              => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingViewModel::class,
		'multilingualpress.site_duplication_based_on_site_setting'                 => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingViewModel::class,
		'multilingualpress.site_duplication_search_engine_visibility_setting'      => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingViewModel::class,
		'multilingualpress.site_duplication_settings_view'                         => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingView::class,
		'multilingualpress.site_duplicator'                                        => \Inpsyde\MultilingualPress\SiteDuplication\SiteDuplicator::class,
		'multilingualpress.site_relations'                                         => \Inpsyde\MultilingualPress\API\SiteRelations::class,
		'multilingualpress.site_relations_checker'                                 => \Inpsyde\MultilingualPress\Installation\SiteRelationsChecker::class,
		'multilingualpress.site_relations_table'                                   => \Inpsyde\MultilingualPress\Database\Table::class,
		'multilingualpress.site_settings'                                          => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingsSectionViewModel::class,
		'multilingualpress.site_settings_tab'                                      => \Inpsyde\MultilingualPress\Common\Admin\EditSiteTab::class,
		'multilingualpress.site_settings_tab_data'                                 => \Inpsyde\MultilingualPress\Common\Admin\EditSiteTabData::class,
		'multilingualpress.site_settings_tab_view'                                 => \Inpsyde\MultilingualPress\Common\Admin\SettingsPageView::class,
		'multilingualpress.site_settings_repository'                               => \Inpsyde\MultilingualPress\Core\Admin\SiteSettingsRepository::class,
		'multilingualpress.site_settings_update_request_handler'                   => \Inpsyde\MultilingualPress\Core\Admin\SiteSettingsUpdateRequestHandler::class,
		'multilingualpress.site_settings_updater'                                  => \Inpsyde\MultilingualPress\Core\Admin\SiteSettingsUpdater::class,
		'multilingualpress.site_settings_view'                                     => \Inpsyde\MultilingualPress\Common\Setting\Site\SiteSettingView::class,
		'multilingualpress.system_checker'                                         => \Inpsyde\MultilingualPress\Installation\SystemChecker::class,
		'multilingualpress.table_duplicator'                                       => \Inpsyde\MultilingualPress\Database\TableDuplicator::class,
		'multilingualpress.table_installer'                                        => \Inpsyde\MultilingualPress\Database\TableInstaller::class,
		'multilingualpress.table_list'                                             => \Inpsyde\MultilingualPress\Database\TableList::class,
		'multilingualpress.table_replacer'                                         => \Inpsyde\MultilingualPress\Database\TableReplacer::class,
		'multilingualpress.table_string_replacer'                                  => \Inpsyde\MultilingualPress\Database\TableStringReplacer::class,
		'multilingualpress.term_meta_box_factory'                                  => \Inpsyde\MultilingualPress\Translation\Term\MetaBoxFactory::class,
		'multilingualpress.term_meta_box_registrar'                                => \Inpsyde\MultilingualPress\Common\Admin\MetaBox\UIAwareMetaBoxRegistrar::class,
		'multilingualpress.term_relationship_controller'                           => \Inpsyde\MultilingualPress\Translation\Term\RelationshipController::class,
		'multilingualpress.term_relationship_permission'                           => \Inpsyde\MultilingualPress\Translation\Term\RelationshipPermission::class,
		'multilingualpress.term_translation_options_repository'                    => \Inpsyde\MultilingualPress\Translation\Term\TermOptionsRepository::class,
		'multilingualpress.term_translation_simple_ui'                             => \Inpsyde\MultilingualPress\Common\Admin\MetaBox\MetaBoxUI::class,
		'multilingualpress.term_translator'                                        => \Inpsyde\MultilingualPress\Translation\Translator::class,
		'multilingualpress.translation_completed_setting_nonce'                    => \Inpsyde\MultilingualPress\Common\Nonce\Nonce::class,
		'multilingualpress.translation_completed_setting_updater'                  => \Inpsyde\MultilingualPress\Widget\Dashboard\UntranslatedPosts\TranslationCompletedSettingUpdater::class,
		'multilingualpress.translation_completed_setting_view'                     => \Inpsyde\MultilingualPress\Widget\Dashboard\UntranslatedPosts\TranslationCompletedSettingView::class,
		'multilingualpress.translations'                                           => \Inpsyde\MultilingualPress\API\Translations::class,
		'multilingualpress.trasher'                                                => \Inpsyde\MultilingualPress\Module\Trasher\Trasher::class,
		'multilingualpress.trasher_setting_repository'                             => \Inpsyde\MultilingualPress\Module\Trasher\TrasherSettingRepository::class,
		'multilingualpress.trasher_setting_updater'                                => \Inpsyde\MultilingualPress\Module\Trasher\TrasherSettingUpdater::class,
		'multilingualpress.trasher_setting_view'                                   => \Inpsyde\MultilingualPress\Module\Trasher\TrasherSettingView::class,
		'multilingualpress.type_factory'                                           => \Inpsyde\MultilingualPress\Factory\TypeFactory::class,
		'multilingualpress.uninstaller'                                            => \Inpsyde\MultilingualPress\Installation\Uninstaller::class,
		'multilingualpress.untranslated_posts_dashboard_widget'                    => \Inpsyde\MultilingualPress\Widget\Dashboard\DashboardWidget::class,
		'multilingualpress.untranslated_posts_dashboard_widget_view'               => \Inpsyde\MultilingualPress\Widget\Dashboard\View::class,
		'multilingualpress.untranslated_posts_dashboard_widget_configuration_view' => \Inpsyde\MultilingualPress\Widget\Dashboard\View::class,
		'multilingualpress.untranslated_posts_dashboard_widget_configurator'       => \Inpsyde\MultilingualPress\Widget\Dashboard\UntranslatedPosts\WidgetConfigurator::class,
		'multilingualpress.untranslated_posts_repository'                          => \Inpsyde\MultilingualPress\Widget\Dashboard\UntranslatedPosts\PostsRepository::class,
		'multilingualpress.update_post_type_support_settings_nonce'                => \Inpsyde\MultilingualPress\Common\Nonce\Nonce::class,
		'multilingualpress.update_quicklinks_settings_nonce'                       => \Inpsyde\MultilingualPress\Common\Nonce\Nonce::class,
		'multilingualpress.updater'                                                => \Inpsyde\MultilingualPress\Installation\Updater::class,
		'multilingualpress.wordpress_request_context'                              => \Inpsyde\MultilingualPress\Common\WordPressRequestContext::class,
		'multilingualpress.wpdb'                                                   => \wpdb::class,
	] ) );
}
