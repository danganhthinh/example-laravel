<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository;
    }
    public function index()
    {
        $posts =  $this->postRepository->getAll();
        $hotPosts =  $this->postRepository->paginated(3, null, 'updated_at', 'DESC');
        return view('pages.home.index', compact('posts', 'hotPosts'));
        
    }
}
