<?php

namespace App\Helpers;

use DB;
use Config;
use App\User;
use App\Image;
use File;
//use App\Helpers\SplFileObject;

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

                // Trim white spaces of array values
                $trimmed_row = array_map('trim', $row);
                if (!$header) {
                    $header = $trimmed_row;
                } else {
                    $data[] = array_combine($header, $trimmed_row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
    
    /*
     * Parse CSV
     * Get File delimiter
     */

    public static function get_file_delimiter($file, $checkLines = 5){

        // use php's built in file parser class for validating the csv or txt file
        $file = new \SplFileObject($file);

        // array of predefined delimiters. Add any more delimiters if you wish
        $delimiters = array(',', '\t', ';', '|', ':');

        // store all the occurences of each delimiter in an associative array
        $number_of_delimiter_occurences = array();

        $results = array();

        $i = 0; // using 'i' for counting the number of actual row parsed
        while ($file->valid() && $i <= $checkLines) {

            $line = $file->fgets();

            foreach ($delimiters as $idx => $delimiter){

                $regExp = '/['.$delimiter.']/';
                $fields = preg_split($regExp, $line);

                // construct the array with all the keys as the delimiters
                // and the values as the number of delimiter occurences
                $number_of_delimiter_occurences[$delimiter] = count($fields);

            }

           $i++;
        }

        // get key of the largest value from the array (comapring only the array values)
        // in our case, the array keys are the delimiters
        $results = array_keys($number_of_delimiter_occurences, max($number_of_delimiter_occurences));


        // in case the delimiter happens to be a 'tab' character ('\t'), return it in double quotes
        // otherwise when using as delimiter it will give an error,
        // because it is not recognised as a special character for 'tab' key,
        // it shows up like a simple string composed of '\' and 't' characters, which is not accepted when parsing csv files
        return $results[0] == '\t' ? "\t" : $results[0];
    }
}