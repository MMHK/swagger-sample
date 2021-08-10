<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Swagger\Annotations\Operation;

class SwaggerDocCmd extends Command
{
    const PATH_DOC = 'docs';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:swagger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build Swagger Doc JSON file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $docPath = base_path(self::PATH_DOC);

        $swagger = \Swagger\scan(base_path('app/Http/Controllers/Api'));

        $swagger->basePath = '/api/';
        $swagger->host = trim(str_replace(['http://', 'https://'], '', url('')), '/');

        foreach ($swagger->paths as $path) {
            foreach ($path as $method) {
                if ($method instanceof Operation) {
                    $method->description = sprintf("```\r\n%s\r\n```\n", $method->_context->comment);
                }
            }
        }

        file_put_contents($docPath.'/swagger.json', json_encode($swagger));
    }
}
