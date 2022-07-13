<?php

use PHPUnit\Framework\TestCase;


class TestRequest extends TestCase
{

    /**
     * Проверка статуса главной страницы
     */
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

        $this->assertEquals($response, 200);
    }

    /**
     * Проверка получения post запросом uuid по существующему id 
     */
    public function test_get_uuid_by_id_valid_existent()
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

        $this->assertEquals($response, '{"id":777,"uuid":"aef1613c6b7b7296ebd4dd431a673419"}');
    }

    /**
     * Проверка получения post запросом uuid по несуществующему id 
     */
    public function test_get_uuid_by_id_valid_nonexistent()
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

        $this->assertEquals($response, '{"error":"nonexistent id"}');
    }

    /**
     * Проверка получения post запросом uuid по неверно сформированному id 
     */
    public function test_get_uuid_by_id_invalid()
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

        $this->assertEquals($response, '{"error":"invalid id format"}');
    }

    /**
     * Проверка получения post запросом количества сгенерированных uuid
     * за указанный период времени, которых сформирован правильно,
     * но с отсутствующими записями
     */
    public function test_get_number_of_generated_uuids_zero()
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

        $this->assertEquals($response, '{"from":"2000-07-13 15:00:00","to":"2000-07-13 18:00:00","created_uuid":0}');
    }

    /**
     * Проверка получения post запросом количества сгенерированных uuid
     * за указанный период времени, которых сформирован правильно
     */
    public function test_get_number_of_generated_uuids_valid()
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

        $this->assertEquals($response, '{"from":"2022-07-13 15:00:00","to":"2022-07-13 18:00:00","created_uuid":845}');
    }
    

    /**
     * Проверка получения post запросом количества сгенерированных uuid
     * за указанный период времени, который сформирован неправильно
     */    
    public function test_get_number_of_generated_uuids_invalid()
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

        $this->assertEquals($response, '{"error":"invalid time period"}');
    }

    /**
     * Проверка получения post запросом количества сгенерированных uuid
     * за указанный период времени, которых сформирован правильно,
     * но был передан неверный заголовок-ключ 
     */
    public function test_get_number_of_generated_uuids_wrong_header()
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

        $this->assertEquals($response, '{"error":"access denied"}');
    }
    
    /**
     * Проверка получения post запросом количества сгенерированных uuid
     * за указанный период времени, которых сформирован правильно,
     * но не был передан заголовок-ключ 
     */
    public function test_get_number_of_generated_uuids_missing_header()
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

        $this->assertEquals($response, '{"error":"access denied"}');
    }
    
}
