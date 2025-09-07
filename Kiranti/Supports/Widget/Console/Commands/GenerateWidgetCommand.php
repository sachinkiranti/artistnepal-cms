<?php

namespace Kiranti\Supports\Widget\Console\Commands;

use Kiranti\Config\Widget;
use Illuminate\Support\Arr;
use Kiranti\Lib\FileHandler;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

/**
 * Class GenerateWidgetCommand
 * @package Kiranti\Supports\Widget\Console\Commands
 */
final class GenerateWidgetCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'widget:generate {--force : Force will recreate the theme}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold the widgets';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    public function handle()
    {
        $fileSystem = new FileHandler();

        $collection = json_decode($fileSystem->content(
            theme_path(strtolower(active_theme()).'/widget.json')
        ), 1);

        $content = $fileSystem->content(
            __DIR__ . DIRECTORY_SEPARATOR .'stubs'.DIRECTORY_SEPARATOR  . 'widget.blade.stub'
        );

        foreach (Arr::except($collection, 'preview') as $key => $paths) {

            foreach (array_keys($paths) as $path) {

                $resolvedPath = $key === 'components' ?  Widget::COMPONENT_PATH : Widget::TEMPLATE_PATH;

                $path = theme_path(
                    strtolower(active_theme()).'/views/'. str_replace('.', DIRECTORY_SEPARATOR , $resolvedPath . $path) .'.blade.php'
                );

                if (!$fileSystem->exists($path) || $this->option('force')) {
                    file_put_contents(
                        $path,
                        stripslashes($content)
                    );
                }
            }
        }

        $this->info('Widget is successfully generated.');
    }

}
