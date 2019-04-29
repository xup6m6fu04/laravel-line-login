<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\LineService;

class LoginController extends Controller
{
    public function pageLine()
    {
        $url = LineService::getLoginBaseUrl();
        return view('line')->with('url', $url);
    }

    public function lineLoginCallBack(Request $request)
    {
        try {
            $error = $request->input('error', false);
            if ($error) {
                throw new Exception($request->all());
            }
            $code = $request->input('code', '');
            $response = LineService::getLineToken($code);
            $user_profile = LineService::getUserProfile($response['access_token']);
            echo "<pre>"; print_r($user_profile); echo "</pre>"; exit;
        } catch (Exception $ex) {
            Log::error($ex);
        }
    }
}
