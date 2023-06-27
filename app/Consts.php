<?php

namespace App;

class Consts
{
    const PER_PAGE = 12;

    const CODE_SUCCESS = 200;
    const CODE_CREATE = 201;
    const CODE_NO_AUTHORITATIVE = 203;
    const CODE_NO_CONTENT = 204;
    const CODE_BAD_REQUEST = 400;
    const CODE_UNAUTHORIZED = 401;
    const CODE_NOT_FOUND = 404;
    const CODE_UNPROCESSABLE = 422;
    const CODE_METHOD_NOT_ALLOWED = 405;

    const ERROR_BAD_REQUEST = 400;
    const ERROR_UNAUTHORIZED = 401;
    const ERROR_FORBIDDEN = 403;
    const ERROR_TOO_MANY_REQUESTS = 429;
    const ERROR_INTERNAL_SERVER = 500;
}
