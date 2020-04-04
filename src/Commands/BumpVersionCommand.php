<?php

namespace Vivoka\BumpVersion\Commands;

use Illuminate\Console\Command;
use Vivoka\BumpVersion\Helpers\Bumper;
use Vivoka\BumpVersion\Helpers\FileHelper;

class BumpVersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bump:version
                            {type? : Type of bump (major.minor.patch => verison x.x.x) or none if you want to display actual version}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bump or display version';

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
        $oldVersion = $this->fileHelper->getVersion();
        if (!$this->argument('type')) {
            $this->info($oldVersion);
            return;
        }

        switch ($this->argument('type')) {
            case 'major':
                $newVersion = $this->bumper->bumpMajor($oldVersion)->get();

                break;
            case 'minor':
                $newVersion = $this->bumper->bumpMinor($oldVersion)->get();

                break;
            case 'patch':
                $newVersion = $this->bumper->bumpPatch($oldVersion)->get();
                break;
        }
//        $this->fileHelper->setVersion($newVersion)->save();
        $this->info('Bump from: ' . $oldVersion . ' to ' . $newVersion);
    }
}
