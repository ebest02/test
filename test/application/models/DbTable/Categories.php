<?php

class Application_Model_DbTable_Categories extends Zend_Db_Table_Abstract
{

    protected $_name = 'categories';
    protected $_primary = 'c_id';

	public function init(){
	    $this->db = $this->getAdapter();
    }


}