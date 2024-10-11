<?php

namespace Adms\Models\helper;

use PDO;
use PDOException;

/**
 * Realiza a conexão com o banco de dados
 */
abstract class AdmsConn
{
    private string $host = HOST;
    private string $user = USER;
    private string $dbname = DBNAME;
    private string $pass = PASS;
    private string|int $port = PORT;
    private object $connect;

    protected function connectDb(): object
    {
        try {
            // Cria um novo PHP Data Object e atribui para o atributo connect
            $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->user, $this->pass);

            return $this->connect;
        } catch(PDOException $err) {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM);
        }
    }
}