<?php

namespace App\Components;
use App\Menu;

class menuRecusive {
    private $html;
    public function __contruct() {
        $this->html='';
    }
    public function getmenuRecusiveAdd($parent_id=0,$text='') {
        $data=Menu::where('parent_id',$parent_id)->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option value="' . $dataItem->id . '">' . $text . $dataItem->name . '</option>';
            $this->getmenuRecusiveAdd($dataItem->id , $text.'-');
        }
        return $this->html;
    }
    public function getmenuRecusiveEdit($parentID,$parent_id=0,$text='') {
        $data=Menu::where('parent_id',$parent_id)->get();
        foreach ($data as $dataItem) {
            if($parentID==$dataItem->id) {
                $this->html .= '<option selected value="' . $dataItem->id . '">' . $text . $dataItem->name . '</option>';
            }
            else {
                $this->html .= '<option value="' . $dataItem->id . '">' . $text . $dataItem->name . '</option>';
            }
            $this->getmenuRecusiveEdit($parentID,$dataItem->id , $text);
        }
        return $this->html;
    }

}
?>
