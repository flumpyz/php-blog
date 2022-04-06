<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3, 500]],
        ];
    }

    public function saveComment($postId)
    {
        $comment = new Comment();
        $comment->text = $this->comment;
        $comment->user_id = \Yii::$app->user->id;
        $comment->post_id = $postId;

        return $comment->save();
    }
}