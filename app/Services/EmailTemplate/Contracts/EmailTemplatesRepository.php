<?php

namespace App\Services\EmailTemplate\Contracts;
use App\Services\Repositories\BaseRepository;
use App\Services\Template\Entities\Templates;

interface EmailTemplatesRepository extends BaseRepository
{    
    /**     
     * @return array of all active Email Templates in the application
     */
    public function getAllEmailTemplatesData();

    /**
     * Save Parent detail passed in $templateDetail array
    */
    public function saveEmailTemplateDetail($templateDetail);

    /**
     * Delete Email Template by $id
    */
    public function deleteEmailTemplate($id);

    /**
     * return array of placeholder of email template
    */
    public function getEmailTemplateDataByName($pseudoName);

    /**
     *change place holder with dynamic value
    */
    public  function getEmailContent($str , $arr);

}
