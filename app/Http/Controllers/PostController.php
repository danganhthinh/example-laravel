<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use Carbon\Carbon;

class PostController extends BaseController
{
    protected $postRepository;
    protected $categoryRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository;
        $this->categoryRepository = new CategoryRepository;
    }

    public function detail($id)
    {
        $post = $this->postRepository->find($id);
        $relatedPosts = $this->postRepository->getRelatedPost($post);
        $hotPosts =  $this->postRepository->getHotPostByPost($post);
        return view('pages.post.detail', compact('post', 'relatedPosts', 'hotPosts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->postRepository->getPostFilter($request);
        $categories =  $this->categoryRepository->getAll();

        if ($request->ajax()) {
            return view('admin.pages.posts.grid', compact('data', 'categories'));
        }

        return view('admin.pages.posts.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll(null, 'updated_at');
        return view('admin.pages.posts.form.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time = Carbon::now()->timestamp;
        $thumbnail = $request->thumbnail;
        $nameFile = $thumbnail->getClientOriginalName();
        $nameFile = str_replace(' ', '', $time . $nameFile);
        $request->file('thumbnail')->storeAs('public/posts', $nameFile);
        $this->postRepository->create([
            'thumbnail' => $nameFile,
            'title' => $request->title,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        return $this->sendResponse([
            'success' => "1"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postRepository->destroy($id);
        return $this->sendResponse("success");
    }
}
