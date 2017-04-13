<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Users\Contracts\UsersRepository;
use App\Services\Users\Entities\Users;
use App\Services\Users\Repositories\EloquentUsersRepository;

use App\Services\AdminUsers\Contracts\AdminUsersRepository;
use App\Services\AdminUsers\Entities\Admin;
use App\Services\AdminUsers\Repositories\EloquentAdminUsersRepository;

use App\Services\ForgotPassword\Contracts\ForgotPasswordRepository;
use App\Services\ForgotPassword\Entities\ForgotPassword;
use App\Services\ForgotPassword\Repositories\EloquentForgotPasswordRepository;

use App\Services\EmailTemplate\Contracts\EmailTemplatesRepository;
use App\Services\EmailTemplate\Entities\EmailTemplates;
use App\Services\EmailTemplate\Repositories\EloquentEmailTemplatesRepository;

use App\Services\CMS\Contracts\CMSRepository;
use App\Services\CMS\Entities\CMS;
use App\Services\CMS\Repositories\EloquentCMSRepository;

use App\Services\School\Contracts\SchoolRepository;
use App\Services\School\Entities\School;
use App\Services\School\Repositories\EloquentSchoolRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UsersRepository::class, function () {
        return new EloquentUsersRepository(new Users());
        });

        $this->app->bind(AdminUsersRepository::class, function () {
        return new EloquentAdminUsersRepository(new Admin());
        });

        $this->app->bind(ForgotPasswordRepository::class, function () {
        return new EloquentForgotPasswordRepository(new ForgotPassword());
        });

        $this->app->bind(EmailTemplatesRepository::class, function () {
        return new EloquentEmailTemplatesRepository(new EmailTemplates());
        });


        $this->app->bind(ImageRepository::class, function () {
        return new EloquentImageRepository(new Image());
        });

        $this->app->bind(CMSRepository::class, function () {
        return new EloquentCMSRepository(new CMS());
        });
        
        $this->app->bind(SchoolRepository::class, function () {
        return new EloquentSchoolRepository(new School());
        });
        
    }
}
