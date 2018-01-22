<?php
namespace frontend\widgets\tag;

use Yii;
use yii\bootstrap\Widget;
use yii\base\Object;
use common\models\PostExtendModel;
use common\models\PostModel;
use yii\db\Query;
use common\models\TagModel;

class TagWidget extends Widget
{
    public $title = '';
    
    public $limit = 20;
    
    public function run()
    {
        $res = TagModel::find()
            ->orderBy(['post_num'=>SORT_DESC])
            ->limit($this->limit)
            ->all();
        
        $result['title'] = $this->title?:'Tags';
        $result['body'] = $res?:[];
        
        return $this->render('index',['data'=>$result]);
    }
  
    
}