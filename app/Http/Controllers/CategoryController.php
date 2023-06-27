<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $categoryRepository;
    protected $postRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository;
        $this->postRepository = new PostRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->categoryRepository->getCategoryFilter($request);

        if ($request->ajax()) {
            return view('admin.pages.categories.grid', compact('data'));
        }

        return view('admin.pages.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->categoryRepository->create([
            'name' => $request->name,
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
        $posts = $this->postRepository->filter(['category_id' => $id]);

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $this->postRepository->destroy($post->id);
            }
        }
        $this->categoryRepository->destroy($id);
        return $this->sendResponse("success");
    }
}
