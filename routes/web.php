<?php

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

// Add a limit to loaded posts ...
// On scroll i can add in the api and fetch with axios ... if user wants to load more posts ... load next 5 ...
Route::get('/', function() {
    $posts = Post::orderBy('id', 'desc')->get();
    $posts_authors = [];

    foreach($posts as $key=>$post) {
        $author = User::find($post->authorID);
        $comments = Comment::where('postID', $post->id)->orderBy('id', 'desc')->get();

        $posts_authors[$key]['author_id'] = $author->id;
        $posts_authors[$key]['author_username'] = $author->username;
        $posts_authors[$key]['author_image'] = $author->image;
        $posts_authors[$key]['post_id'] = $post->id;
        $posts_authors[$key]['post_image'] = $post->image;
        $posts_authors[$key]['post_title'] = $post->title;
        $posts_authors[$key]['post_text'] = $post->text;
        $posts_authors[$key]['post_likes'] = $post->likes;
        $posts_authors[$key]['post_comments'] = $comments;
    }

    // dd($posts_authors);

    return Inertia::render('Home', ['auth' => Auth::user(), 'posts' => $posts_authors]);
})->middleware('auth');


Route::get('/profile/{username}', function($username) {
    $profile = User::where('username', $username)->first();
    $post = Post::where('authorID', $profile->id)->get();

    return Inertia::render('Profile', [
        'auth' => Auth::user(),
        'profile' => $profile,
        'posts' => $post
    ]);
});

Route::get('/login', function() {

    return Inertia::render('Login');
})->name('login');

Route::post('/login', function(Request $request) {

    auth()->attempt($request->only('email', 'password'));

    return redirect('/');
});

// Register
Route::get('/register', function() {
    return Inertia::render('Register');
});

Route::post('/register', function(Request $request) {
    $request->validate([
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'email' => 'required|max:255|email',
        'password' => 'required|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    auth()->attempt($request->only('email', 'password'));

    return redirect('/settings');
});



Route::get('/settings', function() {
    return inertia('Settings', ['auth' => Auth::user()]);
});

Route::post('/settings', function(Request $request) {
    // $newImageName = time() . '-' . Auth::user()->username . '.' . $request->image->extension();
    $newImageName = Auth::user()->username . '.' . $request->image->extension();

    // $image = (strlen($request->image) > 0) ? $request->file('file')->store('uploads') : "empty";
    $request->image->move(public_path('uploads/profile/'), $newImageName);

    $user = User::find(Auth::user()->id);
    $user->image = $newImageName;
    $user->save();

    return redirect('/');
});


Route::get('/logout', function() {
    auth()->logout();

    return redirect('/');
});

Route::get('/delall', function() {
    Post::getQuery()->delete();

    return redirect('/');
});


Route::get('/post', function() {
    return inertia('Post', ['auth' => Auth::user()]);
})->middleware('auth');

Route::post('/post', function(Request $request) {
    $request->validate([
        'title' => 'required|max:255',
        'text' => 'required|max:255',
        'image' => 'required',
    ]);

    $user = User::find(Auth::user()->id);
    $user->posts += 1;
    $user->save();

    $newImageName = time() . '-' . Auth::user()->username . '.' . $request->image->extension();
    // $image = (strlen($request->image) > 0) ? $request->file('file')->store('uploads') : "empty";
    // $request->image->move(public_path('uploads/posts/'. Auth::user()->username . '/'), $newImageName);
    $request->image->move(public_path('uploads/posts/'), $newImageName);

    POST::create([
        'authorID' => Auth::user()->id,
        'title' => $request->title,
        'text' => $request->text,
        'image' => $newImageName,
    ]);

    return redirect('/');
});

