<?php

use Illuminate\Support\Facades\Config;

if (!function_exists('setSmtpConfig')) {
    /**
     * Set SMTP configuration dynamically.
     *
     * @param array $config
     * @return void
     */
    function setSmtpConfig(array $config)
    {
        $defaultConfig = [
            'driver' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),
            'port' => env('MAIL_PORT', 2525),
            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                'name' => env('MAIL_FROM_NAME', 'Example'),
            ],
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
        ];

        $mergedConfig = array_merge($defaultConfig, $config);

        Config::set('mail', $mergedConfig);
    }
}
