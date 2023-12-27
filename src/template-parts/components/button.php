<?php
/**
 * Button component
 *
 * @param array $args
 *
 * @package WordPress
 */

$url     = isset( $args['url'] ) ? $args['url'] : '';
$icon    = isset( $args['icon'] ) ? $args['icon'] : '';
$label   = isset( $args['label'] ) ? $args['label'] : '';
$is_left = isset( $args['isLeft'] ) ? $args['isLeft'] : false;
$class   = isset( $args['class'] ) ? '' . $args['class'] : '';
$target  = isset( $args['target'] ) ? $args['target'] : '';

?>

<a href="<?php echo $url; ?>" <?php echo $target ? ' target="' . $target . '" ' : ' '; ?> class="<?php echo $class; ?>">
	<?php echo $icon; ?>
	<span class="<?php echo $class; ?>__content d-block">
		<?php echo $label; ?>
	</span>
</a>
