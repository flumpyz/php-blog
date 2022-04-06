<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $content
 * @property int|null $image_id
 * @property string|null $date
 * @property int|null $viewed
 * @property bool|null $is_deleted
 * @property int|null $user_id
 * @property int|null $category_id
 *
 * @property Category $category
 * @property Comment[] $comments
 * @property Image $image
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'content'], 'string'],
            [['title'], 'string', 'max' => 127],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['category_id'], 'number'],
//            [['is_deleted'], 'boolean'],
//            [['is_deleted'], 'default', 'value' => false],
//            [['content'], 'string'],
//            [['image_id', 'viewed', 'user_id', 'category_id'], 'default', 'value' => null],
//            [['image_id', 'viewed', 'user_id', 'category_id'], 'integer'],
//            [['date'], 'safe'],

//            [['title'], 'string', 'max' => 255],
//            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
//            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'image_id' => 'Image ID',
            'date' => 'Date',
            'viewed' => 'Viewed',
            'is_deleted' => 'Is Deleted',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[Image]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
//        $image = $this->hasOne(Image::className(), ['id' => 'image_id'])->;
//        if ($image->url)
//        {
//            return '/uploads/' . $image->url;
//        }
//
//        return '/no-image.png';

        return $this->hasOne(Image::className(), ['id' => 'image_id']);
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

    public function saveCategory($category_id)
    {
        $category = Category::findOne($category_id);

        if ($category != null) {
            $this->link('category', $category);
            return true;
        }
    }

    public function saveImage($image_id)
    {
        $image = Image::findOne($image_id);

        if ($image != null) {
            $this->link('image', $image);
            return true;
        }
    }
}
