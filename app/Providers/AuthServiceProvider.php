<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Tarea;
use App\Policies\TareaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Tarea::class => TareaPolicy::class,
        Archivo::class => ArchivoPolicy::class,
        \App\Models\Archivo::class => \App\Policies\ArchivoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        
    }
    
}