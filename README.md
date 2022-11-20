AWS Lambda bundle
=================

[![Build Status](https://api.travis-ci.com/Ang3/aws-lambda-bundle.svg?branch=main)](https://app.travis-ci.com/github/Ang3/aws-lambda-bundle)
[![Latest Stable Version](https://poser.pugx.org/ang3/aws-lambda-bundle/v/stable)](https://packagist.org/packages/ang3/aws-lambda-bundle)
[![Latest Unstable Version](https://poser.pugx.org/ang3/aws-lambda-bundle/v/unstable)](https://packagist.org/packages/ang3/aws-lambda-bundle)
[![Total Downloads](https://poser.pugx.org/ang3/aws-lambda-bundle/downloads)](https://packagist.org/packages/ang3/aws-lambda-bundle)

This bundle integrates AWS Lambda to your project.

**Features**

- Client
- Function caller and report

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your app directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require ang3/aws-lambda-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Configure the bundle
----------------------------

In file `.env`, add the contents below and adapt it to your needs:

```dotenv
###> ang3/aws-lambda-bundle ###
AWS_LAMBDA_KEY="YOUR_KEY"
AWS_LAMBDA_SECRET="YOUR_SECRET"
AWS_LAMBDA_REGION="YOUR_REGION"
AWS_LAMBDA_VERSION="latest"
###< ang3/aws-lambda-bundle ###
```

Make sure to replace `YOUR_KEY`, `YOUR_SECRET`, `YOUR_REGION` by your AWS settings.

Usage
=====

Client
------

**Public service ID:** `ang3.aws_lambda.client`

To use the ```Lambda``` client, get it by dependency injection:

```php
namespace App\Service;

use Aws\Lambda\LambdaClient;

class MyService
{
    public function __construct(private LambdaClient $s3Client)
    {
    }
}
```

Function caller
---------------

To call a lambda function, use dependency injection:

```php
namespace App\Service;

use Ang3\Bundle\AwsLambdaBundle\Service\Lambda\FunctionCaller;

class MyService
{
    public function __construct(private FunctionCaller $functionCaller)
    {
    }
}
```

Then, make your call:

```php
/** @var \Ang3\Bundle\AwsLambdaBundle\Service\Lambda\FunctionCaller $functionCaller */

$response = $functionCaller->call($name, $arguments = [], $context = []);
```

The response is an instance of ```Ang3\Bundle\AwsLambdaBundle\Lambda\FunctionResponse```.

The context is sent and returned with the response.

That's it!