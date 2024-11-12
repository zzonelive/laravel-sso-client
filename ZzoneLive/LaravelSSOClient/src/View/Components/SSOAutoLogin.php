<?php

namespace ZzoneLive\LaravelSSOClient\View\Components;

use Illuminate\View\Component;

class SSOAutoLogin extends Component
{
    public $ssoUrl;
    public $origin;

    public function __construct($ssoUrl, $origin)
    {
        $this->ssoUrl = $ssoUrl;
        $this->origin = $origin;
    }

    public function render()
    {
        return view('LaravelSSOClient::components.sso-auto-login');
    }
}
