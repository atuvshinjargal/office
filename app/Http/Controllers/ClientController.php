<?php

namespace TaskSharing\Http\Controllers;

use TaskSharing\Criterias\ClientCriteria;
use TaskSharing\Repositories\ClientRepository;
use TaskSharing\Repositories\TaskRepository;
use TaskSharing\Repositories\UserRepository;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    protected $client;

    /**
     * @var TaskRepository
     */
    protected $task;

    /**
     * @param UserRepository $repository
     * @param TaskRepository $taskRepository
     */
    public function __construct(UserRepository $repository, TaskRepository $taskRepository)
    {
        $this->client = $repository;
        $this->client->pushCriteria(new ClientCriteria());

        $this->task = $taskRepository;

        $this->setTitleOrDescription('Clients');

        $this->middleware('level:1', [
            'only' => ['login']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clients = $this->client->paginate();

        return $this->view('index', compact('clients'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $tasks = $this->client->tasks($id);
        $status = $this->task->status();

        return $this->view('show', compact('tasks', 'status'));
    }

    /**
     * @param Guard $guard
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Guard $guard, $id)
    {
        $guard->loginUsingId($id);

        return $this->redirectRoute('home');
    }
}
