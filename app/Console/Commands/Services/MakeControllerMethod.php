<?php

declare(strict_types=1);

namespace App\Console\Commands\Services;

use Illuminate\Support\Str;
use Nette\PhpGenerator\Method;

final class MakeControllerMethod
{
    public function make(
        string $className
    ): Method {
        $methodName = Str::camel($className);
        $middlemanClass = sprintf('%sMiddleman', $className);
        $middlemanParameter = Str::camel($middlemanClass);

        $method = new Method($methodName);
        $method->setPublic();

        $method
            ->addParameter('request')
            ->setType('Request')
        ;
        $method
            ->addParameter($middlemanParameter)
            ->setType($middlemanClass)
        ;

        $method->addBody(
            sprintf('try {
    //$%s->mediate();
} catch (Exception $e) {
}', $middlemanParameter)
        );

        return $method;
    }
}
