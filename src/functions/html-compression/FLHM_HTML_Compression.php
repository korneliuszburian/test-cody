<?php

class FLHM_HTML_Compression {

	protected $flhm_compress_css    = true;
	protected $flhm_compress_js     = true;
	protected $flhm_info_comment    = true;
	protected $flhm_remove_comments = true;
	protected $html;

	public function __construct( $html ) {
		if ( ! empty( $html ) ) {
			$this->flhm_parseHTML( $html );
		}
	}

	public function __toString() {
		return $this->html;
	}

	public function flhm_parseHTML( $html ) {
		$this->html = $this->flhm_minifyHTML( $html );
		// if ($this->flhm_info_comment) {
		// $this->html .= "\n" . $this->flhm_bottomComment($html, $this->html);
		// }
	}

	protected function flhm_bottomComment( $raw, $compressed ) {
		$raw        = strlen( $raw );
		$compressed = strlen( $compressed );
		$savings    = ( $raw - $compressed ) / $raw * 100;
		$savings    = round( $savings, 2 );

		return '<!--HTML compressed, size saved ' . $savings . '%. From ' . $raw . ' bytes, now ' . $compressed . ' bytes-->';
	}

	protected function flhm_minifyHTML( $html ) {
		$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
		preg_match_all( $pattern, $html, $matches, PREG_SET_ORDER );
		$overriding = false;
		$raw_tag    = false;
		$html       = '';
		foreach ( $matches as $token ) {
			$tag     = ( isset( $token['tag'] ) ) ? strtolower( $token['tag'] ) : null;
			$content = $token[0];
			if ( is_null( $tag ) ) {
				if ( ! empty( $token['script'] ) ) {
					$strip = $this->flhm_compress_js;
				} elseif ( ! empty( $token['style'] ) ) {
					$strip = $this->flhm_compress_css;
				} elseif ( $content == '<!--wp-html-compression no compression-->' ) {
					$overriding = ! $overriding;
					continue;
				} elseif ( $this->flhm_remove_comments ) {
					if ( ! $overriding && $raw_tag != 'textarea' ) {
						$content = preg_replace( '/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content );
					}
				}
			} elseif ( $tag == 'pre' || $tag == 'textarea' ) {
					$raw_tag = $tag;
			} elseif ( $tag == '/pre' || $tag == '/textarea' ) {
				$raw_tag = false;
			} elseif ( $raw_tag || $overriding ) {
					$strip = false;
			} else {
				$strip   = true;
				$content = preg_replace( '/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content );
				$content = str_replace( ' />', '/>', $content );
			}
			if ( $strip ) {
				$content = $this->flhm_removeWhiteSpace( $content );
			}
			$html .= $content;
		}

		return $html;
	}

	protected function flhm_removeWhiteSpace( $str ) {
		$str = str_replace( "\t", ' ', $str );
		$str = str_replace( "\n", '', $str );
		$str = str_replace( "\r", '', $str );
		$str = str_replace( '// The customizer requires postMessage and CORS (if the site is cross domain).', '', $str );
		while ( stristr( $str, '  ' ) ) {
			$str = str_replace( '  ', ' ', $str );
		}

		return $str;
	}
}
