<?php

namespace Website;

class Cookies
{
    public function __construct()
    {
        session_name('JF-SESSION');
        session_start();
    }
}