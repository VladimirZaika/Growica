<?php
/**
 * Default header template
 *
 * @package nexus
 */

$logoText = $args['logoText'] ?? '';
$customNav = $args['customNav'] ?? false;
$landingNavMenu = $args['landingNavMenu'] ?? '';
$enrollLink = $args['enrollLink'] ?? [];
$registerLink = $args['registerLink'] ?? [];
?>

<header class="header header-nexus">
	<div class="header-container-nexus container grid-container">
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
		
		<div class="header-menu-wrapper">
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
</header>
