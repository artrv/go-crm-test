<?php

use Events\ErrorLeadEvent;
use Events\ErrorLeadListener;
use Events\ListenerProvider;
use Events\NewLeadEvent;
use Events\NewLeadListener;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

final class TusksTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     *  1. Записывать все поступившие заявки в Лог
     *  2. Отправлять уведомление о поступившей заявке по почте директору и менеджеру (director@gocrm.ru, manager@gocrm.ru)
     */
    public function testNewLeadIsLoggedAndSentToManagers()
    {
        $name = 'any_name';
        $phone = 'any_phone';
        $expectedMessage = 'New lead. Name: ' . $name . '. Phone: ' . $phone;

        $mailer = \Mockery::mock('\Mailer');
        $mailer->shouldReceive('send')
            ->once()
            ->with('New lead', $expectedMessage);

        $logger = \Mockery::mock('\Logger');
        $logger->shouldReceive('alert')
            ->once()
            ->with($expectedMessage);

        $listenerProvider = new ListenerProvider();
        $listenerProvider->addListener(
            NewLeadEvent::class, 
            new NewLeadListener($mailer, $logger)
        );
        $dispatcher = new \Events\EventDispatcher($listenerProvider);

        $lead = new \Lead($name, $phone);

        $goCRMLeadService = new \GoCRMLeadService(
            'https://alpha.go-crm.ru', 
            '1234567890', 
            $dispatcher
        );

        $this->assertEquals($goCRMLeadService->setLead($lead), 1);
    }

    /**
     * 3. Логировать ошибки, если такие вдруг появятся.
     */
    public function testErrorIsLogged()
    {
        $name = null;
        $phone = null;

        $logger = \Mockery::mock('\Logger');
        $logger->shouldReceive('warning')->once();

        $listenerProvider = new ListenerProvider();
        $listenerProvider->addListener(
            ErrorLeadEvent::class, 
            new ErrorLeadListener($logger)
        );
        $dispatcher = new \Events\EventDispatcher($listenerProvider);

        $lead = new \Lead($name, $phone);

        $goCRMLeadService = new \GoCRMLeadService(
            'https://alpha.go-crm.ru', 
            '1234567890', 
            $dispatcher
        );

        $this->assertEquals($goCRMLeadService->setLead($lead), 1);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }
}