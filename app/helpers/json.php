<?php

function isJson(string | array $data)
{
    json_decode($data);

    return json_last_error() === JSON_ERROR_NONE;
}
