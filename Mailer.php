<?php

class Mailer
{
   private string $to;
    
   public function __construct(string $to)
   {
       $this->to = $to;
   }

   public function send(string $subject, string $message)
   {
      // отправка почты
   }
}