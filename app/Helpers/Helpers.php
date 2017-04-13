<?php

namespace App\Helpers;

use DB;
use Config;
use App\User;
use App\Image;
use File;
Class Helpers {
       /*
      return : String of unique ID
     */

    public static function getVarifyToken() {
        $uniqueId = uniqid("", TRUE);

        return $uniqueId;
    }

    public static function status() {
        $status = array('1' => 'Active', '2' => 'In active');
        return $status;
    }    

    public static function getUserProfilePhoto($userId,$size='thumb')
    {
        $imageUrl = '';
        //First get user profile image id
        $userData = User::find($userId);
        if(isset($userData->profile_url) && !empty($userData->profile_url)){
            //Now fetch image name
            $imageData = Image::find($userData->profile_url);
            if(isset($imageData) && !empty($imageData)){               
               switch ($size) {
                   case "thumb":
                        if (file_exists(Config::get('constant.USER_THUMB_IMAGE_UPLOAD_PATH') . $imageData->url) && $imageData->url != '') {
                            $imageUrl = asset(Config::get('constant.USER_THUMB_IMAGE_UPLOAD_PATH').$imageData->url);
                        }
                        break;
                    case "icon":
                        if (file_exists(Config::get('constant.USER_ICON_IMAGE_UPLOAD_PATH') . $imageData->url) && $imageData->url != '') {
                            $imageUrl = asset(Config::get('constant.USER_ICON_IMAGE_UPLOAD_PATH').$imageData->url);
                        }
                        break;
                    case "original":
                        if (file_exists(Config::get('constant.USER_ORIGINAL_IMAGE_UPLOAD_PATH') . $imageData->url) && $imageData->url != '') {
                            $imageUrl = asset(Config::get('constant.USER_ORIGINAL_IMAGE_UPLOAD_PATH').$imageData->url);
                        }
                        break;
                    default :
                        $imageUrl = asset(Config::get('constant.USER_THUMB_IMAGE_UPLOAD_PATH')."user-default.png");
                        break;
               }                                              
            }else{
               $imageUrl = asset(Config::get('constant.USER_THUMB_IMAGE_UPLOAD_PATH')."user-default.png");
            }            
        }else{
            $imageUrl = asset(Config::get('constant.USER_THUMB_IMAGE_UPLOAD_PATH')."user-default.png");
        }
        return $imageUrl;
    }
    
    /*
     * Parse CSV
     */

    public static function csv_to_array($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}