<?php

namespace Vivoka\BumpVersion\Commands;

use Illuminate\Console\Command;
use Vivoka\BumpVersion\Helpers\Bumper;
use Vivoka\BumpVersion\Helpers\FileHelper;

class UndoBumpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bump:undo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore last changes in the compose.json';


    public function __construct()
    {
        parent::__construct();
        $this->bumper = new Bumper();
        $this->fileHelper = new FileHelper();
    }
        /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->error(str_repeat('!!! WARNING !!!', 3));
        $this->error('    This will replace content of: composer.json file with content from file: composer.json-backup   !!!');
        if ($this->confirm('Are you suere? [y|N]')) {
            $this->fileHelper->restoreBackupFile();
            $this->info('Restored file: composer.json-backup into file: composer.json');
        } else {
            $this->info('Action was canceled.');
        }
    }
}
