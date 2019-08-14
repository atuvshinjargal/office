<?php

namespace TaskSharing\Http\Controllers;

use Prettus\Validator\Exceptions\ValidatorException;
use TaskSharing\Http\Controllers\Controller;
use TaskSharing\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
     /**
     * @var TaskRepository
     */
    protected $post;
    
    /**
     * @param TaskRepository $repository
     * @param CategoryRepository $categoryRepository
     * @param UserRepository $userRepository
     */
    public function __construct(PostRepository $repository)
    {
        $this->post = $repository;

        $this->setTitleOrDescription('Мэдээлэл, шуурхай зар');
        $this->middleware('role:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->scopeQuery(function ($query) {
            return $query->latest();
        })->paginate();
        
        $category = $this->post->category();

        return $this->view('index', compact('posts', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->post->category();

        return $this->view('create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $this->post->save($request->all());
            
        } catch (ValidatorException $e) {
            return $this->redirectBack()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('posts.index');
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
        $post = $this->post->find($id);
        $category = $this->post->category();

        return $this->view('edit', compact('post', 'category'));
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
        try {
            $this->post->save($request->all(), $id);
        } catch (ValidatorException $e) {
            return $this->redirectBack()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->command->destroy($id);
    }
}
