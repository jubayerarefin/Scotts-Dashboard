<div class="container">
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

    <div class="row">
        <div class="table-responsive">
            <form method="POST" id="convert_form" action="export.php">
                <div class="row">
                    <div class="col-lg-5">
                        <input type="hidden" name="file_content" id="file_content" />
                        <button type="button" name="convert" id="convert" class="btn btn-light">Export</button>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered display nowrap" style="width:100%"
                    id="table_content">
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
                            <th style="white-space: inherit">
                                Last Journal Update
                                (Time)
                            </th>
                            <th style="white-space: inherit">
                                Last Journal Update
                                (Date)
                            </th>
                            <th style="white-space: inherit">
                                Created At (User)
                            </th>
                            <th style="white-space: inherit">
                                Created At
                                (Organization)
                            </th>
                            <th>
                                Subscribed until
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

$host     = "scotts-production-cluster.cluster-cxj3twgkxszl.us-east-2.rds.amazonaws.com";
$port     = 3306;
$user     = "scott-viewer";
$password = "Kt98BnKXAaTh";
$dbname   = "scotts";

$con = new mysqli($host, $user, $password, $dbname, $port)
or die('Could not connect to the database server' . mysqli_connect_error());

if (isset($_POST['submit'])) {
    $Email     = $_POST['Email'];
    $from_date = $_POST['from_date'];
    $to_date   = $_POST['to_date'];
    $query     = "SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS
                        LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME(
                        o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE( o.LastJournalUpdateTimeUTC ) AS
                        LastJournalUpdateDate, DATE(u.CreatedAt) AS CreatedAtUser, DATE(o.CreatedAt) AS
                        CreatedAtOrganization, o.SubscribedUntil AS SubscribedUntil
                        FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON
                        o.OrganizationId = uo.OrganizationId";

    if ($Email != "" && $from_date === "" && $to_date === "") {
        $query .= " WHERE u.Email = '$Email' ORDER BY UserId ASC ";
    }

    if ($Email === "" && $from_date != "" && $to_date != "") {
        $query .= " WHERE o.CreatedAt >= '$from_date' AND o.CreatedAt <= '$to_date' ";
    }

    if ($Email != "" && $from_date != "" && $to_date != "") {
        $query .= " WHERE u.Email='$Email' AND o.CreatedAt>= '$from_date' AND o.CreatedAt <= '$to_date' ";
    }

    $data = mysqli_query($con, $query) or die('error');
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $UserId                = $row['UserId'];
            $Email                 = $row['Email'];
            $FirstName             = $row['FirstName'];
            $LastName              = $row['LastName'];
            $OrganizationName      = $row['OrganizationName'];
            $ScottsOrgId           = $row['ScottsOrgId'];
            $LastJournalUpdateTime = $row['LastJournalUpdateTime'];
            $LastJournalUpdateDate = $row['LastJournalUpdateDate'];
            $CreatedAtUser         = $row['CreatedAtUser'];
            $CreatedAtOrganization = $row['CreatedAtOrganization'];
            $SubscribedUntil       = $row['SubscribedUntil'];

            ?>
                        <tr>
                            <td>
                                <?php echo $UserId; ?>
                            </td>
                            <td>
                                <?php echo $Email; ?>
                            </td>
                            <td>
                                <?php echo $FirstName; ?>
                            </td>
                            <td>
                                <?php echo $LastName; ?>
                            </td>
                            <td style=" white-space: inherit">
                                <?php echo $OrganizationName; ?>
                            </td>
                            <td>
                                <?php echo $ScottsOrgId; ?>
                            </td>
                            <td>
                                <?php echo $LastJournalUpdateTime; ?>
                            </td>
                            <td>
                                <?php echo $LastJournalUpdateDate; ?>
                            </td>
                            <td>
                                <?php echo $CreatedAtUser; ?>
                            </td>
                            <td>
                                <?php echo $CreatedAtOrganization; ?>
                            </td>
                            <td>
                                <?php echo $SubscribedUntil; ?>
                            </td>
                        </tr>
                        <?php
}
    } else {
        ?>
                        <tr>
                            <td colspan="11" style="width:100%; text-align:center">No Records Found</td>
                        </tr>
                        <?php
}
}
?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>