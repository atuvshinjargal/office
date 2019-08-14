<?php

namespace TaskSharing\Http\Controllers;

use Prettus\Validator\Exceptions\ValidatorException;
use TaskSharing\Criterias\ClientCriteria;
use TaskSharing\Repositories\CategoryRepository;
use TaskSharing\Repositories\TaskRepository;
use TaskSharing\Repositories\UserRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    protected $task;

    /**
     * @var CategoryRepository
     */
    protected $category;

    /**
     * @var UserRepository
     */
    protected $client;

    /**
     * @param TaskRepository $repository
     * @param CategoryRepository $categoryRepository
     * @param UserRepository $userRepository
     */
    public function __construct(TaskRepository $repository, CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $this->task = $repository;
        $this->category = $categoryRepository;
        $this->client = $userRepository;

        $this->client->pushCriteria(new ClientCriteria());

        $this->setTitleOrDescription('Tasks');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = $this->task->scopeQuery(function ($query) {
            return $query->latest();
        })->paginate();
        $status = $this->task->status();
        $categories = $this->category->lists('name', 'id')->all();

        return $this->view('index', compact('tasks', 'status', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->category->lists('name', 'id')->all();
        $status = $this->task->status();

        return $this->view('create', compact('categories', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $this->task->save($request->all());
        } catch (ValidatorException $e) {
            return $this->redirectBack()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = $this->task->find($id);
        $categories = $this->category->lists('name', 'id')->all();
        $status = $this->task->status();

        return $this->view('edit', compact('task', 'categories', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $this->task->save($request->all(), $id);
        } catch (ValidatorException $e) {
            return $this->redirectBack()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $this->task->destroy($id);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findClient(Request $request)
    {
        $data = $this->client->search($request->get('query'));

        return $this->responseJson($data);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function note($id)
    {
        $task = $this->task->find($id);

        return $this->view('note', compact('task'));
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function noteSave(Request $request, $id)
    {
        $this->validate($request, [
            'note' => 'required'
        ], [
            'note.required' => 'Please enter notes'
        ]);

        $this->task->note($request->get('note'), $id);
    }
}
