<?php

namespace Weiliu\Open\Kernel\Contracts;

interface MessageInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getEvent(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return null|string
     */
    public function getOs(): ?string;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return array
     */
    public function transformForJsonRequest(): array;
}