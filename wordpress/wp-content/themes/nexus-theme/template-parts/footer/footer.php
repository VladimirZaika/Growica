<?php
/**
 * The footer
 *
 * @package nexus
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
        <?php 
        $footerArgs = [
            'id' => $id,
            'customClass' => $customClass,
            'showBg' => $showBg,
            'logoText' => $logoText,
            'hideNavMenu' => $hideNavMenu,
            'customNav' => $customNav,
            'landingNavMenu' => $landingNavMenu,
            'footerText' => $footerText,
            'copyright' => $copyright,
        ];

        if ( ! $footerStyle ): 
            get_template_part( 'template-parts/footer/footer', 'default', $footerArgs );
        else: 
            get_template_part( 'template-parts/footer/footer', 'custom', $footerArgs );
        endif; 
        ?>
        <!-- Wrapper End -->
        </div>

        <?php
            echo $insertAfterFooterCode;

            wp_footer();
        ?>
    </body>
</html>