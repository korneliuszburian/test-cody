<?php

add_action(
	'init',
	function () {
		register_nav_menus(
			array(
				'header-menu'   => 'Header menu',
				'hero-menu'     => 'Hero menu',
				'footer-menu-1' => 'Footer menu 1',
				'footer-menu-2' => 'Footer menu 2',
				'footer-menu-3' => 'Footer menu 3',
			)
		);
	}
);

class CustomNavMenu extends Walker_Nav_Menu {

	/** @var string $name - Name for the block */
	private $name;

	/** @var string Classes for <li> element */
	private $liClass;

	/** @var string Classes for <a> element */
	private $aClass;

	/** @var bool If true, creates svg arrows */
	private $submenuSupport;

	/**
	 * Adjust custom menu with classes and other stuff
	 *
	 * @param string $name Name for the block
	 * @param string $liClass Classes for <li> element
	 * @param string $aClass Classes for <a> element
	 * @param string $submenuSupport If true, creates svg arrows
	 */
	function __construct( string $name = 'custom-menu', string $liClass = 'pos-rel', string $aClass = 'd-flex', bool $submenuSupport = false ) {
		$this->name           = $name;
		$this->liClass        = $liClass;
		$this->aClass         = $aClass;
		$this->submenuSupport = $submenuSupport;
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$isEmpty     = ( $item->url && $item->url != '#' );
		$linkClasses = $this->name . '__link ' . $this->name . '__link--' . $depth . ( isset( $item->classes ) ? implode( ' ', $item->classes ) : '' ) . ' ' . $this->aClass;

		$output .= '<li class="' . ( $this->name . '__i ' . $this->name . '__i--' . $depth ) . ( isset( $item->classes ) ? implode( ' ', $item->classes ) : '' ) . ' ' . $this->liClass . '">';
		$output .= $isEmpty ? '<a class="' . $linkClasses . '" href="' . $item->url . '">' : '<span class="' . $linkClasses . ' ' . $this->name . '__link--no">';
		$output .= $item->title;

		if ( $this->submenuSupport && isset( $args->walker->has_children ) && $args->walker->has_children ) {
			$output .= '<svg class="menu__arrow" width="16" height="16"><use xlink:href="#arrow-down"></use></svg>';
		}

		$output .= $isEmpty ? '</a>' : '</span>';

		return $output;
	}
}
