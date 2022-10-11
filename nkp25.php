<?php

$dbhost = "localhost";
$dbuser = $_ENV["DB_USER"];
$dbpass = $_ENV["DB_PASS"];
$dbname = "latvijas_dzelzcels";

$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);

$handle = fopen("NKP25", "r");
if ($handle) {
    $sql = "
INSERT INTO nkp25(
    container_number,
    abd_pc_sign,
    owner_administration_code,
    transaction_station_code,
    dislocation_time,
    train_id,
    wagon_number,
    message_code,
    operation_code,
    acceptance_sign,
    delivery_road_code,
    receiving_road_code,
    departure_state_code,
    destination_state_code,
    departure_station_code,
    destination_station_code,
    ppv_number)
VALUES 
   (:container_number, 
    :abd_pc_sign, 
    :owner_administration_code, 
    :transaction_station_code, 
    :dislocation_time, 
    :train_id, 
    :wagon_number, 
    :message_code, 
    :operation_code, 
    :acceptance_sign, 
    :delivery_road_code, 
    :receiving_road_code, 
    :departure_state_code, 
    :destination_state_code, 
    :departure_station_code, 
    :destination_station_code, 
    :ppv_number)";

    $q = $conn->prepare($sql);

    function parseInt($buffer, $offset, $length)
    {
        return (int)trim(substr($buffer, $offset, $length));
    }

    while (($buffer = fgets($handle)) !== false) {
        $buffer = trim($buffer);

        $container_number = trim(substr($buffer, 0, 11));
        $abd_pc_sign = parseInt($buffer, 11, 1);
        $owner_administration_code = trim(substr($buffer, 12, 2));
        $transaction_station_code = parseInt($buffer, 14, 5);
        $dislocation_time = trim(substr($buffer, 19, 12));
        $dislocation_time = date_create_from_format("YmdHi", $dislocation_time)->format("Y-m-d H:i:s");
        $train_id = parseInt($buffer, 31, 13);
        $wagon_number = parseInt($buffer, 44, 8);
        $message_code = parseInt($buffer, 52, 4);
        $operation_code = parseInt($buffer, 56, 2);
        $acceptance_sign = parseInt($buffer, 58, 1);
        $delivery_road_code = parseInt($buffer, 59, 2);
        $receiving_road_code = parseInt($buffer, 61, 2);
        $departure_state_code = parseInt($buffer, 63, 3);
        $destination_state_code = parseInt($buffer, 66, 3);
        $departure_station_code = parseInt($buffer, 69, 5);
        $destination_station_code = parseInt($buffer, 74, 5);
        $ppv_number = parseInt($buffer, 79, 5);

        $q->execute([
                ":container_number" => $container_number,
                ":abd_pc_sign" => $abd_pc_sign,
                ":owner_administration_code" => $owner_administration_code,
                ":transaction_station_code" => $transaction_station_code,
                ":dislocation_time" => $dislocation_time,
                ":train_id" => $train_id,
                ":wagon_number" => $wagon_number,
                ":message_code" => $message_code,
                ":operation_code" => $operation_code,
                ":acceptance_sign" => $acceptance_sign,
                ":delivery_road_code" => $delivery_road_code,
                ":receiving_road_code" => $receiving_road_code,
                ":departure_state_code" => $departure_state_code,
                ":destination_state_code" => $destination_state_code,
                ":departure_station_code" => $departure_station_code,
                ":destination_station_code" => $destination_station_code,
                ":ppv_number" => $ppv_number
            ]
        );
    }
    
    fclose($handle);
    echo "File data successfully imported to database!";
}