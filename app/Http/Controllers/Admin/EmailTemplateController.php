<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use DB;
use Mail;
use Session;
use Redirect;
use App\Admin;
use App\Services\EmailTemplate\Contracts\EmailTemplatesRepository;
use App\EmailTemplates;
use App\Http\Requests\EmailTemplateRequest;

class EmailTemplateController extends Controller
{
    public function __construct(EmailTemplatesRepository $EmailTemplatesRepository)
    {
        $this->middleware('auth.admin');
        $this->objEmailTemplate                = new EmailTemplates();
        $this->EmailTemplatesRepository = $EmailTemplatesRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templatesDetail = $this->EmailTemplatesRepository->getAllEmailTemplatesData();
        return view('admin.listEmailTemplate',compact('templatesDetail'));
    }

    public function createEmailTemplate()
    {
        $templateDetail = [];
    	return view('admin.createEmailTemplate',compact('templateDetail'));
    }

    public function edit($id)
    {
        $templateDetail = $this->objEmailTemplate->find($id);
        return view('admin.createEmailTemplate', compact('templateDetail'));
    }

    public function save(EmailTemplateRequest $EmailTemplateRequest)
    {
        $templateDetail = [];

        $templateDetail['id']  = e(input::get('id'));
        $templateDetail['templatename']   = e(input::get('templatename'));
        $templateDetail['templatepseudoname']   = e(input::get('templatepseudoname'));
        $templateDetail['subject']  = input::get('subject');
        $templateDetail['body']  = input::get('body');
        $templateDetail['deleted']  = input::get('deleted');

        $response = $this->EmailTemplatesRepository->saveEmailTemplateDetail($templateDetail);
        if($response)
        {
            return Redirect::to("admin/list-email-template")->with('success',trans('admin.templateupdatesuccess'));
        }
        else
        {
            return Redirect::to("admin/list-email-template")->with('error', trans('admin.commonerrormessage'));
        }
    }

    public function delete($id)
    {
        $return = $this->EmailTemplatesRepository->deleteEmailTemplate($id);
        if($return)
        {
            return Redirect::to("admin/list-email-template")->with('success', trans('admin.templatedeletesuccess'));
        }
        else
        {
            return Redirect::to("admin/list-email-template")->with('error', trans('admin.commonerrormessage'));
        }
    }
}
