@extends('layouts.admin')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Комментарии</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                </button>
            </div>
        </div>

        <h2>Комментарии на модерации:</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Статья</th>
                    <th>Пользователь</th>
                    <th>Комментарий</th>
                    <th>Статус</th>
                    <th>Дата добавления</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    function gettingUser($user_id)
                    {
                        $objUser = \App\Entities\User::find($user_id);
                        if(!$objUser) {
                            return abort(404);
                        }
                        return $objUser;
                    }

                    function gettingArticle($article_id) {
                        $objUser = \App\Entities\Article::find($article_id);
                        if(!$objUser) {
                            return abort(404);
                        }
                        return $objUser;
                    }
                ?>
                @foreach($comments as $comment)
                    @if(empty($comment->status))
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{gettingArticle($comment->article_id)->title}}</td>
                            <td>{{gettingUser($comment->user_id)->email}}</td>
                            <td>{{$comment->comment}}</td>
                            <td>На модерации<br><a href="{!! route('comments.accepted', ['id' => $comment->id]) !!}">Одобрить</a></td>
                            <th>{{$comment->created_at->format('d-m-Y H:i')}}</th>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </main>

@stop