<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\posts;
use App\Models\User;



Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->push('一覧表示', route('post.index'));
});

Breadcrumbs::for('create', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('index');
    $trail->push($title, route('post.create'));
});

Breadcrumbs::for('show', function (BreadcrumbTrail $trail, posts $post) {
    $trail->parent('index');
    $trail->push($post->location, route('post.show',$post));
});

Breadcrumbs::for('edit', function (BreadcrumbTrail $trail, posts $post, $title) {
    $trail->parent('show',$post);
    $trail->push($title, route('post.edit',$post));
});



Breadcrumbs::for('account_index', function (BreadcrumbTrail $trail) {
    $trail->push('アカウント一覧', route('profile.index'));
});

Breadcrumbs::for('user_create', function (BreadcrumbTrail $trail) {
    $trail->parent('account_index');
    $trail->push('アカウント登録', route('register'));
});

Breadcrumbs::for('user_edit', function (BreadcrumbTrail $trail, User $user, $title) {
    $trail->parent('account_index');
    $trail->push($title, route('profile.edit',$user));
});

Breadcrumbs::for('user_delete', function (BreadcrumbTrail $trail, User $user, $title) {
    $trail->parent('account_index');
    $trail->push($title, route('profile.show',$user));
});

Breadcrumbs::for('user_index', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('account_index');
    $trail->push($user->family_name.'さんの投稿', route('post.userIndex',$user));
});

Breadcrumbs::for('user_show', function (BreadcrumbTrail $trail, User $user, posts $post) {
    $trail->parent('user_index',$user);
    $trail->push($post->location, route('post.userShow', ['user' => $user,'post' => $post]));
});

Breadcrumbs::for('userEdit', function (BreadcrumbTrail $trail, User $user, posts $post, $title) {
    $trail->parent('user_show',$user,$post);
    $trail->push($title, route('post.edit',['user' => $user,'post' => $post]));
});




