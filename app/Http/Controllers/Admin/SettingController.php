<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    public function appearance(Request $request)
    {
        Setting::updateOrCreate(['key' => 'site_title'], ['value' => $request->get('site_title')]);
        Setting::updateOrCreate(['key' => 'email'], ['value' => $request->get('email')]);
        Setting::updateOrCreate(['key' => 'meta_title'], ['value' => $request->get('meta_title')]);
        Setting::updateOrCreate(['key' => 'address'], ['value' => $request->get('address')]);
        Setting::updateOrCreate(['key' => 'store_owner'], ['value' => $request->get('store_owner')]);
        Setting::updateOrCreate(['key' => 'telephone'], ['value' => $request->get('telephone')]);
        Setting::updateOrCreate(['key' => 'meta_keyword'], ['value' => $request->get('meta_keyword')]);
        Setting::updateOrCreate(['key' => 'meta_description'], ['value' => $request->get('meta_description')]);
        
        
        if ($request->hasFile('site_logo')) {
            $this->deleteOldLogo(setting('site_logo'));
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                [
                    'value' => Storage::disk('media')->putFile('logos', $request->file('site_logo'))
                ]
                );
        }
        if ($request->hasFile('site_favicon')) {
            $this->deleteOldLogo(setting('site_favicon'));
            Setting::updateOrCreate(
                ['key' => 'site_favicon'],
                [
                    'value' => Storage::disk('media')->putFile('logos', $request->file('site_favicon'))
                ]
                );
        }
        notify()->success('Settings Successfully Updated.','Success');
        return back();
    }


    private function deleteOldLogo($path)
    {
        Storage::disk('media')->delete($path);
    }

    public function social(Request $request)
    {
        Setting::updateOrCreate(['key' => 'facebook'], ['value' => $request->get('facebook')]);
        Setting::updateOrCreate(['key' => 'linkedin'], ['value' => $request->get('linkedin')]);
        Setting::updateOrCreate(['key' => 'youtube'], ['value' => $request->get('youtube')]);
        Setting::updateOrCreate(['key' => 'reddit'], ['value' => $request->get('reddit')]);
        Setting::updateOrCreate(['key' => 'twitter'], ['value' => $request->get('twitter')]);
        Setting::updateOrCreate(['key' => 'instagram'], ['value' => $request->get('instagram')]);
        Setting::updateOrCreate(['key' => 'pinterest'], ['value' => $request->get('pinterest')]);
        Setting::updateOrCreate(['key' => 'quora'], ['value' => $request->get('quora')]);
        notify()->success('Social Icon Successfully Updated.','Success');
        return back();
    }

    public function socialite(Request $request)
    {
        Setting::updateOrCreate(['key' => 'facebook_client_id'], ['value' => $request->get('facebook_client_id')]);
        Setting::updateOrCreate(['key' => 'facebook_client_secret'], ['value' => $request->get('facebook_client_secret')]);
        Setting::updateOrCreate(['key' => 'google_client_id'], ['value' => $request->get('google_client_id')]);
        Setting::updateOrCreate(['key' => 'google_client_secret'], ['value' => $request->get('google_client_secret')]);
        Setting::updateOrCreate(['key' => 'github_client_id'], ['value' => $request->get('github_client_id')]);
        Setting::updateOrCreate(['key' => 'github_client_secret'], ['value' => $request->get('github_client_secret')]);


        // Update .env mail settings
        Artisan::call("env:set FACEBOOK_CLIENT_ID='". $request->facebook_client_id ."'");
        Artisan::call("env:set FACEBOOK_CLIENT_SECRET='". $request->facebook_client_secret ."'");
        Artisan::call("env:set GOOGLE_CLIENT_ID='". $request->google_client_id ."'");
        Artisan::call("env:set GOOGLE_CLIENT_SECRET='". $request->google_client_secret ."'");
        Artisan::call("env:set GITHUB_CLIENT_ID='". $request->github_client_id ."'");
        Artisan::call("env:set GITHUB_CLIENT_SECRET='". $request->github_client_secret ."'");

        
        notify()->success('Socialite Successfully Updated.','Success');
        return back();
    }

    public function mail(Request $request)
    {
        Setting::updateOrCreate(['key' => 'mail_mailer'], ['value' => $request->get('mail_mailer')]);
        Setting::updateOrCreate(['key' => 'mail_encryption'], ['value' => $request->get('mail_encryption')]);
        Setting::updateOrCreate(['key' => 'mail_host'], ['value' => $request->get('mail_host')]);
        Setting::updateOrCreate(['key' => 'mail_port'], ['value' => $request->get('mail_port')]);
        Setting::updateOrCreate(['key' => 'mail_username'], ['value' => $request->get('mail_username')]);
        Setting::updateOrCreate(['key' => 'mail_password'], ['value' => $request->get('mail_password')]);
        Setting::updateOrCreate(['key' => 'mail_from_address'], ['value' => $request->get('mail_from_address')]);
        Setting::updateOrCreate(['key' => 'mail_from_name'], ['value' => $request->get('mail_from_name')]);
        Setting::updateOrCreate(['key' => 'mail_mailer'], ['value' => $request->get('mail_mailer')]);
        Setting::updateOrCreate(['key' => 'mail_mailer'], ['value' => $request->get('mail_mailer')]);
        Setting::updateOrCreate(['key' => 'mail_mailer'], ['value' => $request->get('mail_mailer')]);
        Setting::updateOrCreate(['key' => 'mail_mailer'], ['value' => $request->get('mail_mailer')]);
        Setting::updateOrCreate(['key' => 'mail_mailer'], ['value' => $request->get('mail_mailer')]);

        // Update .env mail settings
        Artisan::call("env:set MAIL_MAILER='". $request->mail_mailer ."'");
        Artisan::call("env:set MAIL_HOST='". $request->mail_host ."'");
        Artisan::call("env:set MAIL_PORT='". $request->mail_port ."'");
        Artisan::call("env:set MAIL_USERNAME='". $request->mail_username ."'");
        Artisan::call("env:set MAIL_PASSWORD='". $request->mail_password ."'");
        Artisan::call("env:set MAIL_ENCRYPTION='". $request->mail_encryption ."'");
        Artisan::call("env:set MAIL_FROM_ADDRESS='". $request->mail_from_address ."'");
        Artisan::call("env:set MAIL_FROM_NAME='". $request->mail_from_name ."'");


        notify()->success('Mail Setup Successfully Updated.','Success');
        return back();
    }
}
