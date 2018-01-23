<?php
namespace backend\widgets\sidebar;

/**
 * backend siderbar widget
 */
use Yii;
use yii\base\Widget;
use yii\widgets\Menu;

class SidebarWidget extends Menu
{    
    public $submenuTemplate = "\n<ul class=\"children\">\n{items}\n</ul>\n";
    
    public $options = ['class'=>'nav nav-pills nav-stacked nav-quirk'];
    
    public $activateParents = true;
    
    public function init()
    {
        $this->items = [
            ['label' =>'<i class="fa fa-dashboard"></i><span>DashBaord</span>','url'=>['site/index']],
            ['label' =>'<a href=""><i class="fa fa-th-list"></i><span>Contents</span></a>','options'=>['class'=>'nav-parent'],'items'=>[
                    ['label'=>'Posts','url'=>['post/index'],'items'=>[
                        ['label'=>'Create Posts','url'=>['post/create'],'visible'=>false],
                        ['label'=>'Update Posts','url'=>['post/update'],'visible'=>false],
                        ]                       
                    ],
                    ['label'=>'Categories','url'=>['cat/index'],'items'=>[
                        ['label'=>'Create Categories','url'=>['cat/create'],'visible'=>false],
                        ['label'=>'Update Categories','url'=>['cat/update'],'visible'=>false],
                        ]                        
                    ],
                    ['label'=>'Tags','url'=>['tag/index']],
                ]
            ],
            ['label' =>'<a href=""><i class="fa fa-user"></i><span>Members</span></a>','options'=>['class'=>'nav-parent'],'items'=>[
                    ['label'=>'Members Info','url'=>['user/index'],'items'=>[
                        ['label'=>'Members Info Detail','url'=>['user/view'],'visible'=>false],
                        ['label'=>'Update Member Info','url'=>['user/update'],'visible'=>false],
                        ]                        
                    ],
                ]
            ],
        ];
    }


    // set some js css style
    // when one of menu item is selected, get background and minimize others
    /**
     * Normalizes the [[items]] property to remove invisible items and activate certain items.
     * @param array $items the items to be normalized.
     * @param boolean $active whether there is an active child menu item.
     * @return array the normalized menu items
     */
    protected function normalizeItems($items, &$active)
    {
        foreach ($items as $i => $item) {
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $hasActiveChild = false;
            if (isset($item['items'])) {
                $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }
             
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
        }
    
        return array_values($items);
    }
}