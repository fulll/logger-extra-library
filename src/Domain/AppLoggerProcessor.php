<?php

namespace Xeonys\LoggerExtra\Domain;

class AppLoggerProcessor
{
    private $uniqid;

    public function __construct($appName, $appEnv, $serverStack)
    {
        $this->appName     = $appName;
        $this->appEnv      = $appEnv;
        $this->serverStack = $serverStack;
    }

    public function processRecord(array $record)
    {
        if (!$this->uniqid) {
            $this->uniqid = uniqid();
        }

        $record['extra']['process_id']   = $this->uniqid;
        $record['extra']['app_name']     = $this->appName;
        $record['extra']['app_env']      = $this->appEnv;
        $record['extra']['server_stack'] = $this->serverStack;

        return $record;
    }
}
