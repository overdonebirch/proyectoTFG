<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ReflectionClass;

class ListControllerMethods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'controller:methods {controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all methods of a given controller';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $controller = $this->argument('controller');

        // Add namespace to the controller
        $controller = 'App\\Http\\Controllers\\' . $controller;

        if (!class_exists($controller)) {
            $this->error("Controller {$controller} does not exist.");
            return;
        }

        $reflection = new ReflectionClass($controller);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            if ($method->class === $controller) {
                $this->info($method->name);
            }
        }
    }
}
