<?php

namespace Crmos\People\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Psr7Response;

class AuthController extends AccessTokenController
{
    protected $cookie;

    public function issueToken(ServerRequestInterface $request)
    {
        // Generates access token
        $access = $this->withErrorHandling(function () use ($request) {
            $this->cookie = $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Psr7Response())
            );

            return $this->cookie;
        });

        // Get access token if login was successfully
        $token = optional(json_decode(optional($this->cookie)->content()))->access_token;

        // Clean response content to protect the token and Set token into cookies
        if ($token) {
            $access->cookie('laravel_token', $token);
            $access->setContent('{"message": "success"}');
        }

        return $access;
    }

    public function revokeToken(Request $request)
    {
        $request->user()->token()->revoke();

        return HttpResponse::create(['message' => 'success'])->cookie(cookie()->forget('laravel_token'));
    }
}
