<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use DB;

class SemeadUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SemeadUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza dados semad';

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
        //usando multiplas conexoes
        $connection = 'semead';
        $db = DB::connection($connection);

        //$areas = $db->table('areas')->get();
        $artigos = $db->table('artigos')->where('ano',2015)->get();
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $progressBar = new ProgressBar($output, count($artigos));
        foreach ($artigos as $artigo) {
            if($artigo->area == null){
                $busca = $db->table('areas')
                ->where('tema','like', '%'.$artigo->tema.'%')->first();
                if(!empty($busca)){
                    $db->table('artigos')->where('ano',2015)->where('cod',$artigo->cod)->update(['area'=>$busca->nome]);
                }
            }
            $progressBar->advance();
        }
        $progressBar->finish();

    }
}
