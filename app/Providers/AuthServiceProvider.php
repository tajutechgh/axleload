<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services. 
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies(); 

        Gate::define('user.accessControl','App\Policies\UserPolicy@accessControl');

        Gate::define('user.accessPermissions','App\Policies\UserPolicy@accessPermissions');

        Gate::define('user.accessRoles','App\Policies\UserPolicy@accessRoles');

        Gate::define('user.accessUsers','App\Policies\UserPolicy@accessUsers');

        Gate::define('user.transactions','App\Policies\UserPolicy@transactions');

        Gate::define('user.transactionEnquiry','App\Policies\UserPolicy@transactionEnquiry');

        Gate::define('user.weighingEnquiry','App\Policies\UserPolicy@weighingEnquiry');

        Gate::define('user.fineEnquiry','App\Policies\UserPolicy@fineEnquiry');

        Gate::define('user.transactionFines','App\Policies\UserPolicy@transactionFines');

        Gate::define('user.blacklistedVehicles','App\Policies\UserPolicy@blacklistedVehicles');

        Gate::define('user.reports','App\Policies\UserPolicy@reports');

        Gate::define('user.setups','App\Policies\UserPolicy@setups');

        Gate::define('user.stationsSetup','App\Policies\UserPolicy@stationsSetup');

        Gate::define('user.typeOfVehiclesSetup','App\Policies\UserPolicy@typeOfVehiclesSetup');

        Gate::define('user.commoditiesSetup','App\Policies\UserPolicy@commoditiesSetup');

        Gate::define('user.heightSetup','App\Policies\UserPolicy@heightSetup');

        Gate::define('user.regionsSetup','App\Policies\UserPolicy@regionsSetup');

        Gate::define('user.finesSetup','App\Policies\UserPolicy@finesSetup');

        Gate::define('user.generalSettingsSetup','App\Policies\UserPolicy@generalSettingsSetup');

        Gate::define('user.systemSetup','App\Policies\UserPolicy@systemSetup');

        Gate::define('user.partPaymentAction','App\Policies\UserPolicy@partPaymentAction');

        Gate::define('user.paidAlreadyAction','App\Policies\UserPolicy@paidAlreadyAction');

        Gate::define('user.pardonAction','App\Policies\UserPolicy@pardonAction');
    }
}
