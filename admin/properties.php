<?php
session_start();
require_once './config/config.php';
//require_once 'includes/auth_validate.php';

//Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

//Get current page.
$page = filter_input(INPUT_GET, 'page');

//Per page limit for pagination.
$pagelimit = 20;

if (!$page) {
    $page = 1;
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'first_name', 'last_name', 'mobile', 'email','profession','current_address','country','house_type','flat','colony','landmark','location','contact','rent','date', 'verify');

//Start building query according to input parameters.
// If search string
if ($search_string) 
{
    $db->where('first_name', '%' . $search_string . '%', 'like');
    $db->orwhere('last_name', '%' . $search_string . '%', 'like');
}

//If order by option selected
if ($order_by)
{
    $db->orderBy($filter_col, $order_by);
}

//Set pagination limit
$db->pageLimit = $pagelimit;

//Get result of the query.
$customers = $db->arraybuilder()->paginate("houses", $page, $select);
$total_pages = $db->totalPages;

// get columns for order filter
foreach ($customers as $value) {
    foreach ($value as $col_name => $col_value) {
        $filter_options[$col_name] = $col_name;
    }
    //execute only once
    break;
}
include_once 'includes/header.php';
?>
 <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!--Main container start-->
<div id="page-wrapper">
    <div class="row">

        <div class="col-lg-6">
            <h1 class="page-header">Properties Uploaded</h1>
        </div>
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <!--    Begin filter section-->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo htmlspecialchars($search_string, ENT_QUOTES, 'UTF-8'); ?>">
            <label for ="input_order">Order By</label>
            <select name="filter_col" class="form-control">

                <?php
                foreach ($filter_options as $option) {
                    ($filter_col === $option) ? $selected = "selected" : $selected = "";
                    echo ' <option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                }
                ?>

            </select>

            <select name="order_by" class="form-control" id="input_order">

                <option value="Asc" <?php
                if ($order_by == 'Asc') {
                    echo "selected";
                }
                ?> >Asc</option>
                <option value="Desc" <?php
                if ($order_by == 'Desc') {
                    echo "selected";
                }
                ?>>Desc</option>
            </select>
            <input type="submit" value="Go" class="btn btn-primary">

        </form>
    </div>
<!--   Filter section end-->

    <hr>


    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Profession</th>
                <th>House Type</th>
                <th>Local Address</th>
                <th>Colony</th>
                <th>Landmark</th>
                <th>City Location</th>
                <th>Contact</th>
                <th>Rent</th>
                <th>Available From</th>
                <th>Verification Status</th>
                <th>Verify</th>
                <th>Discard</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $row) : ?>
                <tr>
	                <td><?php echo $row['id'] ?></td>
	                <td><?php echo htmlspecialchars($row['first_name']." ".$row['last_name']); ?></td>
	                <td><?php echo htmlspecialchars($row['email']) ?></td>
	                <td><?php echo htmlspecialchars($row['current_address']) ?> </td>
                    <td><?php echo htmlspecialchars($row['mobile']) ?> </td>
                    <td><?php echo htmlspecialchars($row['profession']) ?> </td>
                    <td><?php echo htmlspecialchars($row['house_type']) ?> </td>
                    <td><?php echo htmlspecialchars($row['flat']) ?> </td>
                    <td><?php echo htmlspecialchars($row['colony']) ?> </td>
                    <td><?php echo htmlspecialchars($row['landmark']) ?> </td>
                    <td><?php echo htmlspecialchars($row['location']) ?> </td>
                    <td><?php echo htmlspecialchars($row['contact']) ?> </td>
                    <td><?php echo htmlspecialchars($row['rent']) ?> </td>
                    <td><?php echo htmlspecialchars($row['date']) ?> </td>
                     <td><?php echo htmlspecialchars($row['verify']) ?> </td>
                    <td>
                        <?php
                        $house_id=$row['id'];
                        $house="verifyhouse.php?id=$house_id";

                         ?>
                    <a href="verifyhouse.php?id=<?php echo $row["id"];?>" class="btn btn-primary" data-toggle="modal"  style="margin-right: 8px;">Verify <span class="fa fa-check" aria-hidden="true"></span>
                    </a>
                </td>
                <td>

                    <a href=""  class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id'] ?>" style="margin-right: 8px;">Delete <span class="fa fa-trash-o"></span></td>
				</tr>
                         <!-- Delete Confirmation Modal-->
                     <div class="modal fade" id="confirm-delete-<?php echo $row['id'] ?>" role="dialog">
                        <div class="modal-dialog">
                          <form action="deletehouse.php" method="POST">
                          <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Confirm</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="del_id" id = "del_id" value="<?php echo $row['id'] ?>">
                                    <p>Are you sure you want to delete this property?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-default pull-left">Yes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                              </div>
                          </form>
                          
                        </div>
                    </div>
                        <!-- verify Confirmation Modal-->
                     <div class="modal fade" id="confirm-verify-<?php echo $row['id'] ?>" role="dialog">
                        <div class="modal-dialog">
                          <form action="verifyhouse.php" method="POST">
                          <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Confirm</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="verify" id = "verify" value="verified">
                                    <p>Are you sure you want to verify this property?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-default pull-left">Yes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                              </div>
                          </form>
                          
                        </div>
                    </div>
            <?php endforeach; ?>      
        </tbody>
    </table>
   
<!--    Pagination links-->
    <div class="text-center">

        <?php
        if (!empty($_GET)) {
            //we must unset $_GET[page] if previously built by http_build_query function
            unset($_GET['page']);
            //to keep the query sting parameters intact while navigating to next/prev page,
            $http_query = "?" . http_build_query($_GET);
        } else {
            $http_query = "?";
        }
        //Show pagination links
        if ($total_pages > 1) {
            echo '<ul class="pagination text-center">';
            for ($i = 1; $i <= $total_pages; $i++) {
                ($page == $i) ? $li_class = ' class="active"' : $li_class = "";
                echo '<li' . $li_class . '><a href="properties.php' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul></div>';
        }
        ?>
    </div>
    <!--    Pagination links end-->

</div>
<!--Main container end-->


<?php include_once './includes/footer.php'; ?>

