<?php
interface SocialNetworkConnector
{
    public function login(): void;
    public function logout(): void;
    public function send(string $message): void;
}

abstract class ASocialNetworkConnector {
    protected string $login;
    protected string $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
}

abstract class SocialNetworkPoster {
    protected string $login;
    protected string $password;

    protected SocialNetworkConnector $connector;
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
    public function getSocialNetworkConnector(): SocialNetworkConnector {
        return $this->connector;
    }


    final public function send(string $content): void {
        $connector = $this->getSocialNetworkConnector();
        $connector->login();
        $connector->send($content);
        $connector->logout();
    }
}
/*-----------------------------------*/
class VKConnector extends ASocialNetworkConnector implements SocialNetworkConnector {
    public function login(): void
    {
        echo "Send HTTP API request to log in user $this->login with " .
            "password $this->password\n";
    }

    public function logout(): void {
        echo "Send HTTP API request to log out user $this->login\n";
    }

    public function send(string $message): void {
        echo "Send HTTP API requests to create a post in VK timeline.\n";
    }
}

class VKPoster extends SocialNetworkPoster {
    public function __construct(string $login, string $password)
    {
        parent::__construct($login, $password);
        $this->connector = new VKConnector($login, $password);
    }
}
/*-------------------------------TG-----------------------*/
class TelegramConnector extends ASocialNetworkConnector implements SocialNetworkConnector {
    public function login(): void
    {
        echo "Send HTTP API request to log in phone $this->login with " .
            "password $this->password\n";
    }
    public function logout(): void {
        echo "Send HTTP API request to log out phone $this->login\n";
    }
    public function send(string $message): void {
        echo "Send HTTP API requests to create a post in Telegram timeline.\n";
    }
}
class TelegramPoster extends SocialNetworkPoster {
    public function __construct(string $login, string $password)
    {
        parent::__construct($login, $password);
        $this->connector = new TelegramConnector($login, $password);
    }
}
/*-------------------------------TG-----------------------*/


/*-------------------------------WhatsApp-----------------------*/
class WhatsAppConnector extends ASocialNetworkConnector implements SocialNetworkConnector {
    public function login(): void
    {
        echo "Send HTTP API request to log in phone $this->login with " .
            "password $this->password\n";
    }
    public function logout(): void {
        echo "Send HTTP API request to log out phone $this->login\n";
    }
    public function send(string $message): void {
        echo "Send HTTP API requests to create a post in WhatsApp timeline.\n";
    }
}
class WhatsAppPoster extends SocialNetworkPoster {
    public function __construct(string $login, string $password)
    {
        parent::__construct($login, $password);
        $this->connector = new WhatsAppConnector($login, $password);
    }
}
/*-------------------------------WhatsApp-----------------------*/


/*-------------------------------OK-----------------------*/
class OKConnector extends ASocialNetworkConnector implements SocialNetworkConnector {
    public function login(): void
    {
        echo "Send HTTP API request to log in phone $this->login with " .
            "password $this->password\n";
    }
    public function logout(): void {
        echo "Send HTTP API request to log out phone $this->login\n";
    }
    public function send(string $message): void {
        echo "Send HTTP API requests to create a post in OK timeline.\n";
    }
}
class OKPoster extends SocialNetworkPoster {
    public function __construct(string $login, string $password)
    {
        parent::__construct($login, $password);
        $this->connector = new OKConnector($login, $password);
    }
}
/*-------------------------------OK-----------------------*/




echo '----------------------' . PHP_EOL;
echo 'Test VK Poster' . PHP_EOL;
$vk_poster = new VKPoster('admin', '12345');
$vk_poster->send('Test message');
echo 'End VK test' . PHP_EOL;
echo '----------------------' . PHP_EOL;
echo 'Test Telegram Poster' . PHP_EOL;
$tg_poster = new TelegramPoster('+79124203102', '12345');
$tg_poster->send('Test message');
echo 'End Telegram test' . PHP_EOL;
echo '----------------------' . PHP_EOL;
echo 'Test WhatsApp Poster' . PHP_EOL;
$tg_poster = new WhatsAppPoster('+79175542960', 'QWERTY');
$tg_poster->send('Test message');
echo 'End WhatsApp test' . PHP_EOL;
echo '----------------------' . PHP_EOL;
echo 'Test OK Poster' . PHP_EOL;
$tg_poster = new OKPoster('+7951223566', 'QWERTY12345');
$tg_poster->send('Test message');
echo 'End OK test' . PHP_EOL;
echo '----------------------' . PHP_EOL;