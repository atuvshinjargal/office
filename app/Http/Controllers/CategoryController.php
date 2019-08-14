<?php

namespace TaskSharing\Http\Controllers;

use Prettus\Validator\Exceptions\ValidatorException;
use TaskSharing\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $category;

    /**
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->category = $repository;

        $this->setTitleOrDescription('Categories');
        
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->paginate();

        return $this->view('index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $this->category->create($request->all());
        } catch (ValidatorException $e) {
            return $this->redirectBack()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->category->find($id);

        return $this->view('edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->category->update($request->all(), $id);
        } catch (ValidatorException $e) {
            return $this->redirectBack()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->category->delete($id);
    }
}
