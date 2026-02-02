<?php

abstract class Notification
{
    protected NotificationSender $sender;

    public function __construct(NotificationSender $sender)
    {
        $this->sender = $sender;
    }

    abstract public function send();
}

interface NotificationSender
{
    public function sendNotification();
}

class EmailNotificationSender implements NotificationSender
{
    public function sendNotification()
    {
        echo "Отправка уведомления по электронной почте\n";
    }
}

class SMSNotificationSender implements NotificationSender
{
    public function sendNotification()
    {
        echo "Отправка уведомления по SMS\n";
    }
}

class SimpleNotification extends Notification
{
    public function send()
    {
        echo "Простое уведомление: ";
        $this->sender->sendNotification();
    }
}

class ErrorNotification extends Notification
{
    public function send()
    {
        echo "Уведомление об ошибке: ";
        $this->sender->sendNotification();
    }
}

class UrgentNotification extends Notification
{
    public function send()
    {
        echo "Срочное уведомление: ";
        $this->sender->sendNotification();
    }
}

// Пример использования
$emailSender = new EmailNotificationSender();
$smsSender = new SMSNotificationSender();

$simpleEmailNotification = new SimpleNotification($emailSender);
$simpleEmailNotification->send();

$errorSMSNotification = new ErrorNotification($smsSender);
$errorSMSNotification->send();

