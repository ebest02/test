<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->db = Zend_Db_Table::getDefaultAdapter();
        $registry = Zend_Registry::getInstance();
        $registry->set('db', $this->db);
    }

    public function indexAction()
    {

        $order = $this->_getParam("order");
        if($order){
            $order = "name ASC";
        }else{
            $order = "product ASC";
        }
        $products = new Application_Model_DbTable_Products();

        $select = $products->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
        $select ->setIntegrityCheck(false)
                ->join('categories', 'categories.c_id = products.cat_id')
                ->order($order)
                ->order('product ASC');
        $rows = $products->fetchAll($select);


        $this->view->cats = $rows;
        $this->view->form = new Application_Form_Add();

    }


    public function addAction()
    {

        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $form = new Application_Form_Add();

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $product = $form->getValue('product');
                $cat_id = $form->getValue('cat');

                $products = new Application_Model_DbTable_Products();
                $datas = array('product' => $product, 'cat_id' => $cat_id);
                $products->insert($datas);


            }
        }

        return  $this->_redirect('/');
    }

    public function deleteAction()
    {

        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $products = new Application_Model_DbTable_Products();

        $c_id = $_GET["c_id"];
        $p_id = $this->_getParam("p_id");
        //if(!$p_id && !$c_id)
        //    return  $this->_redirect('/');

        if($p_id){
            $where = $products->getAdapter()->quoteInto('p_id = ?', $p_id);
        }elseif($c_id){
            $where = $products->getAdapter()->quoteInto('cat_id = ?', $c_id);
        }else{
            $where = '';
        }

        $products->delete($where);




        return  $this->_redirect('/');
    }


    public function restoreAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $datas = array(
            '0'=>array('product' => 'Tortellinis', 'cat_id' => 1),
            '1'=>array('product' => 'Parmesan rap&eacute;', 'cat_id' => 1),
            '2'=>array('product' => 'Saumon', 'cat_id' => 1),
            '3'=>array('product' => 'Cr&egrave;me fra&icirc;che', 'cat_id' => 1),
            '4'=>array('product' => 'Vittel', 'cat_id' => 2),
            '5'=>array('product' => 'Gateau chocolat', 'cat_id' => 1),
            '6'=>array('product' => 'Caf&eacute;', 'cat_id' => 1),
            '7'=>array('product' => 'Produit vaisselle', 'cat_id' => 3),
            '8'=>array('product' => 'Eponges', 'cat_id' => 3),
            '9'=>array('product' => 'Cacahuettes', 'cat_id' => 1),
            '10'=>array('product' => 'Jus d\'orange', 'cat_id' => 1),
            '11'=>array('product' => 'Champagne', 'cat_id' => 2),
            '12'=>array('product' => 'Perrier', 'cat_id' => 2),
            '13'=>array('product' => 'Tome', 'cat_id' => 1),
            '14'=>array('product' => 'Pain', 'cat_id' => 1),
            '15'=>array('product' => 'Quincy (vin blanc)', 'cat_id' => 2),
            '16'=>array('product' => 'Produit vitres', 'cat_id' => 3),
            '17'=>array('product' => 'Serpill&egrave;re', 'cat_id' => 3)
            );


        $products = new Application_Model_DbTable_Products();
        $products->delete();

        foreach($datas as $row):
            $data = array('product' => $row['product'], 'cat_id' => $row['cat_id']);
            $products->insert($data);
        endforeach;

    return  $this->_redirect('/');
    }

}

