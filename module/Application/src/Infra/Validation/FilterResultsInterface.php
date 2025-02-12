<?php

namespace Application\Infra\Validation;

interface FilterResultsInterface {

    public function isValid(): bool;

    public function getMessage(): ?string;
}
