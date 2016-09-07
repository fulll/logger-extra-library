<?php

namespace Xeonys\LoggerExtra\Domain;

class AppLoggerProcessor
{
    private $uniqid;

    public function processRecord(array $record)
    {
        if (!$this->uniqid) {
            $this->uniqid = uniqid();
        }

        $record['extra']['process_id']   = $this->uniqid;

        return $record;
    }
}
