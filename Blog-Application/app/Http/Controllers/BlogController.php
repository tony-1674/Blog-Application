<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class BlogController extends Controller
{
    public function postDelete($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin-panel')->with('success', 'Post deleted successfully');
    }
    public function postEdit(Request $request,$id){
        $postOriginalName = $request->file('post')->getClientOriginalName();
        
        $request->file('post')->move(public_path('posts'), $postOriginalName);

        
        $validator = Validator::make($request->all(), [
            'post' => 'required',
            'title' => 'required',
            'content' => 'required',
            'category_id'=>'required'
        ]);
        

        $post = Post::findOrFail($id);
        $post->update([
            'title'=> $request->title,
            'content'=> $request->content,
            'post'=> $postOriginalName,
            'category_id'=> $request->category_id,
            'updated_at'=>now()
        ]);
    }
    public function adminPanel(){
        $posts = Post::all();
        return view('admin-panel',compact('posts'));
    }
    public function comment(Request $request, $id){
        $comment = Comment::create([
            'post_id' => $id,
            'user_id' => $request->user_id,
            'comment' => $request->comment,
            'created_at' => now(),
        ]);

        if ($comment) {
            return back()->with('success', 'Comment added successfully');
        } else {
            return back()->with('error', 'Failed to add comment');
        }
    }
    public function mobiles(){
        $mobiles = Post::where('category_id', 'mobile')->get();
        $comments = Post::with('comments')->get();
        return view('mobiles', compact('mobiles', 'comments'));
    }
    public function electronics(){
        $electronics = Post::where('category_id', 'electronic')->get();
        $comments = Post::with('comments')->get();
        return view('electronics', compact('electronics', 'comments'));
    }
    public function cars(){
        $cars = Post::where('category_id', 'car')->get();
        $comments = Post::with('comments')->get();
        return view('cars', compact('cars','comments'));
    }
    public function postShow(){
        $posts = Post::where('category_id', 'post')->get();
        $comments = Post::with('comments')->get();
        $comments = Post::with('comments')->get();
        
        return view('posts', compact('posts','comments'));
    }
    public function logout(){
        auth()->logout();
        
        return redirect()->route('login');
    }
    public function postUpload(Request $request){
        
        $postOriginalName = $request->file('post')->getClientOriginalName();
        
        $request->file('post')->move(public_path('posts'), $postOriginalName);

        
        $validator = Validator::make($request->all(), [
            'post' => 'required',
            'title' => 'required',
            'content' => 'required',
            'category_id'=>'required'
        ]);
        

        $post = Post::Create([
            'title'=> $request->title,
            'content'=> $request->content,
            'post'=> $postOriginalName,
            'category_id'=> $request->category_id,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        if($post){
            return back()->with('success', 'Post uploaded successfully');
        }
        return back()->with('error', 'An error occurred');
    }
    public function home(){
        $posts = Post::all();
        // $comments = Post::with('comments')->get();
        $comments = Post::with(['comments.user'])->get();

        // return $comments;
        return view('home', compact('posts','comments'));
    }
    public function loginPost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $credentials = $request->only('email', 'password');
        // dd(Auth::attempt($credentials));
        if(Auth::attempt($credentials)){
            return redirect()->route('home');
        }else{
            return back()->withErrors(['message'=>'Invalid credentials'])->withInput();
        }
        
        return $request->all();
    }
    public function login()
    {
        return view('login');
    }
    public function index()
    {
        return view('register');
    }
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        return redirect()->route('login')->with('message', 'User registered successfully');
    }
}
