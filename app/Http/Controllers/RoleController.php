<?php

namespace TaskSharing\Http\Controllers;

use Prettus\Validator\Exceptions\ValidatorException;
use TaskSharing\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->role = $repository;
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->role->paginate();

        $this->setTitleOrDescription('Roles');
        return $this->view('index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->setTitleOrDescription('Эрхүүд');

        return $this->view('create');
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
            $this->role->create($request->all());
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->role->find($id);

        $this->setTitleOrDescription('Roles');
        return $this->view('edit', compact('role'));
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
            $this->role->update($request->all(), $id);
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->role->delete($id);
    }
}
