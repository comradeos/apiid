<?php

function curl_get_response() 
{
    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/api.php",
        CURLOPT_HEADER => 1,
        CURLOPT_NOBODY => 1,
        CURLOPT_RETURNTRANSFER => 1,
    ];
    
    curl_setopt_array($curl, $options);
    curl_exec($curl);
    $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($errors = curl_error($curl)) {
        echo $errors;
    } else {
        echo $response . "<hr>";
    }
    curl_close($curl); 
}

function curl_get()
{
    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/api.php",
        CURLOPT_RETURNTRANSFER => 1,
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);

    if ($errors = curl_error($curl)) {
        echo $errors;
    } else {
        echo $response . "<hr>";
    }
    curl_close($curl);
}


function curl_post()
{
    $data_list = [
        "id" => 123,
    ];
    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/api.php",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);

    if ($errors = curl_error($curl)) {
        echo $errors;
    } else {
        echo $response . "<hr>";
    }

    curl_close($curl);
}


function curl_post_headers()
{
    $data_list = [
        "from" => '2022-07-13 15:00:00',
        "to" => '2022-07-13 18:00:00',
    ];

    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/api.php",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "ACCESS:P.L.E.A.S.E.",
        ],
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);

    if ($errors = curl_error($curl)) {
        echo $errors;
    } else {
        echo $response . "<hr>";
    }
    curl_close($curl);
}


curl_get_response();
curl_get();
curl_post();
curl_post_headers();


