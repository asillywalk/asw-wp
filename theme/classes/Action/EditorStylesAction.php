<?php

namespace Sillynet\Action;

use Sillynet\Adretto\Action\ActionHookAction;
use Sillynet\Adretto\Action\WordpressHookAction;

class EditorStylesAction extends WordpressHookAction implements ActionHookAction
{
    public const WP_HOOK = 'after_setup_theme';

    public function __invoke()
    {
        add_editor_style('style-editor.css');
    }

    public function getHandler(): callable
    {
        return $this;
    }

    public function getData(): array
    {
        return [];
    }
}
