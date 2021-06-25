@extends('layouts.main')
@section('title', 'Contact')
@section('content')
<div class="row">
    <div class="col-12">
        <h2>Contact</h2>
    </div>
    <div class="col-12">
        <form class="row" method="POST" action="{{ route('sendmessage') }}">
            @csrf
            <div class="mb-3">
                <label for="message-name" class="form-label">Name</label>
                <input type="text" name="message[name]" class="form-control" id="message-name" aria-describedby="nameHelp" value="" >
            </div>
            <div class="mb-3">
                <label for="message-email" class="form-label">Email</label>
                <input type="email" name="message[email]" class="form-control" id="message-email" aria-describedby="emailHelp" value="" >
            </div>
            <div class="mb-3">
                <label for="message-subject" class="form-label">Subject</label>
                <input type="text" name="message[subject]" class="form-control" id="message-subject" aria-describedby="subjectHelp" value="" >
            </div>
            <div class="mb-3">
                <label for="messsage-content" class="form-label">Message</label>
                <textarea name="message[content]" rows=10 class="form-control" id="message-content" aria-describedby="contentHelp"></textarea>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <input type="submit" class="btn btn-primary" id="submit" value="Send Message" >
            </div>
        </form>
    </div>
</div>
@endsection