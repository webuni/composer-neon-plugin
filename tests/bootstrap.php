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

namespace Webuni\ComposerNeonPlugin\Tests;

require __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

if (class_exists(TestCase::class)) {
    class CompatibleTestsCase extends TestCase
    {
    }
} else {
    class CompatibleTestsCase extends \PHPUnit_Framework_TestCase
    {
    }
}
