<?php


function test_page_status()
{
    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/",
        CURLOPT_HEADER => 1,
        CURLOPT_NOBODY => 1,
        CURLOPT_RETURNTRANSFER => 1,
    ];

    curl_setopt_array($curl, $options);
    curl_exec($curl);
    $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    echo <<<_HTML_
    <p>Проверка статуса главной страницы: $response</p><hr>
    _HTML_;
}

function test_get_uuid_by_id_valid_existent()
{
    $data_list = [
        'id' => 777,
    ];
    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    curl_close($curl);

    echo <<<_HTML_
    <p>Проверка получения post запросом uuid по существующему id: <br>
    $response</p><hr>
    _HTML_;
}

function test_get_uuid_by_id_valid_nonexistent()
{
    $data_list = [
        'id' => 99999999999,
    ];
    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    curl_close($curl);

    echo <<<_HTML_
    <p>Проверка получения post запросом uuid по несуществующему id: <br>
    $response</p><hr>
    _HTML_;
}

function test_get_uuid_by_id_invalid()
{
    $data_list = [
        'id' => "ABC",
    ];
    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    curl_close($curl);

    echo <<<_HTML_
    <p>Проверка получения post запросом uuid по неверно сформированному id: <br>
    $response</p><hr>
    _HTML_;
}

function test_get_number_of_generated_uuids_zero()
{
    $data_list = [
        "from" => '2000-07-13 15:00:00',
        "to" => '2000-07-13 18:00:00',
    ];

    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "ACCESS:P.L.E.A.S.E.",
        ],
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    curl_close($curl);

    echo <<<_HTML_
    <p>Проверка получения post запросом количества сгенерированных uuid
    за указанный период времени, которых сформирован правильно,
    но с отсутствующими записями: <br>
    $response</p><hr>
    _HTML_;
}

function test_get_number_of_generated_uuids_valid()
{
    $data_list = [
        "from" => '2022-07-13 15:00:00',
        "to" => '2022-07-13 18:00:00',
    ];

    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "ACCESS:P.L.E.A.S.E.",
        ],
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    curl_close($curl);

    echo <<<_HTML_
    <p>Проверка получения post запросом количества сгенерированных uuid
    за указанный период времени, которых сформирован правильно: <br>
    $response</p><hr>
    _HTML_;
}

function test_get_number_of_generated_uuids_invalid()
{
    $data_list = [
        "from" => 'ABC',
        "to" => 'DEF',
    ];

    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "ACCESS:P.L.E.A.S.E.",
        ],
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    curl_close($curl);

    echo <<<_HTML_
    <p>Проверка получения post запросом количества сгенерированных uuid
    за указанный период времени, который сформирован неправильно: <br>
    $response</p><hr>
    _HTML_;
}

function test_get_number_of_generated_uuids_wrong_header()
{
    $data_list = [
        "from" => '2022-07-13 15:00:00',
        "to" => '2022-07-13 18:00:00',
    ];

    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "ACCESS:WRONG_KEY",
        ],
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    curl_close($curl);

    echo <<<_HTML_
    <p>Проверка получения post запросом количества сгенерированных uuid
    за указанный период времени, которых сформирован правильно,
    но был передан неверный заголовок-ключ : <br>
    $response</p><hr>
    _HTML_;
}

function test_get_number_of_generated_uuids_missing_header()
{
    $data_list = [
        "from" => '2022-07-13 15:00:00',
        "to" => '2022-07-13 18:00:00',
    ];

    $data = http_build_query($data_list);

    $curl = curl_init();
    $options = [
        CURLOPT_URL => "http://127.0.0.1:80/",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
    ];

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    curl_close($curl);

    echo <<<_HTML_
    <p>Проверка получения post запросом количества сгенерированных uuid
    * за указанный период времени, которых сформирован правильно,
    * но не был передан заголовок-ключ: <br>
    $response</p><hr>
    _HTML_;
}

test_page_status();
test_get_uuid_by_id_valid_existent();
test_get_uuid_by_id_valid_nonexistent();
test_get_uuid_by_id_invalid();
test_get_number_of_generated_uuids_zero();
test_get_number_of_generated_uuids_valid();
test_get_number_of_generated_uuids_invalid();
test_get_number_of_generated_uuids_wrong_header();
test_get_number_of_generated_uuids_missing_header();
