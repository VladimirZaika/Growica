<?php
/**
 * The header
 *
 * @package nexus
 */

$id = get_the_ID();

$headerSwitch = get_field('header_switch', $id);
$bodyClass = get_field('body_custom_class', $id);

$registerLink = get_field('register_link', 'options');
$enrollLink = get_field('enroll_link', 'options');

$insertHeaderCode = get_field('insert_header_code', 'options');
$insertAfterBodyCode = get_field('insert_after_body_code', 'options');

$background = false;

$logoText = get_field('header_logo_text', 'options');

$customNav = get_field('custom_nav', $id);
$landingNavMenu = get_field('landing_nav_menu', $id);

$headerStyle = get_field('header_style', $id);

if ( is_page() && has_post_thumbnail() ):
    $bg = 'background-image: url(' . get_the_post_thumbnail_url(null, 'full') . ');';
    $background = ' style="' . $bg . '"';
endif;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php
		if ( !empty($insertHeaderCode) ):
			echo $insertHeaderCode;
		endif;

		wp_head();
	?>
</head>

<body <?php body_class( $bodyClass ); ?>>
	<?php
		wp_body_open();

		if ( !empty($insertAfterBodyCode) ):
			echo $insertAfterBodyCode;
		endif;
	?>
	<!-- Wrapper start -->
	<div class="wrapper"
		<?php
			if ( $background ):
                echo $background;
            endif;
		?>
	>
		<?php 
		$headerArgs = [
			'logoText' => $logoText,
			'customNav' => $customNav,
			'landingNavMenu' => $landingNavMenu,
			'enrollLink' => $enrollLink,
			'registerLink' => $registerLink,
		];

		if ( ! $headerStyle ): 
			get_template_part( 'template-parts/header/header', 'default', $headerArgs );
		else: 
			get_template_part( 'template-parts/header/header', 'custom', $headerArgs );
		endif; 
		?>
