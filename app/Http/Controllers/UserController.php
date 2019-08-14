<?php

namespace TaskSharing\Http\Controllers;

use Prettus\Validator\Exceptions\ValidatorException;
use TaskSharing\Repositories\RoleRepository;
use TaskSharing\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @param UserRepository $repository
     * @param RoleRepository $roleRepository
     */
    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->user = $repository;
        $this->role = $roleRepository;
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->paginate();

        $this->setTitleOrDescription('Хэрэглэгчид');
        return $this->view('index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->role->lists('name', 'id')->all();

        $this->setTitleOrDescription('Хэрэглэгчид');
        return $this->view('create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $this->user->addUser($request->all());
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user  = $this->user->find($id);
        $roles = $this->role->lists('name', 'id')->all();

        $this->setTitleOrDescription('Users');
        return $this->view('edit', compact('user', 'roles'));
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
            $this->user->editUser($request->all(), $id);
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->user->delete($id);
    }
}
