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
    protected $title = 'App\Article';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);

        $grid->column('id', __('Id'));
        $grid->column('code', __('Code'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'));
        $grid->column('cover', __('Cover'));
        $grid->column('description', __('Description'));
        $grid->column('status', __('Status'));
        $grid->column('count_comments', __('Count comments'));
        $grid->column('count_likes', __('Count likes'));
        $grid->column('count_reads', __('Count reads'));
        $grid->column('count_words', __('Count words'));
        $grid->column('published_at', __('Published at'));
        $grid->column('user_id', __('User id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show->field('code', __('Code'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('cover', __('Cover'));
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('count_comments', __('Count comments'));
        $show->field('count_likes', __('Count likes'));
        $show->field('count_reads', __('Count reads'));
        $show->field('count_words', __('Count words'));
        $show->field('published_at', __('Published at'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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
        $form->image('cover', __('Cover'));
        $form->text('description', __('Description'));
        $form->number('status', __('Status'));
        $form->number('count_comments', __('Count comments'));
        $form->number('count_likes', __('Count likes'));
        $form->number('count_reads', __('Count reads'));
        $form->number('count_words', __('Count words'));
        $form->datetime('published_at', __('Published at'))->default(date('Y-m-d H:i:s'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
