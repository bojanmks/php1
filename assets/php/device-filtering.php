<?php
    include("connection/connection.php");
    include("functions.php");
    try {
        $query = "SELECT * FROM devices WHERE active = 1";
        if(isset($_GET['search'])) {
            $query .= " AND name LIKE :search";
        }
        if(isset($_GET['os'])) {
            $query .= " AND os IN (:os)";
        }
        if(isset($_GET['brand'])) {
            $query .= " AND brand IN (:brand)";
        }
        if(isset($_GET['priceRange'])) {
            $query .= " AND price < :price";
        }
        //
        global $connection;
        $execution = $connection->prepare($query);
        $execution = deviceFilteringBindParams($execution);
        $execution->execute();
        $result = $execution->fetchAll();
        $numberOfDevices = count($result);
        if(isset($_GET['order'])) {
            $order = $_GET['order'];
            if($order != "0") {
                $text = '';
                if($order == "nameAZ") $text = "name";
                else if($order == "nameZA") $text = "name DESC";
                else if($order == "priceASC") $text = "price";
                else $text = "price DESC";
                $query .= " ORDER BY $text";
            }
        }
        $devicesPerPage = 6;
        if(isset($_GET['page'])) {
            $page = ($_GET['page'] - 1) * $devicesPerPage;
            $query .= " LIMIT $page, $devicesPerPage";
        }
        //
        $execution = $connection->prepare($query);
        $execution = deviceFilteringBindParams($execution);
        $execution->execute();
        $result = $execution->fetchAll();
        $output = printDevices($result, $numberOfDevices);
        $response = ["response"=>$output];
        http_response_code(200);
        header("Content-type: application/json");
        echo(json_encode($response));
    } catch(PDOException $e) {
        http_response_code(500);
        echo($e->getMessage());
    }
?>