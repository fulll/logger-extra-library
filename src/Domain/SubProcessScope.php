<?php

namespace Xeonys\LoggerExtra\Domain;

use Monolog\Logger;
use Monolog\Handler\FingersCrossedHandler;

/**
 * SubProcessScope
 *
 * @author Stephane PY <s.py@xeonys.com>
 */
class SubProcessScope
{
    /** @var Logger */
    private $logger;

    /** @var AppLoggerProcessor */
    private $processor;

    /**
     * @param Logger             $logger    logger
     * @param AppLoggerProcessor $processor processor
     */
    public function __construct(Logger $logger, AppLoggerProcessor $processor)
    {
        $this->logger    = $logger;
        $this->processor = $processor;
    }

    /**
     * You enter in a sub process scope.
     * By this way, we reinit the finger crossed handlers:
     *  - we clear the buffering state.
     *  - we rebuild a uniq process_id
     *
     */
    public function enter()
    {
        foreach ($this->logger->getHandlers() as $handler) {
            if ($handler instanceof FingersCrossedHandler) {
                $handler->clear();
            }
        }

        $this->processor->resetProcessId();
    }
}
