<?php

use yii\db\Migration;

/**
 * Class m220404_154924_create_init
 */
class m220404_154924_create_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'image_id' => $this->integer(),
            'date' => $this->date(),
            'viewed' => $this->integer(),
            'is_deleted' => $this->boolean(),
            'user_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'nickname' => $this->string(),
            'email' => $this->string()->defaultValue(null),
            'password' => $this->string(),
            'profile_picture' => $this->string()->defaultValue(null),
            'is_admin' => $this->boolean()->defaultValue(false),
            'is_deleted' => $this->boolean(),
        ]);

        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'is_deleted' => $this->boolean(),
            'user_id' => $this->integer(),
            'post_id' => $this->integer(),
            'date' => $this->date(),
        ]);

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
        ]);

        $this->createIndex(
            'id-index-post-image_id',
            'post',
            'image_id'
        );

        $this->createIndex(
            'id-index-post-category_id',
            'post',
            'category_id'
        );

        $this->createIndex(
            'id-index-comment-user_id',
            'comment',
            'user_id'
        );

        $this->createIndex(
            'id-index-comment-post_id',
            'comment',
            'post_id'
        );

        $this->addForeignKey(
            'fk-post-image_id',
            'post',
            'image_id',
            'image',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-post-user_id',
            'post',
            'user_id',
            'user',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-post-category_id',
            'post',
            'category_id',
            'category',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-comment-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-comment-post_id',
            'comment',
            'post_id',
            'post',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('id-index-post-image_id', 'post');
        $this->dropIndex('id-index-post-category_id', 'post');
        $this->dropIndex('id-index-comment-user_id', 'comment');
        $this->dropIndex('id-index-comment-post_id', 'comment');

        $this->dropForeignKey('fk-post-image_id', 'post');
        $this->dropForeignKey('fk-post-user_id', 'post');
        $this->dropForeignKey('fk-post-category_id', 'post');
        $this->dropForeignKey('fk-comment-user_id', 'comment');
        $this->dropForeignKey('fk-comment-post_id', 'comment');

        $this->dropTable('post');
        $this->dropTable('user');
        $this->dropTable('comment');
        $this->dropTable('category');
        $this->dropTable('image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220404_154924_create_init cannot be reverted.\n";

        return false;
    }
    */
}
