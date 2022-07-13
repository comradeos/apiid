<?php

header("Content-type:application/json");

class BaseAPI
{

    function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=db;dbname=apiid_db", "root", "root");
        } catch (\Throwable $error) {
            die("Connection error: $error");
        }
    }

    /**
     * Генерирует uuid
     */
    private function generate_uuid()
    {
        return bin2hex(random_bytes(16));
    }

    /**
     * Записывает в базу сгенерированный uuid и выводит его вместе с id записи
     */
    public function new_id()
    {
        $new_uuid = $this->generate_uuid();
        try {
            $this->db->query("INSERT INTO posts (uuid, created)
                              VALUES ('$new_uuid', now())");
            $result = $this->db->query("SELECT id, uuid FROM posts ORDER BY id DESC LIMIT 1")
                               ->fetchAll(PDO::FETCH_ASSOC)[0];
        } catch (\Throwable $error) {
            die("Error: $error");
        }
        echo json_encode($result);
    }

    /**
     * Получает uuid по id записи
     */
    public function get_uuid()
    {
        if (isset($_POST["id"])) {
            try {
                $result = $this->db->query("SELECT id, uuid FROM posts WHERE id=$_POST[id]")
                                   ->fetchAll(PDO::FETCH_ASSOC);
                $result = $result ? $result[0] : [
                    "error" => "nonexistent id",
                ]; 
            } catch (\Throwable $error) {
                // die("Error: $error");
                $result = [
                    "error" => "invalid id format",
                ]; 
            }
            echo json_encode($result);
        }
    }

    /**
     * Получение количества сгенерированных uuid за период
     */
    public function get_statistics()
    {
        if (isset($_POST["from"]) && isset($_POST["to"])) {

            if (isset($_SERVER['HTTP_ACCESS']) && $_SERVER['HTTP_ACCESS'] == "P.L.E.A.S.E.") {
                try {
                    $result = $this->db->query("SELECT id FROM posts 
                                                WHERE created >= '$_POST[from]' 
                                                AND created <='$_POST[to]'")
                                       ->rowCount();
                    $result = [
                        "from" => $_POST["from"],
                        "to" => $_POST["to"],
                        "created_uuid" => $result,
                    ];

                } catch (\Throwable $error) {
                    // die("Error: $error");
                    $result = [
                        "error" => "invalid time period",
                    ];
                }
            } else {
                $result = [
                    "error" => "access denied",
                ];
            }
            echo json_encode($result);
        }
    }

    /**
     * Запустить API
     */
    public function run()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->new_id();
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->get_uuid();
            $this->get_statistics();
        }
    }
}


$api = new BaseAPI();
$api->run();
