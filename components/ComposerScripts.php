<?php

namespace App\Components;

/**
 * Class ComposerScripts
 *
 * Methods to be used in  the "scripts" block
 * in the composer.json file
 *
 * @package     App\Components
 * @since       v0.1.0
 *
 * @see https://getcomposer.org/doc/articles/scripts.md
 *
 */
abstract class ComposerScripts
{

    /**
     * Composer Post actions
     */
    public static function postComposer()
    {
        return "Post actions";
    }

    /**
     * Composer Pre actions
     */
    public static function preComposer()
    {
        return "Pre actions";
    }

}