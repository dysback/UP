<?php

function request($key, $default = "") {
    if(isset($_REQUEST[$key])) {
        return $_REQUEST[$key];
    }
    return $default;
}