<?php
class Zend_View_Helper_Table extends Zend_View_Helper_Abstract {

    public function Table($datas){

        echo '<table id="shopping">';
        echo '<tr><td class="red">Ce qu\'il faut acheter</td><td class="red">A ranger dans</td><td></td></tr>';

        foreach($datas as $item):
        echo '<tr id="cat_'.$item['p_id'].'"><td>'.utf8_encode($item['product']).'</td><td>'.utf8_encode($item['name']).'</td><td><a href="/product/delete/'.$item['p_id'].'"><img src="http://dsi-tools.com/images/url.bmp" style="width:35px;"/></a></td></tr>';
        endforeach;

        echo '</table>';

    }


}