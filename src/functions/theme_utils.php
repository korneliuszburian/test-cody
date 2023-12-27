<?php

/**
 * Gets data from flexible layout, searching in all fields
 * example use: GetDataByAcfFcLayoutName(get_fields($frontpage_id), "flexible-landing", "realisations");
 *
 * @param array  $data Fields from get_fields() method
 * @param string $fcName Name of flexible content field
 * @param string $layoutName Name of flexible content layout you want data from
 * @return array|null
 */
function GetDataByAcfFcLayoutName( array $data, string $fcName, string $layoutName ) {
	if ( ! isset( $data[ $fcName ] ) ) {
		return null;
	}

	foreach ( $data[ $fcName ] as $item ) {
		if ( isset( $item['acf_fc_layout'] ) && $item['acf_fc_layout'] === $layoutName ) {
			return $item;
		}
	}
}

/**
 * Notice (or error) for editors
 *
 * @return void Displays the notice via echo
 */
function editor_notice( string $message, bool $fromComponent = false ) {
	$bt = debug_backtrace();

	if ( $fromComponent ) {
		foreach ( $bt as $element ) {
			if ( isset( $element['function'] ) && $element['function'] === 'get_component' ) {
				$file = $element['file'];
				$line = $element['line'];
			}
		}
	} else {
		$caller = array_shift( $bt );
		$line   = $caller['line'];
		$file   = $caller['file'];
	}

	$file_path = str_replace( get_template_directory(), '', $file );
	$url       = UTM_GITHUB . $file_path . '#L' . $line;

	echo '<div class="msg"><strong>Uwaga: </strong>' . $message . ' <a href="' . $url . '" target="_blank" rel="noopener noreferrer"><strong>[' . $file_path . ', line: ' . $line . ']</strong></a></div>';
}

/**
 * Echoes <script> element with splide js (minified)
 *
 * @return void Async script tag
 */
function splide_script_async() {
	echo '<script src="' . get_template_directory_uri() . '/assets/splide-4.1.3/splide-extension-grid.min.js" async onload="splideLoaded=true;"></script>';
	echo '<script src="' . get_template_directory_uri() . '/assets/splide-4.1.3/splide.min.js" async onload="splideLoaded=true;"></script>';
}

/**
 * Dumps data into file (useful when debugging hooks)
 *
 * @param string $fileName File name you want to use. File is saved in "logs" folder, as a *.log file
 * @param mixed  $data Data you want to debug
 * @return void Puts content into file
 */
function dump_log( string $fileName, mixed $data ) {
	$log_file_path = get_stylesheet_directory() . "/logs/$fileName.log";

	ob_start();
	print_r( $data );
	$output = ob_get_clean();

	file_put_contents( $log_file_path, $output, FILE_APPEND );
}

/**
 * Gets development display year or years (for footer)
 *
 * @param int $devYear Year when the website was created
 * @return string Display with year, or years range
 */
function get_dev_display_year( int $devYear ) {
	$current_date = date( 'Y' );
	return $current_date > $devYear ? $devYear . ' - ' . $current_date : $devYear;
}

/**
 * Gets component from default component folder. Extension of get_template_part()
 *
 * @param string  $slug The slug name for the generic component
 * @param ?string $name The name of the specialised template
 * @param array   $slug Optional. Additional arguments passed to the template. Default empty array.
 * @return void|false Void on success, false if the template does not exist
 */
function get_component( string $slug, ?string $name = \null, array $args = [] ) {
	return get_template_part( 'template-parts/components/' . $slug, $name, $args );
}

/**
 * Gets input string and searches for global field if using "{{xxx}}" syntax
 * (e.g., {{fieldName}}), retrieves corresponding data using get_field
 *
 * @param string $inputString The input string potentially containing patterns to be replaced.
 * @param bool   $multipleUse if false, then replaces whole string with found global field
 * @return string The modified string with all replacements (if any) done.
 */
function get_with_globals( string $inputString, bool $multipleUse = true ) {
	// This pattern matches all occurrences of {{...}}
	$pattern = '/\{\{(.*?)\}\}/';

	// Use preg_match_all to find all matches
	if ( preg_match_all( $pattern, $inputString, $matches, PREG_SET_ORDER ) ) {
		foreach ( $matches as $match ) {
			// Extract the field name
			$fieldName = $match[1];

			// Get the replacement data
			$data = get_field( $fieldName, 'options' );

			// If data is found, replace in the original string
			if ( $data ) {
				if ( $multipleUse ) {
					$inputString = str_replace( $match[0], $data, $inputString );
				} else {
					$inputString = $data;
				}
			}
		}
	}

	return $inputString;
}

/**
 * Searches for resource in "/assets/" and prints it
 *
 * @param string $fileName Path to file (from "/theme/assets/")
 * @param string $type "script" or "style"
 * @return string|null
 */
function try_attach_resource( string $fileName, string $type = 'script' ) {
	$filePath = get_template_directory() . '/assets/' . $fileName;
	if ( file_exists( $filePath ) ) {
		echo "<$type>" . file_get_contents( $filePath ) . "</$type>";
	}
}

class Buttonable {


	public string $label;
	public string $tag = 'a';

	private string $_url;
	private string $_title;
	private string $_target;
	private string $_rel;
	private string $_style;

	public static function FromLink( array $link_clone ) {
		$instance        = new self();
		$instance->label = $link_clone['label'];
		if ( $link_clone['ref'] ) {
			$instance->_url    = $link_clone['ref']['url'];
			$instance->_title  = $link_clone['ref']['title'];
			$instance->_target = $link_clone['ref']['target'];
		}
		$instance->_rel = $link_clone['rel'];
		$instance->tag  = empty( $instance->_url ) ? 'span' : 'a';

		return $instance;
	}

	public static function FromButton( array $button_clone ) {
		$instance         = new self();
		$instance         = $instance->fromLink( $button_clone['link'] );
		$instance->_style = $button_clone['style'];

		return $instance;
	}

	public function GetButtonClasses() {
		$style       = $this->_style;
		$style_class = '';

		if ( $style != 'none' ) {
			$style_class = "btn btn--$style f-alt f-600 t-lo d-inline-flex aic";

			if ( $style == 'def' ) {
				$style_class .= ' c-def';
			}

			if ( $style == 'alt' ) {
				$style_class .= ' c-alt';
			}
		}

		return ! empty( $style_class ) ? $style_class : '';
	}

	public function GetLinkAttributes() {
		$has_url    = ! empty( $this->_url );
		$has_title  = ! empty( $this->_title ) && $has_url;
		$has_target = ! empty( $this->_target ) && $has_url;
		$has_rel    = ! empty( $this->_rel ) && $has_url;

		$code  = $has_url ? 'href="' . get_with_globals( $this->_url, false ) . '"' : null;
		$code .= $has_title ? ' title="' . $this->_title . '"' : null;
		$code .= $has_target ? ' target="' . $this->_target . '"' : null;
		$code .= $has_rel ? ' rel="' . $this->_rel . '"' : null;

		return $code;
	}
}

function groupServiceItems( $posts ) {
	$grouped   = [];
	$parentMap = [];

	// First, identify and store parent posts
	foreach ( $posts as $post ) {
		if ( $post->post_parent == 0 ) {
			$groupedItem             = new stdClass();
			$groupedItem->post_title = $post->post_title;
			$groupedItem->post_name  = $post->post_name;
			$groupedItem->ID         = $post->ID;
			$groupedItem->items      = [];

			$grouped[]              = $groupedItem;
			$parentMap[ $post->ID ] = &$grouped[ count( $grouped ) - 1 ];
		}
	}

	// Then, assign child posts to their respective parents
	foreach ( $posts as $post ) {
		if ( $post->post_parent != 0 && isset( $parentMap[ $post->post_parent ] ) ) {
			$parentPost            = &$parentMap[ $post->post_parent ];
			$childPost             = new stdClass();
			$childPost->post_title = $post->post_title;
			$childPost->post_name  = $post->post_name;
			$childPost->ID         = $post->ID;

			$parentPost->items[] = $childPost;
		}
	}

	return $grouped;
}

function GetGlobalSectionValue( string $fieldName, bool $fromGlobals = true ) {
	return $fromGlobals ? get_field( $fieldName, 'options' ) : get_sub_field( $fieldName );
}

// function GetSpecialSectionValues(string $sectionName, array $fieldNames, bool $fromOptions = false): array
// {
// $result = [];

// if (get_sub_field($sectionName . '-default') || $fromOptions) {
// foreach ($fieldNames as $fieldName) {
// $result[$fieldName] = get_field($sectionName . '-' . $fieldName, 'option');
// }
// } else {
// foreach ($fieldNames as $fieldName) {
// $result[$fieldName] = get_sub_field($sectionName . '-' . $fieldName);
// }
// }

// return $result;
// }

// add_filter('gettext', 'custom_translate_text', 20, 3);
// function custom_translate_text($translated_text, $text, $domain)
// {
// Check if we are in the admin area and the text domain is for Contact Form 7
// if (is_admin() && 'contact-form-7' === $domain) {
// switch ($translated_text) {
// case 'Kontakt':
// $translated_text = 'Formularze';
// break;
// }
// }
// return $translated_text;
// }
