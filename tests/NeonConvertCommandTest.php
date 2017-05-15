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

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Webuni\ComposerNeonPlugin\NeonConvertCommand;

final class NeonConvertCommandTest extends CompatibleTestsCase
{
    private $app;
    private $buffer;
    private $cwd;

    protected function setUp()
    {
        $this->app = new Application();
        $this->app->setAutoExit(false);
        $this->app->add(new NeonConvertCommand());
        $this->buffer = new BufferedOutput();

        $this->cwd = getcwd();
        chdir(sys_get_temp_dir());
        $this->removeFiles();
    }

    protected function tearDown()
    {
        chdir($this->cwd);
        $this->removeFiles();
    }

    public function testDefaultInputFileDoesNotExists()
    {
        $this->app->run(new ArrayInput(['neon-convert']), $this->buffer);
        $this->assertContains('The input file "composer.neon" does not exist.', $this->buffer->fetch());
    }

    public function testCustomInputFileDoesNotExists()
    {
        $this->app->run(new ArrayInput(['neon-convert', 'input' => 'composer.json']), $this->buffer);
        $this->assertContains('The input file "composer.json" does not exist.', $this->buffer->fetch());
    }

    public function testInvalidFormat()
    {
        $this->app->run(new ArrayInput(['neon-convert', 'input' => 'composer.yaml']), $this->buffer);
        $this->assertContains('Invalid input format "yaml", must be one of: neon, json.', $this->buffer->fetch());
    }

    public function testSameFormat()
    {
        file_put_contents('composer.neon', 'name: package');
        $this->app->run(new ArrayInput(['neon-convert', 'output' => 'composer.neon']), $this->buffer);
        $this->assertContains('Input format "neon" is same as output format.', $this->buffer->fetch());
    }

    public function testConvertNeonToJson()
    {
        file_put_contents('composer.neon', 'name: package');
        $this->app->run(new ArrayInput(['neon-convert']), $this->buffer);
        $this->assertContains('Converted "composer.neon" to "composer.json"', $this->buffer->fetch());
        $this->assertFileExists('composer.json');
        $this->assertEquals("{\n    \"name\": \"package\"\n}\n", file_get_contents('composer.json'));
    }

    public function testConvertJsonToNeon()
    {
        file_put_contents('composer.json', "{\n    \"name\": \"package\"\n}");
        $this->app->run(new ArrayInput(['neon-convert', 'input' => 'composer.json']), $this->buffer);
        $this->assertContains('Converted "composer.json" to "composer.neon"', $this->buffer->fetch());
        $this->assertFileExists('composer.neon');
        $this->assertEquals("name: package\n", file_get_contents('composer.neon'));
    }

    private function removeFiles()
    {
        foreach (['json', 'neon'] as $extension) {
            $file = sys_get_temp_dir().'/composer.'.$extension;
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
