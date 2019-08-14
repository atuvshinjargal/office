<?php

namespace TaskSharing\Http\Controllers;

use Prettus\Validator\Exceptions\ValidatorException;
use TaskSharing\Http\Controllers\Controller;
use TaskSharing\Repositories\CommandRepository;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    /**
     * @var TaskRepository
     */
    protected $command;


    /**
     * @param TaskRepository $repository
     * @param CategoryRepository $categoryRepository
     * @param UserRepository $userRepository
     */
    public function __construct(CommandRepository $repository)
    {
        $this->command = $repository;

        $this->setTitleOrDescription('Тушаал, шийдвэр, захирамж');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commands = $this->command->scopeQuery(function ($query) {
            return $query->latest();
        })->paginate();
        $category = $this->command->category();

        return $this->view('index', compact('commands', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->command->category();

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

            $com = $this->command->save($request->all());
            $pdfName = md5($com->id.'13') . '.' . $request->pdf->getClientOriginalExtension();
        
            $request->pdf->move(base_path() . '/public/command/pdf/', $pdfName);
            
        } catch (ValidatorException $e) {
            return $this->redirectBack()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('commands.index');
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
        $command = $this->command->find($id);
        $category = $this->command->category();

        return $this->view('edit', compact('command', 'category'));
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
            $com = $this->command->save($request->all(), $id);
            if ($request->hasFile('pdf')){
                $pdfName = md5($com->id.'13') . '.' . $request->pdf->getClientOriginalExtension();
                $request->pdf->move(base_path() . '/public/command/pdf/', $pdfName);
            }
        } catch (ValidatorException $e) {
            return $this->redirectBack()->withErrors($e->getMessageBag());
        }

        return $this->redirectRoute('commands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (file_exists(base_path() . '/public/command/pdf/'. md5($id.'13') . '.pdf')){
            unlink(base_path() . '/public/command/pdf/'. md5($id.'13') . '.pdf');
        }
        $this->command->destroy($id);
    }
}
