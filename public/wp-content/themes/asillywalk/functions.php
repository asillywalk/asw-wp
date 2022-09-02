<?php

use Gebruederheitz\GutenbergBlocks\BlockRegistrar;
use Sillynet\Adretto\Theme;

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

Theme::make(get_theme_file_path(".config.yaml"));
BlockRegistrar::getInstance()
    ->setScriptPath("/js/editor.js")
    ->setScriptHandle("sillynet.editor")
    ->setAllowedBlocks("/asillywalk/.config.yaml");
