@extends('layouts.mail')

@section('title',__('ユーザー認証'))

@section('content')
<div>
    <div>{{__('ユーザー認証')}}</div>
    <a href='{{$url}}'>{{__('このリンクをクリックして認証を完了させてください。')}}
</div>