<?php
namespace App\Http\Controllers\Admin;

use App\Entities\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index() {
        $comments = (new Comment())->get();

        return view('admin.comments', ['comments' => $comments]);
    }

    public function acceptComment($id)
    {
        \DB::table('comments')->where('id', $id)->update(['status' => true]);
        return back();
    }
}
