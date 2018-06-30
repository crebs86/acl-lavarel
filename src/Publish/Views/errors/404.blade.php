<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 16/04/18
 * Time: 22:22
 */
?>
@if(auth()->check())
    @include('errors.logged')
@else
    @include('errors.nolog')
@endif