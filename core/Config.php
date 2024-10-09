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

        define('EMAILADM', 'oluizfcs@gmail.com');
    }
}