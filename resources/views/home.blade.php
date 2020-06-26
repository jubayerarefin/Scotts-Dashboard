@extends('layouts.app')

@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function() {
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true
    });
});
</script>
@endsection

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <form method="POST">

            <div class="form-group">
                <div class="row" style="padding-top: 10px">
                    <label class="col-lg-5 control-label" for="Email">Email</label>
                    <div class="col">
                        <input class="form-control" type="text" name="Email" id="Email" placeholder="Email" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row" style="padding-top: 10px">
                    <label class="col-lg-5 control-label" for="from_date">From Date</label>
                    <div class="col">
                        <input class="form-control datepicker" data-date-format="mm/dd/yyyy" autocomplete="off"
                            name="from_date" id="datepicker_from" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row" style="padding-top: 10px">
                    <label class="col-lg-5 control-label" for="to_date">To Date</label>
                    <div class="col">
                        <input class="form-control datepicker" data-date-format="mm/dd/yyyy" autocomplete="off"
                            name="to_date" id="datepicker_to" />
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
        </form>
    </div>
</div> -->


@endsection