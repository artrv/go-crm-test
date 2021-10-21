<?php

use Events\EventDispatcher;

class GoCRMLeadService implements \LeadServiceInterface
{    
    private string $host;
    private string $key;
    private EventDispatcher $storage;

    /**
     * @param string $host
     * @param string $key
     */
    public function __construct(string $host, string $key, EventDispatcher $dispatcher)
    {
        $this->host = $host;
        $this->key = $key;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @inherit doc
     */
    public function setLead(Lead $lead): int
    {
        try {
            if(empty($lead->name)) {
                throw new Exception('New lead error. Field name is empty');
            }
            
            // ... this is where the magic of sending an application to the CRM happens
            
            $this->dispatcher->dispatch(new \Events\NewLeadEvent($lead));
            
        } catch (\Throwable $th) {
            $this->dispatcher->dispatch(new \Events\ErrorLeadEvent($th));
        }

        return 1;
    }
}