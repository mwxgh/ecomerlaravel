<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Policies\CategoryPolicy;
use App\Policies\MenuPolicy;
use App\Policies\SliderPolicy;
use App\Policies\SettingPolicy;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use App\Policies\ProductPolicy;




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

        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateSlider();
        $this->defineGateSetting();
        $this->defineGateUser();
        $this->defineGateRole();
        $this->defineGateProduct();

        // Gate::define('update-product', function (User $user,$id) {
        //     $product = Product::find($id);
        //     if ($user->checkPermissionAccess(config('permissions.access.update-product')) && $user->id === $product->user_id) {
        //         return true;
        //     }
        //     return false;
        // });
    }
    public function defineGateCategory()
    {
        Gate::define('read-category',[CategoryPolicy::class,'view']);
        Gate::define('create-category',[CategoryPolicy::class,'create']);
        Gate::define('update-category',[CategoryPolicy::class,'update']);
        Gate::define('delete-category',[CategoryPolicy::class,'delete']);
    }
    public function defineGateMenu()
    {
        Gate::define('read-menu',[MenuPolicy::class,'view']);
        Gate::define('create-menu',[MenuPolicy::class,'create']);
        Gate::define('update-menu',[MenuPolicy::class,'update']);
        Gate::define('delete-menu',[MenuPolicy::class,'delete']);
    }
    public function defineGateSlider()
    {
        Gate::define('read-slider',[SliderPolicy::class,'view']);
        Gate::define('create-slider',[SliderPolicy::class,'create']);
        Gate::define('update-slider',[SliderPolicy::class,'update']);
        Gate::define('delete-slider',[SliderPolicy::class,'delete']);
    }
    public function defineGateSetting()
    {
        Gate::define('read-setting',[SettingPolicy::class,'view']);
        Gate::define('create-setting',[SettingPolicy::class,'create']);
        Gate::define('update-setting',[SettingPolicy::class,'update']);
        Gate::define('delete-setting',[SettingPolicy::class,'delete']);
    }
    public function defineGateUser()
    {
        Gate::define('read-user',[UserPolicy::class,'view']);
        Gate::define('create-user',[UserPolicy::class,'create']);
        Gate::define('update-user',[UserPolicy::class,'update']);
        Gate::define('delete-user',[UserPolicy::class,'delete']);
    }
    public function defineGateRole()
    {
        Gate::define('read-role',[RolePolicy::class,'view']);
        Gate::define('create-role',[RolePolicy::class,'create']);
        Gate::define('update-role',[RolePolicy::class,'update']);
        Gate::define('delete-role',[RolePolicy::class,'delete']);
    }
    public function defineGateProduct()
    {
        Gate::define('read-product',[ProductPolicy::class,'view']);
        Gate::define('create-product',[ProductPolicy::class,'create']);
        Gate::define('update-product',[ProductPolicy::class,'update']);
        Gate::define('delete-product',[ProductPolicy::class,'delete']);
    }
}
