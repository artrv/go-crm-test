<?php

namespace Events;

use Events\NewLeadEvent;
use Logger;
use Mailer;

class NewLeadListener
{
    private logger $logger;
    private mailer $mailer;

    public function __construct(Mailer $mailer, Logger $logger)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    public function __invoke(NewLeadEvent $event): void
    {
        $lead = $event->getObject();
        $message = 'New lead. Name: ' . $lead->name . '. Phone: ' . $lead->phone;

        $this->mailer->send('New lead', $message);
        $this->logger->alert($message);
    }
}