<?php
declare(strict_types=1);

namespace Application\Settings;

use Assert\Assertion;

class AppSettings
{

    private array $config;
    private array $localConfig;

    public function __construct(array $config) {
        $appConfig = $config['app-settings'] ?? null;
        Assertion::notNull($appConfig, "App configuration not found!");
        $this->config = $appConfig;

        $localConfig = $config['local-settings'] ?? null;
        Assertion::notNull($localConfig, "Local configuration not found!");
        $this->localConfig = $localConfig;
    }

    private function getConfig(string $key) {
        $value = $this->config[$key] ?? null;
        Assertion::notNull($value, $key . " configuration not found.");
        return $value;
    }

    private function getLocalConfig(string $key) {
        $value = $this->localConfig[$key] ?? null;
        Assertion::notNull($value, $key . " local configuration not found.");
        return $value;
    }

    public function getVersion(): string {
        return (string) $this->getConfig("version");
    }

}
