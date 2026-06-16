<?php
/**
 * The header
 *
 * @package brand
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
		<?php if ( !$headerStyle ): ?>
			<header class="header header-brand">
				<div class="header-container-brand container grid-container">
					<div class="logo header-logo">
						<?php get_template_part( 'components/logo' );

						if ( !empty($logoText) ): ?>
							<div class="after-logo">
								<span><?= $logoText; ?></span>
							</div>
						<?php endif; ?>
					</div>
					
					<div class="header-menu-wrapper">
						<div class="header-menu menu menu-body">
							<div class="mobile-menu-wrapper">
								<?php if ( !$customNav ):
									if ( has_nav_menu( 'primary' ) ): ?>
										<div class="nav-mobile-wrapper">
											<?php
												get_template_part( 'components/navigation' );
											?>
										</div>
									<?php endif;
								else: ?>
									<div class="nav-mobile-wrapper">
										<?php
											get_template_part( 'components/navigation', null, ['menu' => $landingNavMenu] );
										?>
									</div>
								<?php endif;

								if ( !empty($enrollLink) ):
									$target = $enrollLink['target'] ? $enrollLink['target']: '_self';
									$url = $enrollLink['url'] ? $enrollLink['url']: '';
									$descr = $enrollLink['title'] ? $enrollLink['title']: '';
									
										$btnArgs = [
											'label' => $descr,
											'type' => 'primary',
											'link' => $url,
											'target' => $target,
										];
									?>

									<div class="btn-wrapper">
										<?php get_template_part( 'components/button', null, $btnArgs ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<?php if ( !empty($registerLink) ):
						$target = $registerLink['target'] ? $registerLink['target']: '_self';
						$url = $registerLink['url'] ? $registerLink['url']: '';
						$descr = $registerLink['title'] ? $registerLink['title']: '';
						
							$btnArgs = [
								'label' => $descr,
								'type' => 'secondary',
								'link' => $url,
								'target' => $target,
							];
						?>

						<div class="header-link">
							<?php get_template_part( 'components/button', null, $btnArgs ); ?>
						</div>
					<?php endif; ?>

					<div class="header-menu-button">
						<button type="button" title="Icon menu" class="icon-menu"><span></span></button>
					</div>

				</div>
			</header>
		<?php else: ?>
			<header class="header header-brand header-center">
				<div class="header-container-brand container grid-container">
					<div class="header-center-group">
						<div class="logo header-logo">
							<?php get_template_part( 'components/logo' );

							if ( !empty($logoText) ): ?>
								<div class="after-logo">
									<span><?= $logoText; ?></span>
								</div>
							<?php endif; ?>
						</div>

						<div class="header-menu-wrapper header-center-menu">
							<div class="header-menu menu menu-body">
								<div class="mobile-menu-wrapper">
									<?php if ( !$customNav ):
										if ( has_nav_menu( 'primary' ) ): ?>
											<div class="nav-mobile-wrapper">
												<?php get_template_part( 'components/navigation' ); ?>
											</div>
										<?php endif;
									else: ?>
										<div class="nav-mobile-wrapper">
											<?php get_template_part( 'components/navigation', null, ['menu' => $landingNavMenu] ); ?>
										</div>
									<?php endif;

									if ( !empty($enrollLink) ):
										$target = $enrollLink['target'] ? $enrollLink['target']: '_self';
										$url = $enrollLink['url'] ? $enrollLink['url']: '';
										$descr = $enrollLink['title'] ? $enrollLink['title']: '';
										$btnArgs = [
											'label' => $descr,
											'type' => 'primary',
											'link' => $url,
											'target' => $target,
										];
									?>

									<div class="btn-wrapper">
										<?php get_template_part( 'components/button', null, $btnArgs ); ?>
									</div>
								<?php endif; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="header-right-panel">
						<?php if ( !empty($registerLink) ):
							$target = $registerLink['target'] ? $registerLink['target']: '_self';
							$url = $registerLink['url'] ? $registerLink['url']: '';
							$descr = $registerLink['title'] ? $registerLink['title']: '';
							$btnArgs = [
								'label' => $descr,
								'type' => 'secondary',
								'link' => $url,
								'target' => $target,
							];
						?>
						<div class="header-link">
							<?php get_template_part( 'components/button', null, $btnArgs ); ?>
						</div>
					<?php endif; ?>
					<div class="header-menu-button">
						<button type="button" title="Icon menu" class="icon-menu"><span></span></button>
					</div>
				</div>
				</div>
			</header>
		<?php endif; ?>
