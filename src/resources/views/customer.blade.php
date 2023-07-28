<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理システム</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}" />

    <!-- datepicker -->
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>

    <script>
        $(function() {
        $.datepicker.setDefaults( $.datepicker.regional[ "ja" ] );
        $( "#datepicker1" ).datepicker();
        $( "#datepicker2" ).datepicker();
        });
    </script>


    <!-- マウスオーバー -->
    <script>
        function showFullText(element) {
        element.value = element.getAttribute('title');
        }

        function showLimitedText(element) {
        var limitedText = element.getAttribute('title');
        if (limitedText.length > 25) {
            limitedText = limitedText.substr(0, 25) + '...';
        }
        element.value = limitedText;
        }
    </script>

</head>


<body>
    <main>
        <div class="system">
            <div class="system_heading">
                <h1>管理システム</h1>
            </div>
            <form class="system_content" action="/customer/search" method="get">
                @csrf
                <div class="system_content-flex">
                    <div class="system_content-flex system_content-inner">
                        <div class="system_content-tittle">
                            <label for="name" class="system_label-item">お名前</label>
                        </div>
                        <div class="system_input-item">
                            <input type="text" class="name" id="name" name="fullname" value="">
                        </div>
                    </div>
                    <div class="system_content-inner system_content-top">
                        <div class="system_content-flex">
                            <div class="system_content-tittle-gender">
                                <label class="system_label-item">性別</label>
                            </div>
                            <div class="system_input-item">
                                <div class="system_content-flex system_input-gender">
                                    <label for="all" class="radio">
                                        <input type="radio" class="radio_input" name="gender" checked id="all" value="全て">
                                        <span class="radio_text">全て</span>
                                    </label>
                                    <label for="man" class="radio">
                                        <input type="radio" class="radio_input" name="gender" id="man" value="男性">
                                        <span class="radio_text">男性</span>
                                    </label>
                                    <label for="woman" class="radio">
                                        <input type="radio" class="radio_input" name="gender" id="woman" value="女性">
                                        <span class="radio_text">女性</span>
                                    </label>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="system_content-inner">
                    <div class="system_content-flex">
                        <div class="system_content-tittle">
                            <label for="date" class="system_label-item">登録日</label>
                        </div>
                        <div class="system_input-item">
                            <div class="system_content-flex">
                                <input class="date" id="datepicker1" name="from">
                                <p class="date_space">〜</p>
                                <input class="date" type="text" id="datepicker2" name="until">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system_content-inner">
                    <div class="system_content-flex">
                        <div class="system_content-tittle">
                            <label for="email" class="system_label-item">メールアドレス</label>
                        </div>
                        <div class="system_input-item">
                            <input type="text" class="email" id="email" name="email">
                        </div>
                    </div>
                </div>
                <div class="system_button">
                    <button class="system_button-submit">検索</button>
                    <p class="system_reset">
                        <a href="{{ route('customer.reset') }}" class="system_fix-link">リセット</a>
                    </p>
                </div>
            </form>
            <div class="system_list-inner">
                {{ $contacts->appends(request()->input())->links() }}
                <table class="system_list-item">
                    <tr class="system_list-header">
                        <th class="system_list-id">ID</th>
                        <th class="system_list-name">お名前</th>
                        <th class="system_list-gender">性別</th>
                        <th class="system_list-email">メールアドレス</th>
                        <th class="system_list-option">ご意見</th>
                    </tr>
                        @foreach($contacts as $contact)
                    <tr class="system_list-input">
                        <td class="system_input system_input_center">
                            <input class="input_none system_input-id" type="text" name="id" value="{{ $contact->id }}" readonly>
                        </td>
                        <td class="system_input">
                            <input class="input_none system_input-name" type="text" name="fullname" value="{{ $contact->fullname }}" readonly>
                        </td>
                        <td class="system_input">
                            <span class="input_none system_input-gender">
                            @if ($contact->gender == 1)
                                男性
                            @else ($contact->gender == 2)
                                女性
                            @endif
                            </span>
                        </td>
                        <td class="system_input">
                            <input class="input_none system_input-email" type="text" name="email" value="{{ $contact->email }}" readonly>
                        </td>
                        <td class="system_input">
                            <input class="input_none system_input-option" type="text" name="option" value="{{ Str::limit($contact->option, 50) }}" title="{{ $contact->option }}" onmouseover="showFullText(this)" onmouseout="showLimitedText(this)" readonly>
                        </td>
                        <td class="system_input delete_button">
                            <form action="{{ route('customer.delete') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $contact['id'] }}">
                                <button class="delete_button-right">削除</button>
                            </form>
                        </td>
                    </tr>
                        @endforeach
                    </table>
                </div>
        </div>
    </main>
</body>
</html>