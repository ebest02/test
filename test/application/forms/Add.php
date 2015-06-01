<?php

class Application_Form_Add extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setMethod('post');
        $this->setName('addform');
        $this->setAction('/product/add');

		$prod = new Zend_Form_Element_Text('product');
		$prod->setAttrib('placeholder', 'Produit')
			  ->addFilters(array('StringTrim', 'StripTags'))
              ->setRequired(true)
              ->setDecorators(array(
                            array('Label', array('escape'=>false, 'placement'=>'append')),
                            array('ViewHelper'),
                            array('Errors'),
                            array('Description',array('escape'=>false,'tag'=>'div')),
                            array('HtmlTag', array('tag' => 'div')),
                        ));
        $prod->setAttrib('id', 'product');

        $cats = new Zend_Form_Element_Select('cat');
		$cats->setAttrib('class', 'styled')
			->setRequired(true);
		$cats->addMultiOptions(array(
				'-' => 'Choisissez la catégorie ?',
				'1' => 'Nourriture',
				'2' => 'Boisson',
				'3' => 'Produit d\'entretien'
				));



        $submit = new Zend_Form_Element_Submit('Ajouter !');

        $submit->setAttrib( 'value', 'Ajouter !' )
        		->setAttrib('id', 'submitbutton');

        $this->addElements(array($prod,$cats,$submit));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'div', 'class' => 'styled_form')),
            array('Description', array('placement' => 'append')),
            'Form'
        ));


   	}



}
