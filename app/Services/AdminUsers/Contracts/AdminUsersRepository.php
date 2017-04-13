<?php

namespace App\Services\AdminUsers\Contracts;

use App\Services\Repositories\BaseRepository;
use App\Services\AdminUsers\Entities\AdminUsers;

interface AdminUsersRepository extends BaseRepository
{
    public function getActiveUserDetailByEmail($email);

    public function getActiveUserDetailById($id);

    public function saveUserProfileData($array);
}
