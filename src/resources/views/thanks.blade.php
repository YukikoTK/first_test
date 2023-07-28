@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection


@section('content')
<div class="thanks">
    <div class="thanks_inner">
        <p class="thanks_msg">ご意見いただきありがとうございました。</p>
        <div class="thanks_button">
            <button class="thanks_button-submit" onclick="location.href='{{ url('/') }}'" type="button">トップページへ</button>
        </div>
    </div>
</div>
@endsection