<?php

namespace Ang3\Bundle\AwsLambdaBundle\Service;

interface FunctionResponseInterface
{
    public function getCode(): int;

    public function getData(): array;

    public function getContext(): array;
}
