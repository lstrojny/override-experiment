<?php

namespace nfq\ore\PhpStan;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @template-implements Rule<ClassMethod>
 */
final class OverrideAttributeRule implements Rule
{
    public function getNodeType(): string
    {
        return ClassMethod::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (!$scope->isInClass()) {
            return [];
        }

        $class = $scope->getClassReflection();
        $parent = $class->getParentClass();

        $hasParent = $parent !== null;
        $hasParentMethod = $hasParent && $parent->hasMethod($node->name->toString());

        if (!$hasParent && !$hasParentMethod) {
            return [];
        }

        $overrideAttributePresent = self::isOverrideAttributePresent($node);

        if ($hasParentMethod && !$overrideAttributePresent) {
            return [
                RuleErrorBuilder::message(sprintf('Missing #[Override] attribute for overriding method %s in class %s.', $node->name, $class->getName()))->line($node->getLine())->build()
            ];
        }

        if (!$hasParentMethod && $overrideAttributePresent) {
            return [
                RuleErrorBuilder::message(sprintf('Superfluous #[Override] attribute defined for non-overriding method %s in class %s.', $node->name, $class->getName()))->line($node->getLine())->build()
            ];
        }

        return [];
    }

    private static function isOverrideAttributePresent(ClassMethod $node): bool
    {
        foreach ($node->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($attr->name->toString() === 'Override') {
                    return true;
                }
            }
        }

        return false;
    }
}