<?php

namespace TaskSharing\Http\Controllers;

use TaskSharing\Events\InstallEvent;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use TaskSharing\Http\Requests;

class InstallController extends Controller
{
    /**
     * @var string
     */
    private $databasePath = 'resources/views/install/';

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->view('index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function requirements()
    {
        $requirements = [
            'php' => [
                'text' => 'PHP >= 5.5.9'
            ],
            'openssl' => [
                'text' => 'OpenSSL PHP Extension'
            ],
            'pdo' => [
                'text' => 'PDO PHP Extension'
            ],
            'mbstring' => [
                'text' => 'Mbstring PHP Extension'
            ],
            'tokenizer' => [
                'text' => 'Tokenizer PHP Extension'
            ]
        ];

        $is = 0;

        foreach ($requirements as $extension => &$requirement) {
            if ($extension === 'php') {
                $eLoaded = version_compare(PHP_VERSION, '5.5.9', '>=');
            } else {
                $eLoaded = extension_loaded($extension);
            }

            $requirement['isLoaded'] = $eLoaded;

            if (!$eLoaded) {
                $is++;
            }
        }

        if ($is > 0) {
            session(['requirements' => $is]);
        }

        return $this->view('server_requirements', compact('requirements'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function permissions()
    {
        session()->forget('permissions');

        $directories = [
            'storage/app/'       => ['permission' => '775'],
            'storage/framework/' => ['permission' => '775'],
            'storage/logs/'      => ['permission' => '775'],
            'bootstrap/cache/'   => ['permission' => '775']
        ];

        $is = 0;

        foreach ($directories as $directory => &$permission) {
            $perm = substr(sprintf('%o', fileperms(base_path($directory))), -4);

            $permission['is']   = $perm >= $permission['permission'];
            $permission['perm'] = $perm;

            if (!$permission['is']) {
                $is++;
            }
        }

        if ($is > 0) {
            session()->flash('permissions', $is);
        }

        return $this->view('permissions', compact('directories'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function database(Request $request)
    {
        $data = $request->all();

        $message = null;

        if (count($data) > 0) {
            $this->validate($request, [
                'host' => 'required',
                'database' => 'required',
                'username' => 'required'
            ], [], [
                'host' => 'Hostname',
                'database' => 'Database Name',
                'username' => 'Database Username'
            ]);

            try {
                new \PDO('mysql:host=' . $request->get("host") . ';dbname=' . $request->get("database"), $request->get('username'), $request->get('password'));
                $message = [
                    'text' => 'Connection Success',
                    'class' => 'success'
                ];
            } catch (\PDOException $e) {
                $message = [
                    'text' => $e->getMessage(),
                    'class' => 'danger'
                ];
            }
        }

        return $this->view('database', compact('message'));
    }

    /**
     * @param Request $request
     * @param Filesystem $filesystem
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function setup(Request $request, Filesystem $filesystem)
    {
        $this->validate($request, [
            'host' => 'required',
            'database' => 'required',
            'username' => 'required'
        ], [], [
            'host' => 'Hostname',
            'database' => 'Database Name',
            'username' => 'Database Username'
        ]);

        $data = $request->except('_token');

        $getStub = $filesystem->get(base_path($this->databasePath . 'database.stub'));

        $search = [];
        $replace = [];

        foreach ($data as $key => $value) {
            $search[] = "{{". $key ."}}";
            $replace[] = "'". $value ."'";
        }

        $filesystem->put(config_path('database.php'), str_replace($search, $replace, $getStub));

        return $this->redirectAction('InstallController@systemConfig');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function systemConfig(Request $request)
    {
        if ($request->method() === 'POST') {
            $data = $request->except('_token');

            $rules = [
                'title' => [
                    'long' => 'required',
                    'short' => 'required'
                ]
            ];

            $attributes = [
                'title' => [
                    'short' => 'Short Title',
                    'long' => 'Long Title'
                ]
            ];

            foreach ($request->get('priority') as $key => $value) {
                $rules['priority'][$key] = [
                    'order' => 'required|numeric',
                    'color' => 'required|regex:/\#[a-z0-9]{6}/'
                ];

                array_set($attributes, 'priority.' . $key . '.order', 'Order ' . $key);
                array_set($attributes, 'priority.' . $key . '.color', 'Color ' . $key);
            }

            $v = \Validator::make(array_dot($data), array_dot($rules), [], array_dot($attributes));

            if ($v->fails()) {
                return $this->redirectBack()->withErrors($v);
            }

            $task = \File::get(base_path($this->databasePath . 'task.stub'));

            $titles = array_get($data, 'title');
            $priorities = array_get($data, 'priority');

            uasort($priorities, function ($a, $b) {
                return ($a['order'] < $b['order']) ? -1:1;
            });

            $string = "";

            foreach ($priorities as $priority) {
                $string .= "        ". $priority["order"] . ' => ' . "'". $priority['color'] ."',\r\n";
            }

            $task = str_replace(
                [
                    '{{long}}',
                    '{{short}}',
                    '{{priorities}}'
                ], [
                $titles['long'],
                $titles['short'],
                rtrim($string, " \t\n\r\0\x0B,")
            ], $task
            );

            \File::put(config_path('task.php'), $task);

            return $this->redirectAction('InstallController@finish');
        }

        $default = config('task');

        return $this->view('system-config', compact('default'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function finish()
    {
        return $this->view('finish');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function home()
    {
        //event(new InstallEvent());

        return $this->redirectAction('HomeController@index');
    }
}