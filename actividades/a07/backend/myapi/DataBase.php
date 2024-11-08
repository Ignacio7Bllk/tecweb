<?php
    namespace TECWEB\MYAPI;

    abstract class DataBase {
        protected $connection;

        public function __construct($db, $user, $pass) {
            $this->connection = @mysqli_connect(
                'localhost',
                $user,
                $pass,
                $db
            );

            if (!$this->connection) {
                die("Database connection failed: " . mysqli_connect_error());
            }
        }
    }
?>