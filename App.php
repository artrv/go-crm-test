<?php

use Events\ErrorLeadListener;
use Events\NewLeadEvent;
use Events\ErrorLeadEvent;
use Events\ListenerProvider;
use Events\NewLeadListener;

class App
{
    public function start($name, $phone)
    {
        $listenerProvider = new ListenerProvider();
        $listenerProvider->addListener(
            NewLeadEvent::class, 
            new NewLeadListener(
                new Mailer('director@gocrm.ru, manager@gocrm.ru'),
                new Logger()
            )
        );
        $listenerProvider->addListener(
            ErrorLeadEvent::class, 
            new ErrorLeadListener(
                new Logger()
            )
        );
        $dispatcher = new \Events\EventDispatcher($listenerProvider);

        $lead = new \Lead($name, $phone);

        $goCRMLeadService = new \GoCRMLeadService(
            'https://alpha.go-crm.ru', 
            '1234567890', 
            $dispatcher
        );

        $goCRMLeadService->setLead($lead);

        // ... какой-то другой код
    }
}
