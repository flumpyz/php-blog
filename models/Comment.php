<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string|null $text
 * @property bool|null $is_deleted
 * @property int|null $user_id
 * @property int|null $post_id
 * @property string|null $date
 *
 * @property Post $post
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['is_deleted'], 'boolean'],
            [['user_id', 'post_id'], 'default', 'value' => null],
            [['user_id', 'post_id'], 'integer'],
            [['date'], 'safe'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'is_deleted' => 'Is Deleted',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

//    public function saveComment()
//    {
//        $this->user_id = Yii::$app->user->id;
//        return $this->save();
//    }
}
