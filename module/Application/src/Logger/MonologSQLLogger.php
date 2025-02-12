<?php

namespace Application\Logger;

use Doctrine\DBAL\Logging\DebugStack;
use Monolog\Logger;

class MonologSQLLogger extends DebugStack {

    private $logger;

    /**
     * @var float
     */
    protected $startTime;

    public function __construct(Logger $logger) {
        $this->logger = $logger;

    }

    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null) {
        $this->logger->debug($sql);

        if ($params) {
            $this->logger->debug(json_encode($params));
        }

        if ($types) {
            $this->logger->debug(json_encode($types));
        }

        $this->startTime = microtime(true);
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery() {
        $ms = round(((microtime(true) - $this->startTime) * 1000));
        $this->logger->debug("Query took {$ms}ms.");
    }
}
