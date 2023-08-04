@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection



<!-- 郵便番号検索 -->
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- バリデーション -->
<script>
    $(document).ready(function() {
        $('input[name="lastname"], input[name="firstname"], input[name="address"]').on('blur', function() {
            validateField($(this));
        });

        function validateField(field) {
            var fieldName = field.attr('name');
            var fieldValue = field.val();
            var errorSelector = '.error_' + fieldName;

            if (fieldValue.trim() === '') {
                $(errorSelector).text('入力してください');
            } else {
                $(errorSelector).text('');
            }
        }
    });

    $(document).ready(function() {
        $('input[name="email"]').on('blur', function() {
            validateEmail();
        });

        function validateEmail() {
            var email = $('input[name="email"]').val();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.trim() === '') {
            $('.error_email').text('入力してください');
        } else if (!emailRegex.test(email)) {
            $('.error_email').text('メールアドレスの形式で入力してください');
        } else {
            $('.error_email').text('');
        }
        }
    });

    $(document).ready(function() {
            $('input[name="postcode"]').on('input', function() {
                convertPostalCode();
            });

            function convertPostalCode() {
                var value = $('input[name="postcode"]').val();
                value = value.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
                    return String.fromCharCode(s.charCodeAt(0) - 65248);
                }).replace(/[\u30A0-\u30FF]/g, '-');
                $('input[name="postcode"]').val(value);
            }
        });

    $(document).ready(function() {
        $('input[name="postcode"]').on('blur', function() {
            validatePostcode();
        });

    function validatePostcode() {
        var postcode = $('input[name="postcode"]').val();
        var postcodeRegex = /^\d{3}-\d{4}$/;
        if (postcode.trim() === '') {
            $('.error_postcode').text('入力してください');
        } else if (!postcodeRegex.test(postcode)) {
            $('.error_postcode').text('ハイフンを含む8桁で入力してください');
        } else {
            $('.error_postcode').text('');
        }
    }
    });

    $(document).ready(function() {
        $('textarea[name="option"]').on('blur', function() {
            validateOption();
        });

        function validateOption() {
        var option = $('textarea[name="option"]').val();
        var optionRegex = /^[\s\S]{1,120}$/;
        if (option.trim() === '') {
            $('.error_option').text('入力してください');
        } else if (!optionRegex.test(option)) {
            $('.error_option').text('120文字以下で入力してください');
        } else {
            $('.error_option').text('');
        }
    }
    });
</script>



@section('content')
<div class="form">
    <div class="form_heading">
        <h1>お問い合わせ</h1>
    </div>
    <form class="form_content h-adr" action="/contacts/confirm" method="post">
        @csrf
        <div class="form_content-inner">
            <div class="form_content-flex">
                <div class="form_content-tittle">
                    <label for="name" class="form_label-item">お名前</label>
                    <span class="form_label-required">※</span>
                </div>
                <div class="form_input-item">
                    <div class="form_input-item-name">
                        <div class="form_input-lastname">
                            <input type="text" class="lastname must" id="name" name="lastname" value="{{ old('lastname', $previousInput['lastname'] ?? '') }}">
                            <p class="example_lastname">例）山田</p>
                            <div class="form_error error_lastname">
                                @error('lastname')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form_input-firstname">
                            <input type="text" class="firstname must" name="firstname" value="{{ old('firstname', $previousInput['firstname'] ?? '') }}">
                            <p class="example_firstname">例）太郎</p>
                            <div class="form_error error_firstname">
                                @error('firstname')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form_content-inner">
            <div class="form_content-flex">
                <div class="form_content-tittle">
                    <label class="form_label-item">性別</label>
                    <span class="form_label-required">※</span>
                </div>
                    <div class="form_input-item">
                        <div class="form_input-gender">
                            <label for="man" class="radio">
                                <input type="radio" class="radio_input" name="gender" value="男性" {{ old('gender', isset($previousInput['gender']) && $previousInput['gender'] === '男性') ? 'checked' : '' }} checked id="man">
                                <span class="radio_text">男性</span>
                            </label>
                            <label for="woman" class="radio">
                                <input type="radio" class="radio_input" name="gender" value="女性" {{ old('gender', isset($previousInput['gender']) && $previousInput['gender'] === '女性') ? 'checked' : '' }} id="woman">
                                <span class="radio_text">女性</span>
                            </label>
                        </div>
                    </div>
            </div>
        </div>
        <div class="form_content-inner">
            <div class="form_content-flex">
                <div class="form_content-tittle">
                    <label for="email" class="form_label-item">メールアドレス</label>
                    <span class="form_label-required">※</span>
                </div>
                <div class="form_input-item">
                    <input type="text" class="email" id="email" name="email" value="{{ old('email', $previousInput['email'] ?? '') }}">
                    <p class="example">例）test@example.com</p>
                    <div class="form_error error_email">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form_content-inner">
            <div class="form_content-flex">
                <div class="form_content-tittle">
                    <label for="postcode" class="form_label-item">郵便番号</label>
                    <span class="form_label-required">※</span>
                </div>
                <div class="form_input-item">
                    <div class="form_input-postcode">
                        <span class="p-country-name" style="display:none;">Japan</span>
                        <p>〒</p>
                        <div class="form_input-postcode-textarea">
                            <input type="text" class="postcode p-postal-code" id="postcode" name="postcode" size="8" maxlength="8" oninput="convertPostalCode()" value="{{ old('postcode', $previousInput['postcode'] ?? '') }}">
                            <p class="example">例）123-4567</p>
                        </div>
                    </div>
                    <div class="form_error error_postcode">
                    @error('postcode')
                    {{ $message }}
                    @enderror
                </div>
                </div>
            </div>
        </div>
        <div class="form_content-inner">
            <div class="form_content-flex">
                <div class="form_content-tittle">
                    <label for="address" class="form_label-item">住所</label>
                    <span class="form_label-required">※</span>
                </div>
                <div class="form_input-item">
                    <input type="text" class="address p-region p-locality p-street-address p-extended-address must" id="address" name="address" value="{{ old('address', $previousInput['address'] ?? '') }}">
                    <p class="example">例）東京都渋谷区千駄ヶ谷1-2-3</p>
                    <div class="form_error error_address">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form_content-inner">
            <div class="form_content-flex">
                <div class="form_content-tittle">
                    <label for="building_name" class="form_label-item">建物名</label>
                </div>
                <div class="form_input-item">
                    <input type="text" class="address" id="building_name" name="building_name" value="{{ old('building_name', $previousInput['building_name'] ?? '') }}">
                    <p class="example">例）千駄ヶ谷マンション101</p>
                </div>
            </div>
        </div>
        <div class="form_content-inner">
            <div class="form_content-flex">
                <div class="form_content-tittle">
                    <label for="option" class="form_label-item">ご意見</label>
                    <span class="form_label-required">※</span>
                </div>
                <div class="form_input-item">
                    <textarea class="option" id="option" name="option">{{ old('option', $previousInput['option'] ?? '') }}</textarea>
                    <div class="form_error error_option">
                        @error('option')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form_button">
            <button class="form_button-submit" type="submit">送信</button>
        </div>
    </form>
</div>
@endsection