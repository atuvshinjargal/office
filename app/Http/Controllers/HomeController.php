<?php

namespace TaskSharing\Http\Controllers;

use TaskSharing\Http\Requests;
use TaskSharing\Repositories\TaskRepository;
use TaskSharing\Repositories\UserRepository;
use TaskSharing\Repositories\CommandRepository;
use TaskSharing\Repositories\PostRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * @var TaskRepository
     */
    protected $task;

    /**
     * @var TaskRepository
     */
    protected $command;
    /**
     * @var TaskRepository
     */
    protected $post;
    /**
     * @param UserRepository $userRepository
     * @param TaskRepository $taskRepository
     */
    public function __construct(UserRepository $userRepository, TaskRepository $taskRepository,CommandRepository $commandRepository,PostRepository $postRepository)
    {
        $this->user = $userRepository;
        $this->task = $taskRepository;
        $this->command = $commandRepository;
         $this->post = $postRepository;

        $this->setTitleOrDescription('Нүүр');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $commands = $this->command->scopeQuery(function ($query) {
            return $query->latest();
        })->paginate();
        $posts = $this->post->scopeQuery(function ($query) {
            return $query->latest();
        })->paginate();
        $category = $this->command->category();

        return $this->view('index', compact('commands','category','posts'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function calendar()
    {
        $information = $this->user->myTasksInformation();

        return $this->view('calendar', compact('information'));
    }
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function calendarTasks(Request $request)
    {
        return $this->user->calendarTasks($request->get('start'), $request->get('end'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function tasks()
    {
        $this->setTitleOrDescription('My Tasks');

        $tasks = $this->user->tasks();
        $status = $this->task->status();

        return $this->view('tasks', compact('tasks', 'status'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function task($id)
    {
        $task = $this->user->myTasks()->find($id);
        $status = $this->task->status();

        return $this->view('task', compact('task', 'status'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return mixed
     */
    public function taskSave(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'in:note,complete'
        ]);

        $this->user->updateNote($request->except('_token') + ['id' => $id]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function notFound()
    {
        return view('errors.404');
    }
}
