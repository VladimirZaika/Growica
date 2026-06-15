<?php
function gr_subscribe( $email = '', $id = '', $die = false, $name = '' ) {
    $email = sanitize_email( $_POST['email'] ?? $email );
    $name = sanitize_text_field( $_POST['name'] ?? $name ) ?? '';
    $id = isset($_POST['id']) ? filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) : $id;
    $id = intval($id);
    $apiKey = get_field( 'gr_api_key', 'options' );
    $campaignId = get_field( 'gr_campaign_id', 'options' );

    if ( $id ) {
        $blocks = parse_blocks( get_post( $id )->post_content );

        foreach ( $blocks as $block ) {
            if ( $block['blockName'] === 'acf/block-landing' ) {
                $apiKey = $block['attrs']['data']['gr_api_key'] ?: get_field( 'gr_api_key', 'options' );
                $campaignId = $block['attrs']['data']['gr_campaign_id'] ?: get_field( 'gr_campaign_id', 'options' );
            }
        }
    }

    $bodyRequest = [
            'email'     => $email,
            'campaign'  => [ 'campaignId' => $campaignId ],
        ];

    if ( !empty($name) ) {
        $bodyRequest['name'] = $name;
    }

    if ( empty( $email ) || !is_email( $email ) ) {
        $result = [ 'success' => false, 'message' => 'Invalid email' ];

        if ( !$die ) wp_send_json( $result, 400 );

        return $result;
    }

    if ( empty( $apiKey ) || empty( $campaignId ) ) {
        $result = [ 'success' => false, 'message' => 'Integration settings are not configured' ];

        if ( !$die ) wp_send_json( $result, 500 );

        return $result;
    }

    $response = wp_remote_post( 'https://api.getresponse.com/v3/contacts', [
        'headers' => [
            'X-Auth-Token' => 'api-key ' . $apiKey,
            'Content-Type' => 'application/json',
        ],
        'body'    => wp_json_encode( $bodyRequest ),
        'timeout' => 10,
    ]);

    if ( is_wp_error( $response ) ) {
        $result = [ 'success' => false, 'message' => 'Request error: ' . $response->get_error_message() ];

        if ( !$die ) wp_send_json( $result, 500 );

        return $result;
    }

    $code = wp_remote_retrieve_response_code( $response );
    $body = json_decode( wp_remote_retrieve_body( $response ), true );

    if ( $code === 202 ) {
        $result = [ 'success' => true ];

        if ( !$die ) wp_send_json( $result );

        return $result;
    }

    $result = [ 'success' => false, 'message' => $body['message'] ?? 'Unknown API error' ];

    if ( !$die ) wp_send_json( $result, $code ?: 500 );

    return $result;
}

add_action( 'wp_ajax_gr_subscribe', 'gr_subscribe' );
add_action( 'wp_ajax_nopriv_gr_subscribe', 'gr_subscribe' );
