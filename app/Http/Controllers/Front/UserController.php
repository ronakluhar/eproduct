<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Users\Contracts\UsersRepository;
use App\Http\Requests\UserProfileUpdateRequest;
use Input;
use File;
use Config;
use Image;
use Auth;
use Redirect;

class UserController extends Controller
{
    public function __construct(UsersRepository $UsersRepository) {
        $this->UsersRepository = $UsersRepository;
        $this->userOriginalImageUploadPath = Config::get('constant.USER_ORIGINAL_IMAGE_UPLOAD_PATH');
        $this->userThumbImageUploadPath = Config::get('constant.USER_THUMB_IMAGE_UPLOAD_PATH');
        $this->userIconImageUploadPath = Config::get('constant.USER_ICON_IMAGE_UPLOAD_PATH');
        $this->userThumbImageHeight = Config::get('constant.USER_THUMB_IMAGE_HEIGHT');
        $this->userThumbImageWidth = Config::get('constant.USER_THUMB_IMAGE_WIDTH');
        $this->userIconImageHeight = Config::get('constant.USER_ICON_IMAGE_HEIGHT');
        $this->userIconImageWidth = Config::get('constant.USER_ICON_IMAGE_WIDTH');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('user')->check())
        {
            $userDetail = $this->UsersRepository->getUserDetailById(Auth::guard('user')->id());

          
            $profilePath = $this->userThumbImageUploadPath;

            return view('front.profile',compact('profileData','profilePath','userDetail'));
        }
        return Redirect::to("/login");
        exit;    

    }
    
    public function saveProfileSetting(UserProfileUpdateRequest $UserProfileUpdateRequest) 
    {
        $profileData = [];
        $profileData['id'] = Auth::guard('user')->id();
        
        $profileData['first_name'] = (Input::get('first_name') && Input::get('first_name') != '') ? Input::get('first_name') : Auth::guard('user')->get()->first_name;
        $profileData['last_name'] = (Input::get('last_name') && Input::get('last_name') != '') ? Input::get('last_name') : Auth::guard('user')->get()->last_name;
        $profileData['phone'] = (Input::get('phone') && Input::get('phone') != '') ? Input::get('phone') : "";
        $profileData['gender'] = (Input::get('gender') && Input::get('gender') != '') ? Input::get('gender') : 1;
        
        $imageData = [];
        $imageData['id'] = Auth::guard('user')->user()->profile_url;
//        $profileDataUrl = $this->ImageRepository->getUserProfileDataById($imageData['id']);
//        $imageData['url'] = (isset($profileDataUrl->url) && $profileDataUrl->url != "") ? $profileDataUrl->url : "";

        if (Input::file()) {
            $file = Input::file('profile_url');
            $fileName = "";
            if (!empty($file) && in_array($file->getClientOriginalExtension(), array('jpg','jpeg','bmp','png')) ) {
                    $imageData['name'] = 'user_' . time();
                    $fileName = 'user_' . time() . '.' . $file->getClientOriginalExtension();
                    $pathOriginal = public_path($this->userOriginalImageUploadPath . $fileName);
                    $pathThumb = public_path($this->userThumbImageUploadPath . $fileName);
                    $pathIcon = public_path($this->userIconImageUploadPath . $fileName);

                    Image::make($file->getRealPath())->save($pathOriginal);
                    Image::make($file->getRealPath())->resize($this->userThumbImageHeight, $this->userThumbImageWidth)->save($pathThumb);
                    Image::make($file->getRealPath())->resize($this->userIconImageHeight, $this->userIconImageWidth)->save($pathIcon);

                    if ($imageData['url'] != '') {
                        $imageOriginal = public_path($this->userOriginalImageUploadPath . $imageData['url']);
                        $imageThumb = public_path($this->userThumbImageUploadPath . $imageData['url']);
                        $imageIcon = public_path($this->userIconImageUploadPath . $imageData['url']);
                        if(file_exists($imageOriginal) && $imageData['url'] != ''){File::delete($imageOriginal);}
                        if(file_exists($imageThumb) && $imageData['url'] != ''){File::delete($imageThumb);}
                        if(file_exists($imageIcon) && $imageData['url'] != ''){File::delete($imageIcon);}
                }
                $imageData['url'] = $fileName;
            }
        }
        
        //$return = $this->ImageRepository->saveProfileImageData($imageData);

        //$profileData['profile_url'] = $return['id'];

        $result = $this->UsersRepository->updateUserDetailById($profileData);
        if ($result) 
        {
            return Redirect::to("/profile")->with('success', trans('label.update_profile_msg'));
            exit;    
        }
        else
        {
            return Redirect::to("/profile")->with('error', trans('label.exist_user_msg'));
            exit;
        }
    }                    
}
