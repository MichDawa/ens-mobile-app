<?php

namespace Application\Infra\Validation;

class ValidationResult implements FilterResultsInterface {

    private $isValid;
    private $message;

    public function __construct($isValid = false, $message = null) {
        $this->isValid = $isValid;
        $this->message = $message;
    }

    public function valid() {
        $this->isValid = true;
    }

    public function invalid() {
        $this->isValid = false;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function isValid(): bool {
        return $this->isValid;
    }

    public function getMessage(): ?string {
        return $this->message;
    }
}
