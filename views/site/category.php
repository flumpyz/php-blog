<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <?php foreach ($posts as $post): ?>
                    <article class="post post-list">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="post-thumb">
                                    <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]); ?>"><img src="<?=
                                        $post->image->url ? '/uploads/' . $post->image->url : '/no-image.png'; ?>"
                                                                                                          alt=""
                                                                                                          class="pull-left"></a>

                                    <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]); ?>"
                                       class="post-thumb-overlay text-center">
                                        <div class="text-uppercase text-center">View Post</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="post-content">
                                    <header class="entry-header text-uppercase">
                                        <h6>
                                            <a href="<?= Url::toRoute(['site/category', 'id' => $post->category->id]); ?>">
                                                <?= $post->category->name; ?></a></h6>

                                        <h1 class="entry-title"><a
                                                    href="<?= Url::toRoute(['site/view', 'id' => $post->id]); ?>">
                                                <?= $post->title; ?></a></h1>
                                    </header>
                                    <div class="entry-content">
                                        <p> <?= $post->content; ?>
                                        </p>
                                    </div>
                                    <div class="social-share">
                                        <span class="social-share-title pull-left text-capitalize">By Rubel On <?= $post->getDate(); ?></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

                <?php
                echo LinkPager::widget([
                    'pagination' => $pagination,
                ]);
                ?>
            </div>
            <?= $this->render('/components/sidebar', [
                'popular' => $popular,
                'recent' => $recent,
                'categories' => $categories,
            ]); ?>
        </div>
    </div>
</div>