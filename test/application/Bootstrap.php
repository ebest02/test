<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    protected function _initRewrite()
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $router->addConfig(new Zend_Config_Ini(APPLICATION_PATH. "/configs/routes.ini",
            'production'), 'routes');
    }
}

