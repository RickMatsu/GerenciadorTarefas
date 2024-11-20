<?php

namespace App\Providers;

use App\Models\Task;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * O array de mapeamento das políticas de acesso.
     *
     * @var array
     */
    protected $policies = [
        Task::class => TaskPolicy::class,
    ];

    /**
     * Registre quaisquer serviços de autenticação ou outras funcionalidades de autorização.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();  // Chama o método registerPolicies aqui
    }
}
