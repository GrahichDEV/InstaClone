<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Fire
Route::put('/post/like', function(Request $request) {
    $post = Post::find($request->post_id);
    $likes = $post->likes += 1;
    $post->save();

    // Find author id with post_id
    $authorID = $post->authorID;
    $user = User::find($authorID);
    // $user = User::find($request->author_id);
    $user->likes += 1;
    $user->save();

    // return redirect('/');
    // return Inertia::render('/', ['likes' => $likes]);
    return "liked";
});

Route::post('/comment', function(Request $request) {
    Comment::create([
        'author' => $request->author_username,
        'author_image' => $request->author_image,
        'text' => $request->text,
        'postID' => $request->post_id,
    ]);

    return redirect('/');
});


Route::get('/comments/{id}/{limit}', function($id, $limit) {
    $comments = Comment::where('postID', $id)->orderBy('id', 'desc')->take($limit)->get();

    return $comments;
});
