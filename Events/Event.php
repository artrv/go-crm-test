<?php

namespace Events;

use Psr\EventDispatcher\StoppableEventInterface;

class Event implements StoppableEventInterface
{
    private $propagationStopped = false;

    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }
    
    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }
}
