<?php

namespace Events;

use Events\ErrorLeadEvent;
use Logger;

class ErrorLeadListener
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ErrorLeadEvent $event): void
    {
        $th = $event->getObject();
        $this->logger->warning($th->getMessage(), $th->getTrace());
    }
}
