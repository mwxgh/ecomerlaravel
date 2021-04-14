<?php
namespace App\Components;
use App\Models\Menu;

class MenuRecusive
{
    private $html;
    public function __construct()
    {
        $this->html ='';
    }
    public function menuRecusiveAdd($parentId = 0, $subText ='')
    {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option value ="'. $dataItem->id .'">' . $subText . $dataItem->name. '</option>';
            $this->menuRecusiveAdd($dataItem->id, $subText . '-');
        }
        return $this->html;
    }
    public function menuRecusiveEdit($parentIdEdit,$parentId = 0, $subText ='')
    {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $dataItem) {
            if ($parentIdEdit == $dataItem->id) {
                $this->html .= '<option selected value ="'. $dataItem->id .'">' . $subText . $dataItem->name. '</option>';
            }else {
                $this->html .= '<option value ="'. $dataItem->id .'">' . $subText . $dataItem->name. '</option>';
            }

            $this->menuRecusiveEdit($parentIdEdit,$dataItem->id, $subText . '-');
        }
        return $this->html;
    }
}
