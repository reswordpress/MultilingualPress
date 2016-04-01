/**
 * The MultilingualPress front end namespace object.
 * @namespace
 */
var MultilingualPress = {};

/**
 * Redirects the user to the given URL.
 * @param {string} url - The URL.
 */
MultilingualPress.setLocation = function( url ) {
	'use strict';

	window.location.href = url;
};

window.$ = window.jQuery;

window.module = window.module || {};

var Quicklinks = (function() {
	'use strict';

	/**
	 * @classdesc The MultilingualPress Quicklinks module.
	 * @class
	 * @alias Quicklinks
	 * @param {string} [selector] - The form element selector.
	 */
	function Module( selector ) {
		/**
		 * The form element selector.
		 * @type {string}
		 */
		this.selector = selector || '';
	}

	/**
	 * Initializes the module (as soon as jQuery is ready).
	 */
	Module.prototype.initialize = function initialize() {
		$( this.attachSubmitHandler.bind( this ) );
	};

	/**
	 * Attaches the according handler to the form submit event.
	 * @returns {boolean}
	 */
	Module.prototype.attachSubmitHandler = function attachSubmitHandler() {
		var $form = $( this.selector );
		if ( ! $form.length ) {
			return false;
		}

		$form.on( 'submit', this.submitForm );

		return true;
	};

	/**
	 * Triggers a redirect on form submission.
	 * @param {Event} event - The submit event of the form.
	 * @returns {boolean}
	 */
	Module.prototype.submitForm = function submitForm( event ) {
		var $select = $( event.target ).find( 'select' );
		if ( ! $select.length ) {
			return false;
		}

		event.preventDefault();

		window.MultilingualPress.setLocation( $select.val() );

		// For testing only.
		return true;
	};

	return Module;
})();

module.exports = Quicklinks;

/* global Quicklinks */
var mlp = window.MultilingualPress;

/**
 * The MultilingualPress Quicklinks instance.
 * @type {Quicklinks}
 */
mlp.quicklinks = new Quicklinks( '#mlp-quicklink-form' );
mlp.quicklinks.initialize();
