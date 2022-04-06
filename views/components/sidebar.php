<?php

use yii\helpers\Url;

?>
<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>

            <?php foreach ($popular as $post):?>
                <div class="popular-post">

                    <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]); ?>" class="popular-img"><img src="<?=
                        $post->image->url ? '/uploads/' . $post->image->url : '/no-image.png'; ?>" alt="">

                        <div class="p-overlay"></div>
                    </a>

                    <div class="p-content">
                        <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]); ?>" class="text-uppercase"><?= $post->title; ?>></a>
                        <span class="p-date"><?= $post->getDate(); ?></span>

                    </div>
                </div>
            <?php endforeach;?>

        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>

            <?php foreach ($recent as $post):?>
                <div class="thumb-latest-posts">
                    <div class="media">
                        <div class="media-left">
                            <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]); ?>" class="popular-img"><img src="<?=
                                $post->image->url ? '/uploads/' . $post->image->url : '/no-image.png'; ?>" alt="">
                                <div class="p-overlay"></div>
                            </a>
                        </div>
                        <div class="p-content">
                            <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]); ?>" class="text-uppercase"><?= $post->title; ?></a>
                            <span class="p-date"><?= $post->getDate(); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>

        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                <?php foreach ($categories as $category):?>
                    <li>
                        <a href="<?= Url::toRoute(['site/category', 'id' => $post->category->id]); ?>"><?= $category->name; ?></a>
                        <span class="post-count pull-right"> (<?= $category->getPostsCount(); ?>)</span>
                    </li>
                <?php endforeach;?>

            </ul>
        </aside>
    </div>
</div>