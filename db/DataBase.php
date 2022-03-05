<?php

/**
 * Extends this Class only from "Manager" Class
 */
abstract class DataBase
{

    private string $db_host = 'localhost';
    private string $db_name = 'real_estate';

    private PDO $db;

    /**
     * Connect PDO
     */
    protected function getPDO(): PDO
    {
        return $this->buildPDO();
    }

    /**
     * Build a connection PDO with DataBase
     */
    private function buildPDO(): PDO
    {
        try {

            $this->db = new PDO(
                "mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8",
                "root",
                "",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (Exception $e) {
            echo 'Erreur connection database : ' . $e->getMessage();
        }

        return $this->db;
    }
}
