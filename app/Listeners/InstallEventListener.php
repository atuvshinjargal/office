<?php

namespace TaskSharing\Listeners;

use TaskSharing\Events\InstallEvent;
use Illuminate\Filesystem\Filesystem;

class InstallEventListener
{
    /**
     * @var Filesystem
     */
    private $file;

    /**
     * Create the event listener.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->file = $filesystem;
    }

    /**
     * Handle the event.
     *
     * @param  InstallEvent  $event
     * @return void
     */
    public function handle(InstallEvent $event)
    {
        $filesAndDir = $this->getFilesAndDir();

        $this->file->delete(array_get($filesAndDir, 'files'));
        $this->file->deleteDirectory(array_get($filesAndDir, 'dir'));

        $files = $this->file->allFiles(array_get($filesAndDir, 'stubs'));

        foreach ($files as $file) {
            $fileContent = $this->file->get(app_path('Listeners'. DIRECTORY_SEPARATOR .'stub' . DIRECTORY_SEPARATOR . $file->getFileName()));

            preg_match('/namespace\s[A-Za-z\\\]+/', $fileContent, $m);

            $parse = explode('\\', $m[0]);
            $fName = last($parse) . DIRECTORY_SEPARATOR . str_replace('stub', 'php', $file->getFileName());

            $this->file->put(app_path($fName), $fileContent);
        }
    }

    /**
     * @return array
     */
    private function getFilesAndDir()
    {
        $seperator = DIRECTORY_SEPARATOR;

        return [
            'files' => [
                app_path('Http'. $seperator .'Controllers'. $seperator .'InstallController.php'),
                app_path('Http'. $seperator .'Middleware'. $seperator .'InstallMiddleware.php'),
                app_path('Http'. $seperator .'install-routes.php')
            ],
            'dir' => base_path('resources'. $seperator .'views'. $seperator .'install'),
            'stubs' => app_path('Listeners'. $seperator .'stub')
        ];
    }
}
