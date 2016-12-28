@include('partials.header')
<form action="/backoffice-login" method="post">
    <div class="row top-buffer">
            <div class="row col-md-6 col-md-offset-3 top-buffer fill-row">
                <h1><span class="label label-danger">Password</span> : <input type="password" placeholder=  "รหัส" name="password" value="" autofocus="autofocus" required></h1>
            </div>
        <div class="col-md-4 col-md-offset-4 top-buffer">
            <button type="submit" class="btn btn-lg btn-primary" value="submit">บันทึก!</button>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form> 
@include('partials.footer')