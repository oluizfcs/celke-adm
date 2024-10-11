<?php

namespace Core;

abstract class Config
{
    /**
     * Contém as constantes do projeto
     *
     * @return void
     */
    protected function configAdm(): void
    {
        define('URL', 'http://localhost/celke/');
        define('URLADM', 'http://localhost/celke/adm');

        define('CONTROLLER', 'Login');
        define('CONTROLLERERRO', "Erro");
        define('METODO', 'index');

        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'celke_adm');
        define('PORT', 3306);

        define('EMAILADM', 'oluizfcs@gmail.com');
    }
}