<?php
if (PHP_VERSION_ID < 80300) {
    #[Attribute(Attribute::TARGET_METHOD)]
    class Override {}
}

