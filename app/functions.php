<?php

if ( ! function_exists('flash')) {
    function flash($message, $type = 'success')
    {
        request()->session()->flash('flash', $message);
        request()->session()->flash('flashType', $type);
    }
}