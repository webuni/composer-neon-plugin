<?php

/*
 * This is part of the webuni/composer-neon-plugin package.
 *
 * (c) Martin Hasoň <martin.hason@gmail.com>
 * (c) Webuni s.r.o. <info@webuni.cz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Webuni\ComposerNeonPlugin;

use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;

final class CommandProvider implements CommandProviderCapability
{
    public function getCommands()
    {
        return [
            new NeonConvertCommand(),
        ];
    }
}
