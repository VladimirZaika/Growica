<?php
/**
 * Custom header template (centered style)
 *
 * @package vibe
 */

$logoText = $args['logoText'] ?? '';
$customNav = $args['customNav'] ?? false;
$landingNavMenu = $args['landingNavMenu'] ?? '';
$enrollLink = $args['enrollLink'] ?? [];
$registerLink = $args['registerLink'] ?? [];
?>

<header class="header header-vibe header-center">
	<div class="header-container-vibe container grid-container">
		<div class="header-center-group">
			<div class="logo header-logo">
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

			<div class="header-menu-wrapper header-center-menu">
				<div class="header-menu menu menu-body">
					<div class="mobile-menu-wrapper">
						<?php 
						if ( !$customNav ):
							if ( has_nav_menu( 'primary' ) ): 
							?>
								<div class="nav-mobile-wrapper">
									<?php 
									get_template_part( 'components/navigation' ); 
									?>
								</div>
							<?php 
							endif;
						else: 
						?>
							<div class="nav-mobile-wrapper">
								<?php 
								get_template_part( 'components/navigation', null, ['menu' => $landingNavMenu] ); 
								?>
							</div>
						<?php 
						endif;

						if ( ! empty( $enrollLink ) ):
							$target = $enrollLink['target'] ? $enrollLink['target'] : '_self';
							$url = $enrollLink['url'] ? $enrollLink['url'] : '';
							$descr = $enrollLink['title'] ? $enrollLink['title'] : '';
							$btnArgs = [
								'label' => $descr,
								'type' => 'primary',
								'link' => $url,
								'target' => $target,
							];
						?>

							<div class="btn-wrapper">
								<?php 
								get_template_part( 'components/button', null, $btnArgs ); 
								?>
							</div>
						<?php 
						endif; 
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="header-right-panel">
			<?php 
			if ( ! empty( $registerLink ) ):
				$target = $registerLink['target'] ? $registerLink['target'] : '_self';
				$url = $registerLink['url'] ? $registerLink['url'] : '';
				$descr = $registerLink['title'] ? $registerLink['title'] : '';
				$btnArgs = [
					'label' => $descr,
					'type' => 'secondary',
					'link' => $url,
					'target' => $target,
				];
			?>
			<div class="header-link">
				<?php 
				get_template_part( 'components/button', null, $btnArgs ); 
				?>
			</div>
			<?php 
			endif; 
			?>
			<div class="header-menu-button">
				<button type="button" title="Icon menu" class="icon-menu"><span></span></button>
			</div>
		</div>
	</div>
</header>
