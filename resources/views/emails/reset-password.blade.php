@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => $link])
Reset Your Password 
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
