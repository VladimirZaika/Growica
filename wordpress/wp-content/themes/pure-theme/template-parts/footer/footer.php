<?php
/**
 * The footer
 *
 * @package brand
 */
$currentTerm = get_queried_object();

$id = get_the_ID();
$insertAfterFooterCode = get_field('insert_after_footer_code', 'options');
$footerText = get_field('footer_text', 'options');
$copyright = get_field('copyright', 'options');
$logoText = get_field('footer_logo_text', 'options');
$suddenBg = get_field('sudden_bg', 'options');
$showBg = get_field('show_footer_bg_img', $id);
$customClass = get_field('footer_custom_class', $id) ? ' ' . get_field('footer_custom_class', $id) : '';
$hideNavMenu = false;
$customNav = get_field('custom_nav', $id);
$landingNavMenu = get_field('landing_nav_menu', $id);
$footerStyle = get_field('footer_style', $id);

 ?>
        <!-- Main end -->
        </main>
            <?php if ( !$footerStyle ): ?>
                <footer class="footer<?= $customClass; ?> footer-brand">
                    <?php if ( $showBg ):
                        $suddenBgDesk = get_field('footer_bg_img_desk', $id);
                        $suddenBgMob = get_field('footer_bg_img_mob', $id);
                    
                        $bgArgs = [
                            'img' => $suddenBgDesk,
                            'img_mob' => $suddenBgMob,
                            'section' => 'footer-brand',
                        ];

                        get_template_part( 'components/image', null, $bgArgs );
                    endif; ?>

                    <div class="container footer-container grid-container">
                        <div class="footer-wrapper">
                            <div class="footer-content-wrapper<?= $hideNavMenu ? ' footer-content-wrapper-full-width' : ''; ?>">
                                <div class="logo footer-logo">
                                    <?php get_template_part( 'components/logo' );

                                    if ( !empty($logoText) ): ?>
                                        <div class="after-logo">
                                            <span><?= $logoText; ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ( !empty($footerText) ): ?>
                                    <div class="footer-content">
                                        <?= $footerText; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ( !$hideNavMenu ): ?>
                                <div class="navigation-wrapper">
                                    <?php if ( !$customNav ):
                                        if ( has_nav_menu( 'primary' ) ): ?>
                                            <div class="menu-column">
                                                <span class="menu-title"><?php _e('Menu', 'nexus'); ?></span>
                                                <?php get_template_part( 'components/navigation', null, ['menu' => 'company'] ); ?>
                                            </div>
                                        <?php endif;
                                    else: ?>
                                        <div class="menu-column">
                                            <span class="menu-title"><?php _e('Menu', 'nexus'); ?></span>
                                            <?php get_template_part( 'components/navigation', null, ['menu' => $landingNavMenu] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="copyright-wrapper">
                            <?php if ( has_nav_menu( 'policy' ) ): ?>
                                <div class="privacy-navigation-wrapper">
                                    <?php
                                        get_template_part( 'components/navigation', null, ['menu' => 'policy'] );
                                    ?>
                                </div>
                            <?php endif;

                            if ( !empty($copyright) ): ?>
                                <div class="copyright-item">
                                    <span><?php echo $copyright; ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </footer>
            <?php else: ?>
                <footer class="footer footer-brand footer-center<?= $customClass; ?>">
                    <?php if ( $showBg ):
                        $suddenBgDesk = get_field('footer_bg_img_desk', $id);
                        $suddenBgMob = get_field('footer_bg_img_mob', $id);

                        $bgArgs = [
                            'img' => $suddenBgDesk,
                            'img_mob' => $suddenBgMob,
                            'section' => 'footer-brand',
                        ];

                        get_template_part( 'components/image', null, $bgArgs );
                    endif; ?>

                    <div class="container footer-container grid-container">
                        <div class="footer-wrapper footer-center-wrapper">
                            <div class="footer-content-wrapper footer-center-content-wrapper">
                                <div class="logo footer-logo">
                                    <?php get_template_part( 'components/logo' );

                                    if ( !empty($logoText) ): ?>
                                        <div class="after-logo">
                                            <span><?= $logoText; ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ( !empty($footerText) ): ?>
                                    <div class="footer-content footer-center-content">
                                        <?= $footerText; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( has_nav_menu( 'policy' ) ): ?>
                                    <div class="privacy-navigation-wrapper footer-center-policy">
                                        <?php get_template_part( 'components/navigation', null, ['menu' => 'policy'] ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="copyright-wrapper footer-center-copyright">
                                <?php if ( !empty($copyright) ): ?>
                                    <div class="copyright-item">
                                        <span><?php echo $copyright; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </footer>
            <?php endif; ?>
        <!-- Wrapper End -->
        </div>

        <?php
            echo $insertAfterFooterCode;

            wp_footer();
        ?>
    </body>
</html>