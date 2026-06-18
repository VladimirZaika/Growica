<?php
/**
 * Default footer template
 *
 * @package brand
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

<footer class="footer<?= $customClass; ?> footer-brand">
	<?php 
	if ( $showBg ):
		$suddenBgDesk = get_field('footer_bg_img_desk', $id);
		$suddenBgMob = get_field('footer_bg_img_mob', $id);
		
		$bgArgs = [
			'img' => $suddenBgDesk,
			'img_mob' => $suddenBgMob,
			'section' => 'footer-brand',
		];

		get_template_part( 'components/image', null, $bgArgs );
	endif; 
	?>

	<div class="container footer-container grid-container">
		<div class="footer-wrapper">
			<div class="footer-content-wrapper<?= $hideNavMenu ? ' footer-content-wrapper-full-width' : ''; ?>">
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
					<div class="footer-content">
						<?= $footerText; ?>
					</div>
				<?php 
				endif; 
				?>
			</div>

			<?php 
			if ( ! $hideNavMenu ): 
			?>
				<div class="navigation-wrapper">
					<?php 
					if ( ! $customNav ):
						if ( has_nav_menu( 'primary' ) ): 
						?>
							<div class="menu-column">
								<span class="menu-title"><?php _e( 'Menu', 'nexus' ); ?></span>
								<?php 
								get_template_part( 'components/navigation', null, ['menu' => 'company'] ); 
								?>
							</div>
						<?php 
						endif;
					else: 
					?>
						<div class="menu-column">
							<span class="menu-title"><?php _e( 'Menu', 'nexus' ); ?></span>
							<?php 
							get_template_part( 'components/navigation', null, ['menu' => $landingNavMenu] ); 
							?>
						</div>
					<?php 
					endif; 
					?>
				</div>
			<?php 
			endif; 
			?>
		</div>

		<div class="copyright-wrapper">
			<?php 
			if ( has_nav_menu( 'policy' ) ): 
			?>
				<div class="privacy-navigation-wrapper">
					<?php
						get_template_part( 'components/navigation', null, ['menu' => 'policy'] );
					?>
				</div>
			<?php 
			endif;

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
</footer>
