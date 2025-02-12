<?php

namespace Application\Logger;

use Monolog\Processor\ProcessorInterface;

class UserAndPostDataProcessor implements ProcessorInterface {

    /**
     * @var array|\ArrayAccess
     */
    protected $postData;

    /**
     * @var array|\ArrayAccess
     */
    protected $rawPost;
    private $serverData;


    public function __construct() {
        $this->serverData = &$_SERVER;
        $this->postData = &$_POST;
        $contents = file_get_contents('php://input');
        if ($contents !== false) {
            $this->rawPost = json_decode($contents, true);
        }

    }

    /**
     * @param array $record
     * @return array
     */
    public function __invoke(array $record) {
        if (!isset($this->serverData['REQUEST_URI'])) {
            return $record;
        }

        $record['extra']["postParams"] = $this->postData ?? null;
        $record['extra']["rawPostParams"] = $this->rawPost ?? null;

        return $record;
    }

}
