<?php

declare(strict_types=1);

namespace App\Console\Commands\Services;

use Illuminate\Support\Str;
use Nette\PhpGenerator\GlobalFunction;

final class MakeControllerMethod
{
    public function make(
        string $className
    ): GlobalFunction {
        $methodName = Str::camel($className);
        $middlemanClass = sprintf('%sMiddleman', $className);
        $middlemanParameter = Str::camel($middlemanClass);

        $function = new GlobalFunction($methodName);
        $function
            ->addParameter('request')
            ->setType('Request')
        ;
        $function
            ->addParameter($middlemanParameter)
            ->setType($middlemanClass)
        ;

        $function->addBody(
            sprintf('try {
    //$%s->mediate();
} catch (Exception $e) {
}', $middlemanParameter)
        );

        return $function;
    }
}
