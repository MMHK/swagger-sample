<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SwaggerDocCmd extends Command
{
    const PATH_DOC = 'doc/swagger';
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
        $outPath = base_path(self::PATH_DOC);

        define('SWAGGER_API_URI', url('api'));

        $swagger = \OpenApi\scan(app_path('Http/Controllers/Api'));

        foreach ($swagger->paths as $path) {
            foreach ($path as $method) {
                if ($method instanceof \OpenApi\Annotations\Operation) {
                    $method->description = sprintf("```\r\n%s\n```", $method->_context->comment);
                }
            }
        }

        $json = $swagger->toJson();

        file_put_contents($outPath.'/swagger.json', $json);
    }
}
