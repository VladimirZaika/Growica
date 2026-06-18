<?php /**
 * Block Name: Hero Block
*
* This is the template that displays the Hero Block
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else:

    $sectionName = 'hero-brand';
    $blockId = wp_unique_id('block-');
    $sectionClass = get_field('custom_class') ? ' '.get_field('custom_class') : '';

    $bgc = get_field('section_bgc') ? 'background-color: ' . get_field('section_bgc') . ';' : false;
    $background = $bgc ? 'style="' . $bgc . '"' : false;
    $suddenBg = get_field('sudden_bg');

    $customHeading = get_field('heading_custom');
    $title = $customHeading ? get_field('custom_title') : get_the_title();
    $eyebrow = get_field('eyebrow');
    $content = get_field('section_content');
    $link = get_field('section_link');
    $btn = get_field('section_btn');
    $img = get_field('section_img');
    $imgMob = get_field('section_img_mob');

    if ( !empty($content) || !empty($title) || !empty($img) || !empty($imgMob) ): ?>
        <section
            class="section-<?= $sectionName . $sectionClass; ?>"

            <?php if ( $blockId ): ?>
                id="<?= $blockId; ?>"
            <?php endif;

            if ( $background ):
                echo $background;
            endif; ?>
        >
            <?php if ( $suddenBg ):
                $suddenBgDesk = get_field('sudden_bg_desk');
                $suddenBgMob = get_field('sudden_bg_mob');

                $bgArgs = [
                    'section' => $sectionName,
                    'img' => $suddenBgDesk,
                    'img_mob' => $suddenBgMob,
                ];

                get_template_part( 'components/image', null, $bgArgs );
            endif; ?>
            
            <div class="container <?= $sectionName; ?>-container">
                <?php if ( !empty($content) || !empty($title) ): ?>
                    <div class="left-block-desk">
                        <?php if ( !empty($eyebrow) ):
                            get_template_part( 'components/eyebrow', null, ['text' => $eyebrow] );
                        endif;

                        if ( !empty($title) ):
                            $titleSize = get_field('title_size') ?? 'h1'; ?>

                            <div class="title-wrapper">
                                <?= '<' . $titleSize . '>' . $title . '</' . $titleSize . '>'; ?>
                            </div>
                        <?php endif;

                        if ( !empty($content) ): ?>
                            <div class="content-wrapper">
                                <p><?= $content; ?></p>
                            </div>
                        <?php endif;

                        if ( !empty($link) || !empty($btn) ): ?>
                            <div class="btn-wrapper">
                                <?php
                                    if ( !empty($btn) ):
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
                                    endif;

                                    if ( !empty($link) ):
                                        $target = $link['target'] ? $link['target']: '_self';
                                        $url = $link['url'] ? $link['url']: '';
                                        $descr = $link['title'] ? $link['title']: '';
                                    
                                        $linkArgs = [
                                            'label' => $descr,
                                            'link' => $url,
                                            'target' => $target,
                                        ];

                                        get_template_part( 'components/link', null, $linkArgs );
                                    endif;
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif;

                if ( !empty($img) || !empty($imgMob) ):
                    $imgArgs = [
                        'img' => $img,
                        'img_mob' => $imgMob,
                    ]; ?>
                    
                    <div class="right-block-desk" data-position="mob-left">
                        <div class="img-wrapper">
                            <div class="img">
                                <?php get_template_part( 'components/image', null, $imgArgs ); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif;
endif; ?>