<?php


if (! function_exists('admin'))
{
    function admin(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        if (auth('admin')->check())
        {
            return auth('admin')->user();
        }
        return null;
    }
}

if (! function_exists('user'))
{
    function user(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        if (auth('user')->check())
        {
            return auth('user')->user();
        }
        return null;
    }
}

if (! function_exists('company'))
{
    function company(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        if (auth('company')->check())
        {
            return auth('company')->user();
        }
        return null;
    }
}


if (! function_exists('settings'))
{
    function settings(string $key)
    {
       return config('settings.'.$key);
    }
}

if (! function_exists('money'))
{
    function money(float $amount, string $currency = null): string
    {
        $currency = $currency ?? (string)settings('currency_code');
        return number_format($amount,2,',','') .' '.$currency;
    }
}


