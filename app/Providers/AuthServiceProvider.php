<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // User Defined Gates
        Gate::define('update-question', function(User $user, Question $question) {
            return $user->id === $question->user_id;
        });

        Gate::define('delete-question', function(User $user, Question $question) {
            return $user->id === $question->user_id;
        });
    }
}
