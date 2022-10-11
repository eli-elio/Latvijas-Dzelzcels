Create table latvijas_dzelzcels.nkp25
(
    container_number                CHAR(11),
    abd_pc_sign                     INT,
    owner_administration_code       CHAR(2),
    transaction_station_code        INT,
    dislocation_time                DATETIME,
    train_id                        BIGINT,
    wagon_number                    INT,
    message_code                    INT,
    operation_code                  INT,
    acceptance_sign                 INT,
    delivery_road_code              INT,
    receiving_road_code             INT,
    departure_state_code            INT,
    destination_state_code          INT,
    departure_station_code          INT,
    destination_station_code        INT,
    ppv_number                      INT
);
