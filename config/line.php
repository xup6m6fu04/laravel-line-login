<?php

return [
    'channel_id' => env('LINE_CHANNEL_ID'),
    'secret' => env('LINE_SECRET'),
    'authorize_base_url' => 'https://access.line.me/oauth2/v2.1/authorize',
    'get_token_url' => 'https://api.line.me/oauth2/v2.1/token',
    'get_user_profile_url' => 'https://api.line.me/v2/profile',
];