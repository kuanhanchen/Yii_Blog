<?php
namespace backend\widgets\sidebar;

/**
 * 后台siderbar插件
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
                    ['label'=>'Members Info','url'=>['member/index']],
                ]
            ],
        ];
    }
}