<?php

namespace Tests\Integration;

use Illuminate\Filesystem\Filesystem;
use Laravel\Notifications\Handler;
use Tests\TestCase;

/**
 * Class ServiceProviderTest
 *
 * @package     Tests\Integration
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class ServiceProviderTest extends TestCase
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Test file notifications.php is existed in config directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Notifications\\ServiceProvider" --tag=laravel-notifications-config
     */
    public function testItShouldPublishVendorConfig()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/config/notifications.php';
        $targetFile = base_path('config/notifications.php');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Notifications\\ServiceProvider',
            '--tag' => 'laravel-notifications-config',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals($this->files->get($sourceFile), $this->files->get($targetFile));
    }

    /**
     * Test file handler.stubs is existed in resources/stubs directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Notifications\\ServiceProvider" --tag=laravel-notifications-stubs
     */
    public function testItShouldPublishVendorStubs()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/stubs/handler.stub';
        $targetFile = resource_path('stubs/handler.stub');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Notifications\\ServiceProvider',
            '--tag' => 'laravel-notifications-stubs',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals($this->files->get($sourceFile), $this->files->get($targetFile));
    }

    /**
     * Test default config values
     */
    public function testItShouldProvideDefaultConfig()
    {
        $this->assertEquals(config('notifications.base'), Handler::class);
        $this->assertEquals(config('notifications.namespace'), '\\App\\Http\\Notifications');
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->files = new Filesystem();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        $this->files->delete([
            base_path('config/notifications.php'),
            resource_path('stubs/handler.stub'),
        ]);

        $this->files->cleanDirectory($this->app->path());

        parent::tearDown();
    }
}
