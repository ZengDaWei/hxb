<?php

namespace App\Admin\Controllers;

use App\Article;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);
        $grid->column('id', __('Id'));
        $grid->column('code', __('所属类型'))->using([0 => '文字文章', 1 => '视频文章']);
        $grid->column('title', __('标题'));
        $grid->column('cover', __('封面'))->image(20, 20);
        $grid->column('description', __('描述'));
        $grid->column('status', __('状态'))->using([0 => '草稿', 1 => '发布', 2 => '精选', 3 => '热门']);
        $grid->column('count_comments', __('评论总数'));
        $grid->column('count_likes', __('喜欢总数'));
        $grid->column('count_reads', __('总阅读数'));
        $grid->column('count_words', __('总字数'));
        $grid->column('published_at', __('发布时间'));
        $grid->column('user.name', __('作者'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

        $grid->filter(function ($filter) {
            $filter->between('created_at', '创建时间')->datetime();
            $filter->like('title', '标题');
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('code', __('所属类型'))->using([0 => '文字文章', 1 => '视频文章']);
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('cover', __('Cover'))->image(50, 50);
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('count_comments', __('Count comments'));
        $show->field('count_likes', __('喜欢总数'));
        $show->field('count_reads', __('总阅读数'));
        $show->field('count_words', __('总字数'));
        $show->field('published_at', __('发布时间'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article);

        $form->number('code', __('Code'));
        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));
        $form->image('cover', __('Cover'))->image(50, 50);
        $form->text('description', __('Description'));
        $form->number('status', __('Status'));
        $form->number('count_comments', __('Count comments'));
        $form->number('count_likes', __('喜欢总数'));
        $form->number('count_reads', __('总阅读数'));
        $form->number('count_words', __('总字数'));
        $form->datetime('published_at', ('__发布时间at'))->default(date('Y-m-d H:i:s'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
