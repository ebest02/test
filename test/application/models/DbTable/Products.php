<?php

class Application_Model_DbTable_Products extends Zend_Db_Table_Abstract
{

    protected $_name = 'products';
    protected $_primary = 'p_id';

	public function init(){
	    $this->db = $this->getAdapter();
    }


    public function countByCat($cat_id){


        $select = $this->select();
        $select->from($this, array('count(id) as nb'));
        $select->where('cat_id = ?', $cat_id);
        $rows = $this->fetchAll($select);

        return($rows[0]->nb);


    }



}