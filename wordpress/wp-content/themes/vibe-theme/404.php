<?php
get_header();

$sectionName = 'not-found';

$content = get_field('404_content', 'options');
$btn = get_field('404_btn', 'options');
$suddenBg = get_field('sudden_bg_404', 'options');

if ( !empty($content) || !empty($btn) ): ?>
    <section class="section section-<?php  echo $sectionName; ?>">
        <div class="container <?php echo $sectionName; ?>-container">
            <?php if ( $suddenBg ):
                $suddenBgDesk = get_field('sudden_bg_404_desk', 'options');
                $suddenBgMob = get_field('sudden_bg_404_mob', 'options');
                $suddenBgDesk_2 = get_field('sudden_bg_404_desk_2', 'options');
                $suddenBgMob_2 = get_field('sudden_bg_404_mob_2', 'options');
            
                $bgArgs = [
                    'img' => $suddenBgDesk,
                    'img_mob' => $suddenBgMob,
                    'section' => $sectionName,
                ];

                $bgArgs_2 = [
                    'img' => $suddenBgDesk_2,
                    'img_mob' => $suddenBgMob_2,
                    'section' => 'sudden-bg-wrapper-second ' . $sectionName,
                ];

                get_template_part( 'components/image', null, $bgArgs );
                get_template_part( 'components/image', null, $bgArgs_2 );
            endif; ?>

            <?php if ( !empty($content) ): ?>
                <div class="content-wrapper"><?= kison_prepare_macros( $content ); ?></div>
            <?php endif;

            if ( !empty($btn) ): ?>
                <div class="btn-wrapper">
                    <?php
                        $target = $btn['target'] ? $btn['target']: '_self';
                        $url = $btn['url'] ? $btn['url']: '';
                        $descr = $btn['title'] ? $btn['title']: '';
                    
                        $btnArgs = [
                            'label' => $descr,
                            'type' => 'primary',
                            'link' => $url,
                            'target' => $target,
                        ];

                        get_template_part( 'components/button', null, $btnArgs );
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif;

get_footer();
