<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\LineService;

class LoginController extends Controller
{
    protected $lineService;

    public function __construct(LineService $lineService)
    {
        $this->lineService = $lineService;
    }

    public function pageLine()
    {
        $url = $this->lineService->getLoginBaseUrl();
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
            $response = $this->lineService->getLineToken($code);
            $user_profile = $this->lineService->getUserProfile($response['access_token']);
            echo "<pre>"; print_r($user_profile); echo "</pre>";
        } catch (Exception $ex) {
            Log::error($ex);
        }
    }
}
