@extends('layout')

@section('content')

    <div class="jumbotron">
        <h1>Before you Send message</h1>
        <p class="lead">Make sure you invite yourself to tutorial Telegram group first.<br /> Invite link: <a style="word-break: break-all;" href="{{ env('GROUP_INVITE_LINK') }}" target="_blank">{{ env('GROUP_INVITE_LINK') }}</a></p>
        <p>Without this you won't be able to see messages you send.</p>
        <p><a class="btn btn-lg btn-success" href="/send" role="button"><i class="fa fa-envelope"></i> Start Messaging</a></p>
    </div>

    <div class="row marketing">
        <div class="col-lg-6">
            <h4>Telegram Bot</h4>
            <p>This project uses <a href="https://telegram-bot-sdk.readme.io/" target="_blank">Telegram Bot API PHP SDK</a>.
            After you submit the form, Laravel will contact Telegram API and send message to chat group via bot.
            </p>

            <h4>Telegram Group</h4>
            <p>Bot will send message to public Telegram group. There are other people there so be nice ;-)</p>

            <h4>Tutorial</h4>
            <p>This Live Demo is related to tutorial from <a href="https://tuts.codingo.me/using-telegram-messenger-for-laravel-application-notifications">Codingo Tuts</a>.</p>
        </div>

        <div class="col-lg-6">
            <h4>Laravel 5.3</h4>
            <p>Project uses latest Laravel release.</p>

            <h4>Code</h4>
            <p>You can find entire code in dedicated <a href="https://github.com/codingo-me/telegram-laravel">GitHub repository</a>.</p>

            <h4>Feedback</h4>
            <p>Tell us what you think about our tutorial/project, you can open new <a href="https://github.com/codingo-me/telegram-laravel/issues">issue</a> on GitHub or leave a <a href="https://tuts.codingo.me/using-telegram-messenger-for-laravel-application-notifications#disqus_thread">comment</a> under the tutorial.</p>

        </div>
    </div>

@stop