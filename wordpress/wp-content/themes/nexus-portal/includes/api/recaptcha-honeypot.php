<?php
function check_form() {
    $errTxt = 'Bot detected';
    $minScore = defined('RECAPTCHA_MIN_SCORE') ? RECAPTCHA_MIN_SCORE : 0.7;

    if ( !empty($_POST['hpv']) ) {
        wp_send_json( [
            'bot_detected' => true,
            'reason' => 'honeypot',
        ] );
    }

    $token  = $_POST['recaptcha_token'] ?? '';
    $action = $_POST['recaptcha_action'] ?? '';
    $secret = get_field('gr_recaptcha_secret_key', 'options');

    if ( !$token || !$secret ) {
        wp_send_json( [
            'bot_detected' => false,
            'reason' => 'recaptcha_skipped',
        ] );
    }

    $verify = wp_remote_post(
        'https://www.google.com/recaptcha/api/siteverify',

        [
            'body' => [
                'secret'   => $secret,
                'response' => $token,
                'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
            ],

            'timeout' => 10,
        ]
    );

    if ( is_wp_error($verify) ) {
        wp_send_json( [
            'bot_detected' => false,
            'reason' => 'recaptcha_error',
        ] );
    }

    $body = json_decode( wp_remote_retrieve_body($verify), true );

    if (
        empty($body['success']) ||
        $body['score'] < $minScore ||
        $body['action'] !== $action
    ) {
        wp_send_json( [
            'bot_detected' => true,
            'reason' => 'recaptcha_failed',
            'score' => $body['score'] ?? null,
        ] );
    }

    wp_send_json( [
        'bot_detected' => false,
        'score' => $body['score'],
    ] );
}

add_action( 'wp_ajax_check_form', 'check_form' );
add_action( 'wp_ajax_nopriv_check_form', 'check_form' );