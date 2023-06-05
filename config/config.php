<?php

return [



    "database" => [
        "host" => "db",
        "driver" => "mysql",
        "dbname" => "",
        "user" => "",
        "password" => "",

    ]
];

//CREATE TABLE Currencies (
//    id INT PRIMARY KEY AUTO_INCREMENT,
//    name VARCHAR(255),
//    code VARCHAR(10),
//    date INT,
//    buy_value INT,
//    sell_value INT
//);
//
//CREATE TABLE Transactions (
//    uuid VARCHAR(36) PRIMARY KEY,
//    selected_currency INT,
//    selected_currency_amount INT,
//    target_currency INT,
//    target_currency_amount INT,
//    date INT
//);