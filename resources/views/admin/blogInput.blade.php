@extends('layouts.app')
@section('content')
<script>
    setActive("blogs");
</script>
<div class="container center">
    <div id="contact" class="col-md-6">
        @if(session()->has('message'))
            <div class="alert alert-primary">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <form action="/blogsadmin/save" method="post" enctype="multipart/form-data">
            @csrf
            <br>
            <h2 class="h2">Blog opslaan / Email versturen</h2>
            <input type="hidden" name="blogId" id="blogId" value="{{ $blog->id ?? null }}">
            <div class="form-group">
                <label for="voornaam">Naam*</label>
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $blog->name ?? old('name') }}" id="name" name="name" placeholder="Naam...">
            </div><br>

            Bovenaan het mailtje komt standaard dit te staan: <br> <br>

            Beste {naam}, <br> <br>

            <div class="form-group">
                <label for="description">description</label>
                <textarea class="form-control wrap{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" placeholder="description...">{{ $blog->description ?? old('description') }}</textarea>
            </div><br>

            Onderaan het mailtje komt standaard dit te staan: <br> <br>
            <div class="mb-3">
                <label for="file" class="form-label">Upload foto (optioneel)</label>
                <input class="form-control" type="file" name="file" id="file">
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="addPaymentLink" role="switch" id="addPaymentLink">
                <label class="form-check-label" for="addPaymentLink">Betalingslink toevoegen</label>
            </div> <br>

            Met vriendelijke groet,<br>
            De reiscommissie van Salve Mundi <br> <br>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="addBlog" role="switch" id="addBlog">
                <label class="form-check-label" for="addBlog">Blog toevoegen</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sendEmail" role="switch" id="sendEmail">
                <label class="form-check-label" for="sendEmail">Emails verzenden</label>
            </div> <br>

            <label for="content">Indien er mails worden verzonden, dan worden deze verzonden naar:</label>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="NotVerified" role="switch" id="NotVerified">
                <label class="form-check-label" for="NotVerified">Deelnemers die hun email <b>niet</b> geverifieerd hebben</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="Verified" role="switch" id="Verified">
                <label class="form-check-label" for="Verified">Deelnemers die hun email geverifieerd hebben</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="UnPaid" role="switch" id="UnPaid">
                <label class="form-check-label" for="UnPaid">Deelenemers die <b>niet</b> betaald hebben</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="Paid" role="switch" id="Paid">
                <label class="form-check-label" for="Paid">Deelenemers die betaald hebben</label>
            </div>

            <div class="form-group mb-5">
                <br>
                <input class="btn btn-primary" type="submit" value="Opslaan">
            </div>
        </form>
    </div>
</div>

<script>
    $('#addPaymentLink').click(function () {
        $("#Paid").prop("checked", false);
        if (this.checked) {
            $("#Paid").attr("disabled", true);
        } else {
            $("#Paid").removeAttr("disabled");
        }
    });
</script>
@endsection
