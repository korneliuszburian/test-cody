<?php

class MiSVG extends MiBase {

	/** @var array Contains allowed extenstions for the file */
	private static $allowedExtensions = array( 'svg' );

	/**
	 * Initialize object
	 *
	 * @param string $url The URL to the image
	 * @param string $class 'class' attribute value for the image
	 * @param string $style 'style' attribute value for the image
	 * @param string $id 'id' attribute value for the image
	 * @return void
	 */
	public function __construct( string $url, ?string $class = null, ?string $style = null, ?string $id = null ) {
		$url = $this->ValidateFile( $url, self::$allowedExtensions );
		parent::__construct( $url, $class, $style, $id );

		$this->url = str_replace( home_url(), '', $this->url );
	}

	/**
	 * Calculates proportions for given parameter
	 *
	 * @param int $x Parameter "x" to calculate
	 * @param int $variant Changes which attribute is the value divided by
	 * @return int
	 */
	private function CalculateProportion( int $x, int $variant ): int {
		$res = $variant == 1 ? ( $this->attributes['height'] / $this->attributes['width'] )
			: ( $variant == 2 ? ( $this->attributes['width'] / $this->attributes['height'] ) : 0 );

		return $x * $res;
	}

	/**
	 * Method that changes the image size keeping valid proportions. Do not use both parameters at the same time.
	 *
	 * @param ?int $width Custom image width
	 * @param ?int $height Custom image height
	 * @return MiSVG
	 */
	public function UseCustomSize( ?int $width = null, ?int $height = null ) {
		if ( $width ) {
			$prop                       = $this->CalculateProportion( $width, 1 );
			$this->attributes['width']  = $width;
			$this->attributes['height'] = $prop;
		}

		if ( $height ) {
			$prop                       = $this->CalculateProportion( $height, 2 );
			$this->attributes['height'] = $height;
			$this->attributes['width']  = $prop;
		}

		return $this;
	}

	/**
	 * Method responsible for outputing the image
	 *
	 * @return void
	 */
	public function Draw() {
		$id             = $this->attributes['id'] ? " id=\"{$this->attributes['id']}\"" : '';
		$autoWidthClass = $this->isAutoWidth ? 'w-100' : '';

		$output =
			"<img 
                {$id}
                width=\"{$this->attributes['width']}\" 
                height=\"{$this->attributes['height']}\"
                class=\"ar d-flex lazyload {$autoWidthClass} {$this->attributes['class']}\"
                data-src=\"{$this->url}\"
                src=\"#\"
                alt=\"{$this->attributes['alt']}\"
                style=\"aspect-ratio: {$this->attributes['width']}/{$this->attributes['height']};{$this->attributes['style']}\">";

		echo $output;
	}
}
