<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', __('用户 ID '))->sortable();
        $grid->column('name', __('昵称'))->filter('like')->editable();
        $grid->column('email', __('邮箱'));
        $grid->column('level', __('等级'));
        $grid->column('status', __('状态'))->editable('select', [0 => '正常', 1 => '冻结']);
        $grid->column('avatar', __('头像'))->image(50, 50);
        $grid->column('gold', __('金币'));
        $grid->column('count_fans', __('粉丝数'));
        $grid->column('count_follows', __('关注数'));
        $grid->column('count_articles', __('文章数'));
        $grid->column('count_likes', __('点赞数'));
        $grid->column('count_words', __('总字数'));
        $grid->column('created_at', __('注册时间'));
        $grid->column('updated_at', __('最近更改时间'));

        $grid->filter(function ($filter) {
            $filter->between('created_at', '创建时间')->datetime();
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('用户 ID '));
        $show->field('name', __('昵称'));
        $show->field('email', __('邮箱'));
        $show->field('level', __('等级'));
        $show->field('status', __('状态'));
        $show->field('avatar', __('头像'));
        $show->field('gold', __('金币'));
        $show->field('count_fans', __('粉丝数'));
        $show->field('count_follows', __('关注数'));
        $show->field('count_articles', __('文章数'));
        $show->field('count_likes', __('点赞数'));
        $show->field('count_words', __('总字数'));
        $show->field('created_at', __('注册时间'));
        $show->field('updated_at', __('最近更改时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('name', __('昵称'));
        $form->text('email', __('邮箱'));
        $form->number('level', __('等级'));
        $form->text('status', __('状态'));
        $form->image('avatar', __('头像'))->image('', 100, 100);
        $form->number('gold', __('金币'));
        $form->number('count_fans', __('粉丝数'));
        $form->number('count_follows', __('关注数'));
        $form->number('count_articles', __('文章数'));
        $form->number('count_likes', __('点赞数'));
        $form->number('count_words', __('总字数'));
        $form->datetime('created_at', __('注册时间'));
        $form->datetime('updated_at', __('最近更改时间'));

        return $form;
    }
}
