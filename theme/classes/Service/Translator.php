<?php

namespace Sillynet\Service;

interface Translator
{
    public function exists(): bool;

    public function renderLanguageSwitcher(?int $postId): void;
}
