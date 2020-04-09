@if(session('success'))


<div class="alert alert-success">

</div>
@endif
@if(session('registered'))


<div class="alert alert-success">


    @lang('auth.registeration succcessful')
</div>
@endif
@if(session('failed'))

<div class="alert alert-danger">


</div>

@endif 
@if(session('wrongCredentials'))

<div class="alert alert-danger">

@lang('auth.user or password was wrong')
</div>
@endif 

@if(session('emailHasVerified'))


<div class="alert alert-success">

   @lang('auth.email has verified') 
</div>

@endif

@if(session('resetLinkSent'))


<div class="alert alert-success">

   @lang('auth.rest link sent') 
</div>

@endif
@if(session('resetLinkFailed'))


<div class="alert alert-danger">

   @lang('auth.reset link failed') 
</div>

@endif

