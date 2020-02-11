@component('mail::message')
Hello **{{$invitee}}**,  
You have recieved an invite from **{{$inviter}}** to join the company!

Click below to view the inviitation
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent

@endcomponent