<?php

namespace Ang3\Bundle\AwsLambdaBundle\Response;

interface FunctionResponseInterface
{
    public function getCode(): int;

    public function getData(): array;

    public function getContext(): array;
}
