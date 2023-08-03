@component('mail::message')
# Task Completed Notification

Hello Admin,

The following task has been completed:

Task Title: {{ $task->title }}
Card: {{ $task->card->title }}

Thank you,
{{ config('app.name') }}
@endcomponent
