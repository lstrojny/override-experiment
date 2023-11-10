<?php

namespace nfq\ore;

use Override;

final readonly class AClass extends AnAbstractClass
{
    public function anAbstractMethod(): void
    {
        echo __METHOD__;
    }

    public function aTemplateMethod(): void
    {
        parent::aTemplateMethod();
        echo __METHOD__;
    }

    public function aSpecificMethod(): void
    {}

    #[Override]
    public function aSpecificMethodIncorrectlyAnnotated(): void
    {}
}