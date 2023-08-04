@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection


@section('content')
<div class="confirm">
    <div class="confirm_heading">
        <h1>内容確認</h1>
    </div>
    <form action="/contacts/store" class="confirm_content" method="post">
        @csrf
        <div class="confirm_content-inner">
            <table class="confirm_content-table">
                <tr>
                    <th class="confirm_content-header">お名前</th>
                    <td class="confirm_content-item confirm_content-name">
                        <input class="confirm_input" type="text" name="lastname" value="{{ $contact['lastname'] }}" readonly>
                        <input class="confirm_input" type="text" name="firstname" value="{{ $contact['firstname'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th class="confirm_content-header">性別</th>
                    <td class="confirm_content-item">
                        <input class="confirm_input" type="text" name="gender" value="{{ $contact['gender'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th class="confirm_content-header">メールアドレス</th>
                    <td class="confirm_content-item">
                        <input class="confirm_input" type="text" name="email" value="{{ $contact['email'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th class="confirm_content-header">郵便番号</th>
                    <td class="confirm_content-item">
                        <input class="confirm_input" type="text" name="postcode" value="{{ $contact['postcode'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th class="confirm_content-header">住所</th>
                    <td class="confirm_content-item">
                        <input class="confirm_input" type="text" name="address" value="{{ $contact['address'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th class="confirm_content-header">建物名</th>
                    <td class="confirm_content-item">
                        <input class="confirm_input" type="text" name="building_name" value="{{ $contact['building_name'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm_content-last">
                    <th class="confirm_content-header">ご意見</th>
                    <td class="confirm_content-item">
                        <input class="confirm_input confirm_input-option" type="text" name="option" value="{{ $contact['option'] }}" readonly>
                    </td>
                </tr>
            </table>
            <div class="confirm_button">
                <button class="confirm_button-submit" type="submit">送信</button>
                <p class="confirm_fix">
                    <a href="{{ route('contact.edit') }}" class="confirm_fix-link">修正する</a>
            </div>
        </div>
    </form>
</div>
@endsection