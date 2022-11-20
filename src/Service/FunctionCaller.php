<?php

namespace Ang3\Bundle\AwsLambdaBundle\Service;

use Ang3\Bundle\AwsLambdaBundle\Exception\FunctionException;
use Ang3\Bundle\AwsLambdaBundle\Exception\LambdaExceptionInterface;
use Aws\Lambda\LambdaClient;
use Psr\Log\LoggerInterface;

class FunctionCaller
{
    public function __construct(private LambdaClient $lambdaClient,
                                private LoggerInterface $logger)
    {
    }

    /**
     * @throws LambdaExceptionInterface
     */
    public function call(string $functionName, array $arguments = [], array $context = []): FunctionResponse
    {
        $context['function_name'] = $functionName;
        $context['function_arguments'] = $arguments;
        $this->logger->info('Calling lambda function "{function_name}".', $context);

        $payload = [
            'body' => json_encode($arguments),
        ];

        try {
            $result = $this->lambdaClient->invoke([
                'FunctionName' => $functionName,
                'InvocationType' => 'RequestResponse',
                'Payload' => json_encode($payload),
            ]);
        } catch (\Throwable $e) {
            throw new FunctionException(sprintf('Request to the lambda function "%s" failed.', $functionName), 0, $e);
        }

        /** @var string $payload */
        $payload = $result->get('Payload');
        $data = (array) json_decode($payload, true);
        $statusCode = $data['statusCode'] ?? 500;
        $statusCode = is_scalar($statusCode) ? (int) $statusCode : 500;

        if (!empty($data['body'])) {
            $data = (array) json_decode($data['body'], true);
        }

        if (array_key_exists('context', $data)) {
            $context = array_merge($context, (array) $data['context']);
            unset($data['context']);
        }

        return new FunctionResponse($statusCode, $data, $context);
    }
}
