<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "cats".
 *
 * @property int $id
 * @property string $cat_name
 */
class CatModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_name' => 'Cat Name',
        ];
    }


    public static function getAllCats()
    {
        // for initial table without any data, so putting the default data
        $cat = ['0'=>'Choose Category'];

        $res = self::find()->asArray()->all();
        if($res) {
            foreach($res as $k=>$list) {
                $cat[$list['id']] = $list['cat_name'];
            }
        }
        // print_r($cat);exit;
        return $cat;
    }

}
