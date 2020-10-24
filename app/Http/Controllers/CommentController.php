<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request) {
        $comment = $request->input('comment');
        $article_id = (int) $request->input('article_id');
        $user_id = (int) auth()->user()->id;

        $objComment = new Comment();
        $objComment = $objComment->create([
            'article_id' => $article_id,
            'user_id' => $user_id,
            'comment' => $comment,
        ]);

        if($objComment) {
            return back()->with('success', 'Ваш комментарий отправлен модератору на проверку. Ваше послание будет опубликовано после модерации ;)');
            //return back();
        }
        return back()->with('error', 'Прозошла ошибка в добавлении вашего комментария. Попробуйте отпрвить комментарий позже');
        //return back();
    }


}
