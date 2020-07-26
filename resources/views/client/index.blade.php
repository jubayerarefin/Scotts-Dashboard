<!DOCTYPE html>
<html>

<head>
    <title>Customer Dashboard (Scott's Add-Ins)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
</head>


<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Customer Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <!-- @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif -->
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!--  -->
    <!--  -->
    <!--  -->
    <!-- Start of Content -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <div class="container">
        <div class="row">
            <h4>Organization - Created Date Range Search</h4>
        </div>
        <div class="row" style="margin-top: 25px; display: flex">
            <div class="col-row" style="display: flex">
                <div class="col-md-4 input-daterange">
                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"
                        autocomplete="off" />
                </div>
                <div class="col-md-4 input-daterange">
                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"
                        autocomplete="off" />
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="subscribedBox">
                    <label class="form-check-label" for="defaultCheck1">
                        Subscribed only
                    </label>
                </div>
            </div>
            <div class="col">
                <button type="button" name="filter" id="filter" class="btn btn-primary">Search date range</button>
                <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Refresh</button>
            </div>
        </div>
        <div class="row" style="margin-bottom: 25px">
            <div class="table-responsive" style="overflow-x:scroll; overflow-y: scroll">
                <table class="table table-striped table-hover table-bordered display nowrap data-table"
                    style="width:100%" id="table_content">
                    <thead>
                        <tr>
                            <th data-class-name="priority">
                                User ID
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                First Name
                            </th>
                            <th>
                                Last Name
                            </th>
                            <th>
                                Organization Name
                            </th>
                            <th>
                                Scott's Org ID
                            </th>
                            <th style="min-width: 100px">
                                Last Journal Update
                                (Time)
                            </th>
                            <th style="min-width: 100px">
                                Last Journal Update
                                (Date)
                            </th>
                            <th style="min-width: 100px">
                                Created At (User)
                            </th>
                            <th style="min-width: 100px">
                                Created At
                                (Organization)
                            </th>
                            <th>
                                Subscribed until
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<script>
$(document).ready(function() {
    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: 'mm-dd-yyyy',
        autoclose: true
    });

    $('input[type="checkbox"]').click(function() {
        if ($(this).prop("checked") == true) {
            console.log("Checkbox is checked.");
        } else if ($(this).prop("checked") == false) {
            console.log("Checkbox is unchecked.");
        }
    });

    $('#convert').click(function() {
        var table_content = '<table>';
        table_content += $('#table_content').html();
        table_content += '</table>';
        $('#file_content').val(table_content);
        $('#convert_form').submit();
    });

    load_data();

    function load_data(from_date = null, to_date = null, subscribedBox = null) {
        $('.data-table').DataTable({
            processing: false,
            serverSide: false,
            lengthMenu: [
                [100, 250, 500, -1],
                [100, 250, 500, "All"]
            ],
            dom: 'Bfrtip',
            buttons: [
                'pageLength',
                'csv',
            ],
            stateSave: true,
            ajax: {
                url: '{{ route("clients.index") }}',
                method: "GET",
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    subscribedBox: subscribedBox
                }
            },
            "columns": [{
                    "data": 'UserId',
                    "name": 'UserId'
                },
                {
                    "data": 'Email',
                    "name": 'Email'
                },
                {
                    "data": 'FirstName',
                    "name": 'FirstName'
                },
                {
                    "data": 'LastName',
                    "name": 'LastName'
                },
                {
                    "data": 'OrganizationName',
                    "name": 'OrganizationName'
                },
                {
                    "data": 'ScottsOrgId',
                    "name": 'ScottsOrgId'
                },
                {
                    "data": 'LastJournalUpdateTime',
                    "name": 'LastJournalUpdateTime'
                },
                {
                    "data": 'LastJournalUpdateDate',
                    "name": 'LastJournalUpdateDate'
                },
                {
                    "data": 'CreatedAtUser',
                    "name": 'CreatedAtUser'
                },
                {
                    "data": 'CreatedAtOrganization',
                    "name": 'CreatedAtOrganization'
                },
                {
                    "data": 'SubscribedUntil',
                    "name": 'SubscribedUntil'
                },
            ]
        });
    }

    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var subscribedBox = false
        // if ($('input:checkbox').prop('checked')) == true {
        //     var subscribedBox = true
        // };
        if (from_date != '' && to_date != '') {
            $('.data-table').DataTable().destroy();
            load_data(from_date, to_date, subscribedBox);
            alert('refreshed!')
        } else {
            alert('Both Dates are required');
        };
    });

    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        $('input:checkbox').prop('checked', false);
        $('.data-table').DataTable().destroy();
        load_data();
    });
})
</script>