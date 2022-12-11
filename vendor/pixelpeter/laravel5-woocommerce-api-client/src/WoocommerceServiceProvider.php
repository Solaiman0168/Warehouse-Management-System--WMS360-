<?php namespace Pixelpeter\Woocommerce;

use Automattic\WooCommerce\Client;
use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Support\Facades\Schema;

class WoocommerceServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/woocommerce.php' => config_path('woocommerce.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        // merge default config
        $this->mergeConfigFrom(
            __DIR__ . '/../config/woocommerce.php',
            'woocommerce'
        );

        $config = $app['config']->get('woocommerce');
        if(Schema::hasTable('woocommerce_accounts')) {
            $accountInfo = DB::table('woocommerce_accounts')->first();

            $app->singleton('woocommerce.client', function() use ($config, $accountInfo) {
                return new Client(
                    $accountInfo->site_url ?? $config['store_url'],
                    $accountInfo->consumer_key ?? $config['consumer_key'],
                    $accountInfo->secret_key ?? $config['consumer_secret'],
                    [
                        'version' => 'wc/'.$config['api_version'],
                        'verify_ssl' => $config['verify_ssl'],
                        'wp_api' => $config['wp_api'],
                        'query_string_auth' => $config['query_string_auth'],
                        'timeout' => $config['timeout'],
                    ]);
            });
        }else {
            $app->singleton('woocommerce.client', function() use ($config) {
                return new Client(
                    $config['store_url'],
                    $config['consumer_key'],
                    $config['consumer_secret'],
                    [
                        'version' => 'wc/'.$config['api_version'],
                        'verify_ssl' => $config['verify_ssl'],
                        'wp_api' => $config['wp_api'],
                        'query_string_auth' => $config['query_string_auth'],
                        'timeout' => $config['timeout'],
                    ]);
            });
        }

        $app->singleton('Pixelpeter\Woocommerce\WoocommerceClient', function($app) {
            return new WoocommerceClient($app['woocommerce.client']);
        });

        $app->alias('Pixelpeter\Woocommerce\WoocommerceClient', 'woocommerce');
    }
}
