<?php /**
 * Block Name: CTA Block
*
* This is the template that displays the CTA Block
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else:
    $sectionName = 'cta';
    $blockId = wp_unique_id('block-');
    $sectionClass = get_field('custom_class') ? ' '.get_field('custom_class') : '';

    $bgc = get_field('section_bgc') ? 'background-color: ' . get_field('section_bgc') . ';' : false;
    $background = $bgc ? 'style="' . $bgc . '"' : false;
    $bgImg = get_field('section_bg_img');
    $bgImgMob = get_field('section_bg_img_mob');

    $gallery = get_field('gallery');

    $customHeading = get_field('heading_custom');
    $title = $customHeading ? get_field('custom_title') : get_the_title();
    $content = get_field('section_content');

    $btn = get_field('section_btn');

    $popupTitle = get_field('popup_title');
    $popupText = get_field('popup_text');
    $popupImg = get_field('popup_img');
    $popupBtn = get_field('popup_btn');

    $suddenBg = get_field('sudden_bg_cta');

    if ( !empty($content) || !empty($title) || !empty($btn) ): ?>
        <section
            class="section-<?= $sectionName . $sectionClass; ?>"

            <?php if ( $blockId ): ?>
                id="<?= $blockId; ?>"
            <?php endif;

            if ( $background ):
                echo $background;
            endif; ?>
        >
            <div class="container <?= $sectionName; ?>-container">
                <?php if ( $suddenBg ):
                    $suddenBgDesk = get_field('sudden_bg_cta_desk');
                    $suddenBgMob = get_field('sudden_bg_cta_mob');

                    $bgArgs = [
                        'img' => $suddenBgDesk,
                        'img_mob' => $suddenBgMob,
                        'section' => $sectionName,
                    ];

                    get_template_part( 'components/image', null, $bgArgs );
                endif; ?>
            
                <div class="cta">
                    <?php if ( !empty($bgImg) || !empty($bgImgMob) ):
                        $bgArgs = [
                            'img' => $bgImg,
                            'img_mob' => $bgImgMob,
                        ]; ?>

                        <div class="bg-img-wrapper">
                            <?php get_template_part( 'components/image', null, $bgArgs ); ?>
                        </div>
                    <?php endif;

                    if ( !empty($title) ):
                        $titleSize = get_field('title_size') ?? 'h1'; ?>

                        <div class="title-wrapper text-center">
                            <?= '<' . $titleSize . '>' . $title . '</' . $titleSize . '>'; ?>
                        </div>
                    <?php endif;

                    if ( !empty($content) ): ?>
                        <div class="content-wrapper text-center">
                            <p><?= $content; ?></p>
                        </div>
                    <?php endif;

                    if ( !empty($btn) ): ?>
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
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif;
endif; ?>