<?php

namespace Events;

use Events\Event;
use Throwable;

class ErrorLeadEvent extends Event
{
    private $th;

    public function __construct(Throwable $th)
    {
        $this->th = $th;
    }

    public function getObject(): Throwable
    {
        return $this->th;
    }
}
