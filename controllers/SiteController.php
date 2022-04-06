<?php

namespace app\controllers;

use app\models\Category;
use app\models\CommentForm;
use app\models\Post;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Post::getAll(1);

        $popular = Post::getPopular();
        $recent = Post::getRecent();
        $categories = Category::getAll();

        return $this->render('index', [
            'posts' => $data['posts'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
        ]);
    }

    public function actionView($id)
    {
        $post = Post::findOne($id);
        $data = Post::getAll(1);

        $popular = Post::getPopular();
        $recent = Post::getRecent();
        $categories = Category::getAll();
        $comments = $post->getComments();
        $commentForm = new CommentForm();

        return $this->render('post', [
            'post' => $post,
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
            'comments' => $comments,
            'commentForm' => $commentForm,
        ]);
    }

    public function actionCategory($id)
    {
        $data = Category::getPostsByCategory($id);

        $popular = Post::getPopular();
        $recent = Post::getRecent();
        $categories = Category::getAll();

        return $this->render('category', [
            'posts' => $data['posts'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
        ]);
    }

    public function actionComment($id)
    {
        $model = new CommentForm();

        if (Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if ($model->saveComment($id))
            {
                return $this->redirect(['site/view', 'id' => $id]);
            }
        }
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
