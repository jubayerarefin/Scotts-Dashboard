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
                    <label class="form-check-label" id="subscribedBox" for="defaultCheck1">
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
            <div class="table-responsive" style="">
                <table class="table table-striped table-hover table-bordered display nowrap data-table"
                    style="width:100%" id="table_content">
                    <thead>
                        <tr>
                            <th class="text-center" data-class-name="priority">
                                User ID
                            </th>
                            <th class="text-center">
                                Email
                            </th>
                            <th class="text-center">
                                First Name
                            </th>
                            <th class="text-center">
                                Last Name
                            </th>
                            <th class="text-center">
                                Organization Name
                            </th>
                            <th class="text-center">
                                Scott's Org ID
                            </th>
                            <th class="text-center">
                                Last Journal Update
                                (Time)
                            </th>
                            <th class="text-center">
                                Last Journal Update
                                (Date)
                            </th>
                            <th class="text-center">
                                Created At (User)
                            </th>
                            <th class="text-center">
                                Created At
                                (Organization)
                            </th>
                            <th class="text-center">
                                Subscribed Until
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
    var subscribedBox = false

    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: 'mm-dd-yyyy',
        autoclose: true
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
        var table = $('.data-table').DataTable({
            processing: false,
            serverSide: false,
            lengthMenu: [
                [10, 25, 50, 100, 250, 500, -1],
                [10, 25, 50, 100, 250, 500, "All"]
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
            scrollY: 500, //DT Height in Pixels
            scrollX: true,
            scrollCollapse: true,
            scroller: {
                rowHeight: "50px" //Default Height
            },
            columnDefs: [
                { width: "50px", targets: 0, class: "text-center" },
                { width: "250px", targets: 1, class: "word-wrap",
                    render : function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return `<div style="width:250px"> ${data.slice(0,27)} <br> ${data.slice(28,data.length)} </div>`;
                        }
                        return data;
                    }
                },
                { width: "60px", targets: 2, class: "text-center" },
                { width: "60px", targets: 3, class: "text-center" },
                { width: "100px", targets: 4, class: "",
                    render : function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return `<div style="width:250px"> ${data.slice(0,27)} <br> ${data.slice(28,55)} <br> ${data.slice(56,data.length)} </div>`;
                        }
                        return data;
                    }
                },
                { width: "60px", targets: 5, class: "text-center" },
                { width: "80px", targets: 6, class: "text-center" },
                { width: "80px", targets: 7, class: "text-center" },
                { width: "80px", targets: 8, class: "text-center" },
                { width: "80px", targets: 9, class: "text-center" },
                { width: "80px", targets: 10, class: "text-center",
                    createdCell: function (td, cellData, rowData, row, col) {
                        if ( cellData === null ) {
                            $(td).addClass('not-subscribed');
                        }
                    }
                }
            ],
            fixedColumns: {},
            autoWidth: true,
            deferRender: true,
            columns: [
                {
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
            ],
            createdRow: function(row, data, dataIndex) {                
                if (data.SubscribedUntil === null) {
                    $(row).addClass('text-danger');
                }
                
                // var api = this.api();
                // var longest = api.rows({page:'ALL'}).column(1).data().sort().reverse()[0];
                // console.log(longest);
            },
            rowCallback: function(row, data) {
                $('td:eq(0)', row).html(parseInt(data.UserId));
                $('td:eq(5)', row).html(parseInt(data.ScottsOrgId));
            },
            preDrawCallback: function(settings) {
                // $('#example tbody').off( 'click', 'td' );
            },
            drawCallback: function(settings) {
                // var api = this.api();        
                // Output the data for the visible rows to the browser's console
                // console.log( api.rows( {page:'current'} ).data() );
            }
        });
        table.column('0:visible').order('asc').draw();
        table.columns.adjust().draw();
    }

    $('.data-table').on( 'column-sizing.dt', function ( e, settings ) {
        // console.log( 'Column width recalculated in table' );
    });

    $('#subscribedBox').click(function() {
        if (this.checked === true) {
            $('.data-table').DataTable().rows('.text-danger').remove().draw();
        }else{
            $('.data-table').DataTable().destroy();
            load_data();
        }
    });

    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var subscribed_box = false;
        if (from_date != '' && to_date != '') {
            if (document.getElementById('subscribedBox').checked) {
                subscribed_box = true;
            }
            $('.data-table').DataTable().destroy();
            load_data(from_date, to_date, subscribed_box);
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
});
</script>