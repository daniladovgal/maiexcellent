<?php

namespace App\Common\V1\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();

        $isLocal = $this->app->environment('local');
        $isDevelopment = $this->app->environment('development');
        $isStage = $this->app->environment('stage');


        Telescope::filter(function (IncomingEntry $entry) use ($isLocal, $isDevelopment, $isStage) {
            if ($entry->type === EntryType::EXCEPTION) {
                $entry->tags([
                    $entry->content['class'],
                ]);
            }

            if ($entry->type === EntryType::MAIL) {
                $entry->tags([
                    $entry->content['mailable'],
                ]);
            }

            if ($entry->type === EntryType::REQUEST) {
                $tags = [
                    $entry->content['uri'],
                    $entry->content['method'],
                    $entry->content['response_status'],
                ];

                if ($entry->content['method'] !== 'OPTIONS') {
                    $tags[] = $entry->content['controller_action'];
                }

                $entry->tags($tags);
            }

            return $isLocal || $isDevelopment || $isStage ||
                $entry->isReportableException() ||
                $entry->isFailedRequest() ||
                $entry->isFailedJob() ||
                $entry->isScheduledTask() ||
                $entry->hasMonitoredTag() ||
                $entry->type === EntryType::CLIENT_REQUEST;
        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     */
    protected function hideSensitiveRequestDetails(): void
    {
        if (
            $this->app->environment('local')
            || $this->app->environment('development')
            || $this->app->environment('stage')
        ) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function ($user) {
            return in_array($user->email, [
                'admin@admin.com'
            ]);
        });
    }
}
