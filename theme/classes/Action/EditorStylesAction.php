<?php

namespace Sillynet\Action;

use Sillynet\Adretto\Action\ActionHookAction;
use Sillynet\Adretto\Action\WordpressHookAction;

class EditorStylesAction extends WordpressHookAction implements ActionHookAction
{
    public static function getWpHookName(): string
    {
        return 'after_setup_theme';
    }

    public function __invoke(): void
    {
        add_editor_style('style-editor.css');
    }

    public function getHandler(): callable
    {
        return $this;
    }
}
