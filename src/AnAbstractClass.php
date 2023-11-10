<?php
namespace nfq\ore;

abstract readonly class AnAbstractClass
{
    abstract public function anAbstractMethod(): void;

    public function aTemplateMethod(): void
    {
        echo __METHOD__;
    }
}