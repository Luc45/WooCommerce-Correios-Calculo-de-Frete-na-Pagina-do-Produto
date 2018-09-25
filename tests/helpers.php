<?php

/**
 * Sends an AJAX request for testing
 */
function cfpp_ajax_test(string $action, array $data) {
    $post = array(
        'action' => $action,
        'data' => $data
    );

    $ch = curl_init('http://cfpp.localhost:81/wp-admin/admin-ajax.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);

    return json_decode($response, true);
}
