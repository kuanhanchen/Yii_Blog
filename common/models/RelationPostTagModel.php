<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "relation_post_tags".
 *
 * @property int $id
 * @property int $post_id
 * @property int $tag_id
 */
class RelationPostTagModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_post_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'integer'],
            [['post_id', 'tag_id'], 'unique', 'targetAttribute' => ['post_id', 'tag_id']],
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
            'tag_id' => 'Tag ID',
        ];
    }

    public function getTag()
    {
        // tag_id of relation_post_tag table -> id of tag table
        return $this->hasOne(TagModel::className(), ['id'=>'tag_id']);
    }
}
