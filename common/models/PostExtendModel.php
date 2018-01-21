<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "post_extends".
 *
 * @property int $id
 * @property int $post_id post id
 * @property int $browser number of browsing
 * @property int $collect number of bookmark
 * @property int $praise number of like
 * @property int $comment comment
 */
class PostExtendModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'browser' => 'Browser',
            'collect' => 'Collect',
            'praise' => 'Praise',
            'comment' => 'Comment',
        ];
    }

    // $cond, get which row by $cond (post_id)
    // $attribute, get data by which column (attribute)
    // cuz we get the number first, then increment number
    // in browser, we see the old record.
    // e.g. when we first view the post, we see view shown 0 instead of 1
    public function upCounter($cond, $attribute, $num)
    {
        $counter = $this->findOne($cond);

        // cannot get $counter means this is the first time to visit this post
        // so we need to create one
        if(!$counter) {
            $this->setAttributes($cond);
            $this->$attribute = $num;
            $this->save();
        } else {    // we can get $counter means we viewed this post detail before, directly increment number
            $countData[$attribute] = $num;

            // $countData++
            $counter->updateCounters($countData);
        }
    }
}
