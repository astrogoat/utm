<?php

namespace Astrogoat\Utm\Actions;

use Helix\Lego\Apps\Actions\Action;

class UtmAction extends Action
{
    public static function actionName(): string
    {
        return 'Utm action name';
    }

    public static function run(): mixed
    {
        return redirect()->back();
    }
}
