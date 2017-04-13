<?php

namespace App\Services\ForgotPassword\Contracts;

use App\Services\Repositories\BaseRepository;
use App\Services\ForgotPassword\Entities\ForgotPassword;

interface ForgotPasswordRepository extends BaseRepository
{
    public function getExistTokenDetail($forgotToken, $userType);

    public function savePasswordRequestDetail($array);
}
