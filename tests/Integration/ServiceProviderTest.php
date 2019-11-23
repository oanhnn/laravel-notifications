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
     * php artisan vendor:publish --tag=laravel-notifications-config
     */
    public function testItShouldPublishVendorConfig()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/config/notifications.php';
        $targetFile = base_path('config/notifications.php');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--tag' => 'laravel-notifications-config',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals($this->files->get($sourceFile), $this->files->get($targetFile));
    }

    /**
     * Test migration file is existed in database/migrations directory after run
     *
     * php artisan vendor:publish --tag=laravel-notifications-migrations
     */
    public function testItShouldPublishVendorMigrations()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/database/migrations/create_notification_settings_table.php';
        $targetFile = database_path('migrations/2019_11_23_000000_create_notification_settings_table.php');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            // '--provider' => 'Laravel\\Notifications\\ServiceProvider',
            '--tag' => 'laravel-notifications-migrations',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals($this->files->get($sourceFile), $this->files->get($targetFile));
    }

    /**
     * Test vendor publishing on run
     *
     * php artisan vendor:publish --provider=Laravel\\Notifications\\ServiceProvider
     */
    public function testItShouldPublishVendors()
    {
        $configFile = base_path('config/notifications.php');
        $migrationsFile = database_path('migrations/2019_11_23_000000_create_notification_settings_table.php');

        $this->assertFileNotExists($configFile);
        $this->assertFileNotExists($migrationsFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Notifications\\ServiceProvider',
        ]);

        $this->assertFileExists($configFile);
        $this->assertFileExists($migrationsFile);
    }

    /**
     * Test default config values
     */
    public function testItShouldProvideDefaultConfig()
    {
        // TODO
        $this->assertTrue(true);
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
            database_path('migrations/2019_11_23_000000_create_notification_settings_table.php'),
        ]);

        $this->files->cleanDirectory($this->app->path());

        parent::tearDown();
    }
}
