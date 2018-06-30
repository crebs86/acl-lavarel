<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 16/04/18
 * Time: 22:22
 */
?>
@extends('errors.default')
@section('content')
    <div class="content">
        <div class="title m-b-md">
            {{__('crebs::interface.error')}}
        </div>
        <div class="links">
            <h2>{{$exception->getMessage()}}</h2>
            <a style="cursor: pointer" onclick="window.history.go(-1)">{{__('crebs::interface.error_try_back')}}</a>
        </div>
    </div>
@endsection