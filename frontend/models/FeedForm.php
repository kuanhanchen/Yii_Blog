<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\FeedModel;

/**
 * This is the model class for table "feeds".
 *
 * @property integer $id
 * @property string $content
 */
class FeedForm extends Model
{
    public $content;
    
    public $_lastError;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
        ];
    }
    
    public function create()
    {
        try{
            $model = new FeedModel();
            $model->user_id = Yii::$app->user->identity->id;
            $model->content = $this->content;
            $model->created_at = time();            
            if(!$model->save())
                throw new \Exception('Save Message Fail!');
            
            return true;
        }catch (\Exception $e){
            $this->_lastError = $e->getMessage();
            return false;
        }
    }
    
    public function getList()
    {
        $model = new FeedModel();
        // limit only get 10 rows
	    // with('user'): get data from user table, getUser() in FeedModel.php
        $res = $model->find()->limit(10)->with('user')->orderBy(['id'=>SORT_DESC])->asArray()->all();
        
        return $res?:[];
    }
}
