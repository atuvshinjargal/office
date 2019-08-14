<?php

namespace TaskSharing\Http\Controllers;

use TaskSharing\Repositories\UserRepository;
use Illuminate\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * @var string
     */
    protected $viewPath;

    /**
     * @var string|null
     */
    protected $title = null;

    /**
     * @var  string|null
     */
    protected $description = null;

    /**
     * @param $view
     * @param array $data
     * @param array $mergeData
     *
     * @return \Illuminate\View\View
     */
    protected function view($view, $data = [], $mergeData = [])
    {
        $mergeData = array_merge($mergeData, $this->getTitleOrDescription());

        $this->setViewPath();

        array_set($mergeData, 'userTasks', app('TaskSharing\Repositories\UserRepository'));

        return view($this->viewPath . $view, $data, $mergeData);
    }

    /**
     * If is view path null set auto view path
     */
    private function setViewPath()
    {
        if (is_null($this->viewPath)) {
            $class = get_class($this);
            $parseControllerName = explode('\\', $class);

            $className = last($parseControllerName);
            $className = camel_case($className);
            $className = str_replace('Controller', '', $className);

            $this->viewPath = $className . '.';
        }
    }

    /**
     * @param string $title
     * @param null $description
     */
    protected function setTitleOrDescription($title = 'Task Sharing System', $description = null)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return array
     */
    protected function getTitleOrDescription()
    {
        return [
            'title' => $this->title,
            'description' => $this->description
        ];
    }

    /**
     * @param $route
     * @param array $parameters
     * @param int $status
     * @param array $headers
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectRoute($route, $parameters = [], $status = 302, $headers = [])
    {
        return redirect()->route($route, $parameters, $status, $headers);
    }

    /**
     * @param int $status
     * @param array $headers
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBack($status = 302, $headers = [])
    {
        return redirect()->back($status, $headers);
    }

    /**
     * @param $action
     * @param array $parameters
     * @param int $status
     * @param array $headers
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectAction($action, $parameters = [], $status = 302, $headers = [])
    {
        return redirect()->action($action, $parameters, $status, $headers);
    }

    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($data = [], $status = 200, array $headers = [], $options = 0)
    {
        return response()->json($data, $status, $headers, $options);
    }
}
