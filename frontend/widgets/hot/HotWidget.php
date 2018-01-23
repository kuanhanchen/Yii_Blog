<?php
namespace frontend\widgets\hot;
/**
 * Hot Browse Widget
 */
use Yii;
use yii\base\Widget;
use common\models\PostModel;
use yii\helpers\Url;
use common\models\PostExtendModel;
use yii\db\Query;

class HotWidget extends Widget
{

    public $title = '';
    
    /**
     * number of post
     * @var unknown
     */
    public $limit = 8;
    
    /**
     * whether shown more
     * @var unknown
     */
    public $more = true;
    
    /**
     * whether shown pagination
     * @var unknown
     */
    public $page = true;
    
    public function run()
    {
    	// orderBy('browser DESC, id DESC')
    	// there're two post with the same number of browser, so also needed id DESC
    	// a.browser: number of browser
    	// b.id: id
    	// b.title: title
        $res = (new Query())
        ->select('a.browser, b.id, b.title')
        ->from(['a'=>PostExtendModel::tableName()])
        ->join('LEFT JOIN',['b'=>PostModel::tableName()],'a.post_id = b.id')
        ->where('b.is_valid ='.PostModel::IS_VALID)
        ->orderBy('browser DESC, id DESC')
        ->limit($this->limit)
        ->all();
        
        $result['title'] = $this->title?:'Popular Posts';
        $result['more'] = Url::to(['post/index','sort'=>'hot']);
        $result['body'] = $res?:[];
        
        return $this->render('index',['data'=>$result]);
    }
}