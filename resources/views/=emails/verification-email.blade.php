@component('mail::message')
# Introduction

Dear {{$name}}

@component('mail::button', ['url' => $link,'url'=>'auth.email.verify'])


verify your email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
