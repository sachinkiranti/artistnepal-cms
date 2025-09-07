<?php

namespace Kiranti\Supports\Generator\Console;

use Illuminate\{Console\Command, Support\Composer, Filesystem\Filesystem, Config\Repository as Config, Support\Str};
use Kiranti\Supports\Generator\Handlers\ColumnHandler;
use Kiranti\Supports\Generator\Handlers\FormHandler;
use Kiranti\Supports\Generator\Handlers\MenuHandler;
use Kiranti\Supports\Generator\Handlers\RouteHandler;
use Kiranti\Supports\Generator\Handlers\ShowBladeHandler;
use Kiranti\Supports\Generator\Handlers\TableHeadHandler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

/**
 * Class GenerateCommand
 * @package Kiranti\Supports\Generator\Console
 */
final class GenerateCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'kiranti:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate entities, migrations, requests, services, controller and views';

    /**
     * The Composer class instance.
     *
     * @var Composer
     */
    private $composer;

    /**
     * Repository config.
     *
     * @var $config
     */
    private $config;

    /**
     * Filesystem Manager
     *
     * @var $files
     */
    private $files;

    /**
     * GenerateCommand constructor.
     *
     * @param Composer $composer
     * @param Config $config
     * @param Filesystem $files
     */
    public function __construct(Composer $composer, Config $config, Filesystem $files)
    {
        parent::__construct();

        $this->composer = $composer;
        $this->config   = $config;
        $this->files    = $files;
    }

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('Generator init!');
        $this->checkingIfModuleIsCreatable();

        $structures = $this->config->get('generator.path');

        if ($structures && count($structures)) :
            foreach ($structures as $entity => $structure) :

                if (! in_array($entity, $this->config->get('generator.default_path'))) { //$entity !== 'controller_path'
                    $structure = $this->getPath($structure);
                }

                $this->mkdir($structure);
            endforeach;
        endif;

        $this->initGenerator($structures);

        $this->composer->dumpAutoloads();
        $this->call('optimize:clear');
    }

    /**
     * Initialize Generator
     *
     * @param array $structures
     * @throws FileNotFoundException
     */
    private function initGenerator(array $structures)
    {
        $rootPath = $this->config->get('generator.root_path', base_path('Foundation'));

        if ($this->option('request')) :
            $this->generateRequests($this->resolvePath($rootPath, $structures['request_path'] ?? ''));
        endif;

        if ($this->option('views')) :
            $this->generateViews();
        endif;

        if ($this->option('services')) :
            $this->generateService($this->resolvePath($rootPath, $structures['service_path'] ?? ''));
        endif;

        if ($this->option('controller')) :
            $this->generateMCR($rootPath);
        endif;

        $this->generateApiResources($this->resolvePath($rootPath, $structures['api_resource_path'] ?? ''));

        if (
            $this->option('controller') || $this->option('request') || $this->option('services') || $this->option('views')
        ) {
            $this->info('All operations completed successfully !');
            die;
        }

        $this->generateMCR($rootPath);
        $this->generateRequests($this->resolvePath($rootPath, $structures['request_path'] ?? ''));
        $this->generateService($this->resolvePath($rootPath, $structures['service_path'] ?? ''));
        $this->generateViews();
    }

    /**
     * Generate Model and Controller
     *
     * @param string $rootPath
     * @throws FileNotFoundException
     */
    protected function generateMCR(string $rootPath)
    {
        $controllerPath  = $this->config->get('generator.path.controller_path');
        $className = $this->resolveClassName();
        $modelPath = $this->resolvePath($rootPath, $this->config->get('generator.path.model_path') ?? '');

        $this->generateMigration();

        if (! $this->option('api')) {
            $this->makeFile($controllerPath.$className.'Controller.php', $this->resolveStub('controller',$this->resolveArgs($className)));
        }

        $this->makeFile($modelPath.$className.'.php', $this->resolveStub('model', $this->resolveArgs($className)));

        $this->info('Generator has successfully generated the Model and Controller for you.');
        $this->appendRoute();
        $this->addSeederAndFactories();
        $this->appendMenu();
    }

    protected function generateMigration()
    {
        $className = Str::plural(strtolower($this->resolveClassName()));
        $this->call("make:migration", [
            'name' => "create_{$className}_table"
        ]);
    }

    /**
     * Append routes --resource
     *
     * @return void
     */
    protected function appendRoute()
    {
        $className = strtolower($this->resolveClassName());

        RouteHandler::handle($className);
        $this->info('Generator has successfully appended routes for you.');
    }

    /**
     * Append menu
     *
     * @return void
     */
    protected function appendMenu()
    {
        $className = strtolower($this->resolveClassName());

        MenuHandler::handle($className);
        $this->info('Generator has successfully appended menu for you.');
    }

    /**
     * @throws FileNotFoundException
     */
    protected function addSeederAndFactories()
    {
        $className = $this->resolveClassName();
        $_seeder = 'database/seeds/';
        $_factory = 'database/factories/';

        $this->makeFile($_seeder.$className.'TableSeeder.php', $this->resolveStub('seeder',$this->resolveArgs($className)));
        $this->makeFile($_factory.$className.'Factory.php', $this->resolveStub('factory',$this->resolveArgs($className)));

        $this->info('Generator has successfully added seeder and factory for you.');
    }

    /**
     * Generate the api resources
     *
     * @param string $rootPath
     * @throws FileNotFoundException
     */
    protected function generateApiResources(string $rootPath)
    {
        if ($this->option('api')) {
            $controllerPath  = $this->config->get('generator.path.api_controller_path');
            $className = $this->resolveClassName();
            $this->makeFile($controllerPath.$className.'Controller.php', $this->resolveStub('api_controller', $this->resolveArgs($className)));
            $this->makeFile($rootPath.$className.'Resource.php', $this->resolveStub('resource', $this->resolveArgs($className)));
            $this->info('Generator has successfully generated api resources Controller for you.');
        }
    }

    /**
     * Generate Form requests
     *
     * @param string $rootPath
     * @throws FileNotFoundException
     */
    protected function generateRequests(string $rootPath)
    {
        $className = $this->resolveClassName();
        $this->mkdir($rootPath.$className);
        $rootPath = $rootPath.$className.DIRECTORY_SEPARATOR;

        $this->makeFile($rootPath.'StoreRequest.php', $this->resolveStub('storerequest', $this->resolveArgs($className)));
        $this->makeFile($rootPath.'UpdateRequest.php', $this->resolveStub('updaterequest', $this->resolveArgs($className)));

        $this->info('Generator has successfully generated the requests for you.');
    }

    /**
     * Generate Services
     *
     * @param string $rootPath
     * @throws FileNotFoundException
     */
    protected function generateService(string $rootPath)
    {
        $className = $this->resolveClassName();
        $this->makeFile($rootPath.$className.'Service.php', $this->resolveStub('service', $this->resolveArgs($className)));
        $this->info('Generator has successfully generated the service for you.');
    }

    /**
     * Generate Views
     *
     * @throws FileNotFoundException
     */
    protected function generateViews()
    {
        if (! $this->option('api')) {
            $rootPath  = $this->config->get('generator.base_view_path').DIRECTORY_SEPARATOR;
            $className = $this->resolveModule();

            $view_structures = $this->config->get('generator.view_structures');
            $extension = '.blade.php';

            foreach ($view_structures as $key => $structure) :
                $folder = $rootPath.$className.DIRECTORY_SEPARATOR;
                $this->mkdir($folder.'partials');
                $this->makeFile($folder.$structure.$extension,
                    $this->resolveStub('views'.DIRECTORY_SEPARATOR.$key.'.blade', $this->resolveArgs($className)));
            endforeach;
            $this->info('Generator has successfully generated the views for you.');
        }
    }

    /**
     * @param $path
     * @param bool $absolute
     * @return string
     */
    protected function getAssetsPath($path, $absolute = true)
    {
        $rootPath = $this->config->get('generator.assets_path', 'assets/themes');
        if ($absolute)
            $rootPath = public_path($rootPath);

        if ($rootPath) {
            $this->mkdir($rootPath);
        }

        return $this->resolvePath($rootPath, $path);
    }

    /**
     * @param $file
     * @param null $template
     * @param bool $assets
     */
    protected function makeFile($file, $template = null, $assets = false)
    {
        if ( ! $this->files->exists($file))
        {
            $content = $assets ? $this->getAssetsPath($file, true) : $file;
            $this->files->put($content, $template);
        }
    }

    /**
     * @param $file
     * @param null $template
     */
    protected function makeAssetsFile($file, $template = null)
    {
        $this->makeFile($file, $template, true);
    }

    /**
     * Checking if Module is creatable
     */
    protected function checkingIfModuleIsCreatable()
    {
        if (!$this->files->isDirectory($this->getPath(null)))
        {
            $this->error(sprintf($this->resolveGeneratorExceptionMessage(), $this->resolveModule()));
            die;
        }
    }

    /**
     * Get root writable path.
     *
     * @param  string $path
     * @return string
     */
    protected function getPath($path)
    {
        $rootPath = $this->config->get('generator.root_path', app_path('Foundation'));
        if ($rootPath) {
            $this->mkdir($rootPath);
        }
        return $this->resolvePath($rootPath, $path);
    }

    /**
     * Make Directory
     *
     * @param $path
     */
    protected function mkdir($path)
    {
        if ( ! $this->files->isDirectory($path))
        {
            $this->files->makeDirectory($path, 0777, true);
        }
    }

    /**
     * @param $template
     * @param array $replacements
     * @return mixed|string
     * @throws FileNotFoundException
     */
    protected function resolveStub($template, $replacements = [])
    {
        $path = realpath(__DIR__ . DIRECTORY_SEPARATOR .'stubs'.DIRECTORY_SEPARATOR . $template . '.stub');
        $content = $this->files->get($path);
        if (!empty($replacements)) {
            $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        }
        return $content;
    }

    /**
     * Resolve the path
     *
     * @param string $rootPath
     * @param $path
     * @return string
     */
    protected function resolvePath(string $rootPath, $path)
    {
        return $rootPath.DIRECTORY_SEPARATOR.$path;
    }

    /**
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of the Module to be generated.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['views', 'view', InputOption::VALUE_NONE, 'Generate the views for the given name'],

            ['services', 's', InputOption::VALUE_NONE, 'Generate the services for the given name'],

            ['request', 'r', InputOption::VALUE_NONE, 'Generate the requests for the given name'],

            ['controller', 'C', InputOption::VALUE_NONE, 'Generate the controller for the given name'],

            ['api', 'api', InputOption::VALUE_NONE, 'Generate the api resource controller for the given name'],
        ];
    }

    /**
     * Break - and use camel case
     *
     * @return string
     */
    protected function resolveClassName()
    {
        $name = str_replace('-', ' ', $this->argument('name'));
        return preg_replace('/\s+/', '', ucwords($name));
    }

    /**
     * Resolve Module
     *
     * @return string
     */
    protected function resolveModule()
    {
        return strtolower($this->argument('name'));
    }

    /**
     * @param $className
     * @return array
     */
    protected function resolveArgs($className)
    {
        return [
            '{CLASS_NAME}'      => $className,
            '{VAR_CLASS_NAME}'  => '$'.lcfirst($className),
            '{CONTROLLER_NAMESPACE}' => '\\'.$this->config->get('generator.controller_namespace'),
            '{SMALL_CASE_CLASS_NAME}' => lcfirst($className),
            '{LOWER_CLASS_NAME}' => strtolower($className),
            '{VAR_LOWER_CLASS_NAME}' => '$'.strtolower($className),
            '{API_CONTROLLER_NAMESPACE}' => '\\'.$this->config->get('generator.api_controller_namespace'),
//            '{FILLABLE_ATTR}' => \Kiranti\Supports\Generator\Handlers\ColumnHandler::handle(Str::plural(strtolower($className))),
            '{FILLABLE_ATTR}' => ColumnHandler::handle(),
            '{DYNAMIC_FORM}' => FormHandler::handle(),
            '{TABLE_HEADS}' => TableHeadHandler::handle(),
            '{SHOW_ROWS}' => ShowBladeHandler::handle(strtolower($className)),
        ];
    }

    /**
     *
     * @return string
     */
    protected function resolveGeneratorExceptionMessage()
    {
        return '%s . Generator is enabled .';
    }

}
