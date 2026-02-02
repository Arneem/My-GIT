<?php


interface WebAppConfigBuilderInterface {
    public function setEnvironment(string $environment);
    public function setDatabaseConfig(array $config);
    public function setCacheEnabled(bool $enabled);
    public function build(): WebAppConfig;
}


class WebAppConfig {
    private string $environment;
    private array $databaseConfig;
    private bool $cacheEnabled;

    public function __construct(string $environment, array $databaseConfig, bool $cacheEnabled) {
        $this->environment = $environment;
        $this->databaseConfig = $databaseConfig;
        $this->cacheEnabled = $cacheEnabled;
    }

    public function configInfo(): array {
        return
            [
                'Environment' => $this->environment,
                'Database' => $this->databaseConfig,
                'enabledCache' => $this->cacheEnabled ? 'true' : 'false'
            ];
    }
}


class WebAppConfigBuilder implements WebAppConfigBuilderInterface {
    private string $environment;
    private array $databaseConfig;
    private bool $cacheEnabled;



    public function setEnvironment(string $environment)  {
        $this->environment = $environment;
        return $this;
    }

    public function setDatabaseConfig(array $config)  {
        $this->databaseConfig = $config;
        return $this;
    }

    public function setCacheEnabled(bool $enabled)  {
        $this->cacheEnabled = $enabled;
        return $this;
    }

    public function build(): WebAppConfig {
        return new WebAppConfig($this->environment, $this->databaseConfig, $this->cacheEnabled);
    }
}


$configBuilder = new WebAppConfigBuilder();
$webAppConfig = $configBuilder
    ->setEnvironment('production')
    ->setDatabaseConfig(['host' => 'localhost', 'username' => 'root', 'password' => '123456'])
    ->setCacheEnabled(true)
    ->build();

print_r($webAppConfig->configInfo());
