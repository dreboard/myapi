<?php

namespace App\Components;

/**
 * Class GitTags
 * @package     App\Components
 * @since       v0.1.0
 *
 */
abstract class GitTags
{

    const MAJOR = 1;
    const MINOR = 2;
    const PATCH = 3;

    public static function get()
    {
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        return sprintf('v%s.%s.%s-dev.%s (%s)', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:m:s'));
    }

    /**
     * Get the current tag from git
     */
    public static function getCurrentTag()
    {
        $versions = glob('../.git/refs/tags/*');
        natsort($versions);
        $latest = array_pop($versions);
        $latest = basename($latest);
        $components = explode('.', $latest);
        $version = [
            'whole' => $latest,
            'major' => (int)$components[0],
            'minor' => $components[1],
            'release' => $components[2]
        ];

        return $version;
    }

}
