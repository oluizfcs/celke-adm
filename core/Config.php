<?php

abstract class Config
{
    protected function configAdm()
    {
        define('URL', 'http://localhost/celke/');
        define('URLADM', 'http://localhost/celke/adm');

        # O nome das controllers devem começar com letra maiúscula
        define('CONTROLLER', 'Login');
        define('CONTROLLERERRO', "Erro");
        define('METODO', 'index');
    }
}