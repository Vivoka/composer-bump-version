<?php

namespace Vivoka\BumpVersion;

use Vivoka\BumpVersion\Helpers\FileHelper;

class ComposerBump
{

    public function __construct()
    {
        $this->fileHelper = new FileHelper();
    }

    public function version()
    {
        return $this->getVersion();
    }

    public function getVersion()
    {
        return $this->fileHelper->getVersion();
    }
}
