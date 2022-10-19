<?php

namespace App\Services;

class ApiService
{
    /**
     * Api Constructor.
     */
    public function __construct(
        protected int $errorStatus,
        protected string $errorMessage
    ) {
    }

    /**
     * Return Error Message.
     */
    public function getErrorStatus(): int
    {
        return $this->errorStatus;
    }

    /**
     * Return Error Message.
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * Set Error Message.
     */
    protected function setError(string $message, int $code): bool
    {
        $this->errorMessage = $message;
        $this->statusCode = $code;

        return false;
    }
}
