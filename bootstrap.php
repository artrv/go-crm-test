<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include './vendor/autoload.php';
include './Events/Event.php';
include './Events/EventDispatcher.php';
include './Events/ListenerProvider.php';
include './Events/NewLeadEvent.php';
include './Events/ErrorLeadEvent.php';
include './Listeners/NewLeadListener.php';
include './Listeners/ErrorLeadListener.php';
include './vendor/autoload.php';
include './vendor/autoload.php';
include './LeadInterface.php';
include './Lead.php';
include './GoCRMLeadService.php';
include './Mailer.php';
include './Logger.php';
include './App.php';