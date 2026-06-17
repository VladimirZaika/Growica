<?php
/**
 * Custom footer template (centered style)
 *
 * @package vibe
 */

$id = $args['id'] ?? get_the_ID();
$customClass = $args['customClass'] ?? '';
$showBg = $args['showBg'] ?? false;
$logoText = $args['logoText'] ?? '';
$hideNavMenu = $args['hideNavMenu'] ?? false;
$customNav = $args['customNav'] ?? false;
$landingNavMenu = $args['landingNavMenu'] ?? '';
$footerText = $args['footerText'] ?? '';
$copyright = $args['copyright'] ?? '';
?>

<footer class="footer footer-vibe footer-center<?= $customClass; ?>">
	<?php 
	if ( $showBg ):
		$suddenBgDesk = get_field('footer_bg_img_desk', $id);
		$suddenBgMob = get_field('footer_bg_img_mob', $id);

		$bgArgs = [
			'img' => $suddenBgDesk,
			'img_mob' => $suddenBgMob,
			'section' => 'footer-vibe',
		];

		get_template_part( 'components/image', null, $bgArgs );
	endif; 
	?>

	<div class="container footer-container grid-container">
		<div class="footer-wrapper footer-center-wrapper">
			<div class="footer-content-wrapper footer-center-content-wrapper">
				<div class="logo footer-logo">
					<?php 
					get_template_part( 'components/logo' );

					if ( ! empty( $logoText ) ): 
					?>
						<div class="after-logo">
							<span><?= $logoText; ?></span>
						</div>
					<?php 
					endif; 
					?>
				</div>

				<?php 
				if ( ! empty( $footerText ) ): 
				?>
					<div class="footer-content footer-center-content">
						<?= $footerText; ?>
					</div>
				<?php 
				endif; 
				?>

				<?php 
				if ( has_nav_menu( 'policy' ) ): 
				?>
					<div class="privacy-navigation-wrapper footer-center-policy">
						<?php 
						get_template_part( 'components/navigation', null, ['menu' => 'policy'] ); 
						?>
					</div>
				<?php 
				endif; 
				?>
			</div>

			<div class="copyright-wrapper footer-center-copyright">
				<?php 
				if ( ! empty( $copyright ) ): 
				?>
					<div class="copyright-item">
						<span><?php echo $copyright; ?></span>
					</div>
				<?php 
				endif; 
				?>
			</div>
		</div>
	</div>
</footer>
