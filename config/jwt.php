<?php

return [
    'secret' => env('JWT_SECRET'),
    'expiration_in_sec' => env('JWT_EXPIRATION_IN_SEC', 3600),
    'algorithm' => env('JWT_ALGORITHM', 'HS256'),
];
