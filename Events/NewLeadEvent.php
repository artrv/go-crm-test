<?php

namespace Events;

use Events\Event;
use Lead;

class NewLeadEvent extends Event
{
    private $lead;

    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    public function getObject(): Lead
    {
        return $this->lead;
    }
}