<?php
include'header.php';
include'side.php';
include'config.php';
?>
<?php
$Name = "";
$Quantity = "";
$Date ="";
$Price ="";
$c = 0;
$price2 =0;
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST["Name"];
    $Quantity = $_POST["Quantity"];
    $Date = $_POST["Date"];
    $Price = $_POST["Price"];

    $result = mysqli_query($conn, "SELECT * FROM pharmacey.medicen WHERE Name = '$Name' AND QuantityAvailable > 0");

    $checkData = mysqli_num_rows($result);

    if ($checkData > 0) {
      $row=mysqli_fetch_array($result);
     $price2 = $row["Price"];
     $TotalPrice = $price2 * $Quantity;
        $sql = "UPDATE medicen SET QuantityAvailable = QuantityAvailable - $Quantity " . 
               "WHERE Name = '$Name' ";

        $result = $conn->query($sql);

        if (empty($Name) || empty($Quantity) || empty($Date)) {
            $errorMessage = "All the fields are required";
        } else {
            $sql = "INSERT INTO soldcollection (Name, Quantity, Date, Price) " . 
                   "VALUES('$Name', '$Quantity', '$Date',  ' $TotalPrice')";
            $result = $conn->query($sql);
    
            if (!$result) {
                $errorMessage = "Invalid query: " . $conn->error;
            } else {
                $Name = "";
                $Quantity = "";
                $Date = "";
                $Price = "";
                $c = 1;
                $successMessage = "Succefully Sold";
                // Redirect here if needed
                // header("location: /table.php");
                // exit;
            }
        }
    } else {
        $errorMessage = "Medicine not available";
    }
}
?>

      
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Export Table</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Expiredate</th>
                            <th>Manufacturer</th>
                            <th>Price</th>
                            <th>Entery_date</th>
                            <th>ID</th>
                            <th>QuantityAvailable</th>

                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result=mysqli_query($conn,"select * from pharmacey.medicen where QuantityAvailable > 0 ");
                            $chechData=mysqli_num_rows($result);
                            if($chechData>0){
                                $count=1;
                                while($row=mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td> <?php echo $row['Name']; ?></td>
                                        <td><?php echo $row['Expiredate']; ?></td>
                                        <td><?php echo $row['Manufacturer']; ?></td>
                                        <td><?php echo $row['Price']; ?></td>
                                        <td><?php echo $row['Entery_date'];?></td>
                                        <td><?php echo $row['ID'];?></td>
                                        <td><?php echo $row['QuantityAvailable'];?></td>

                                    </tr>
                                    <?php 
                                    $count=$count+1;                                   
                                }
                            }else{
                                echo "No DATA AVAILABLE";
                            }
                            ?>
                           
                        
                      
                        
                           
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="card">
                  <div class="card-header">
                    <h4>Sell Medicine</h4>
                    <br/>
                    <?php
if (!empty($successMessage)) {
    echo '<div class="alert alert-success">';
    echo $successMessage;
    echo '</div>';
}
if (!empty($errorMessage)) {
  echo '<div class="alert alert-danger">';
  echo $errorMessage;
  echo '</div>';
}
?>
                  </div>
                  <form method="post">
                  <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputEmail4">Name</label>
                        <input name="Name" type="text" class="form-control" id="inputEmail4" placeholder="Name">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword4">Quantity</label>
                        <input name="Quantity" type="number" class="form-control" id="inputPassword4" placeholder="Quantity">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputAddress">Date</label>
                      <input name="Date" type="Date" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                  
                
                    <!-- <div class="form-group">
                      <label for="inputAddress2">Price</label>
                      <input name="Price" type="number" class="form-control" id="inputAddress2"
                        placeholder="Price">
                    </div> -->
                   
                    <!-- <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input name="registrationDate" type="text" class="form-control" id="inputCity">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                          <option selected>Choose...</option>
                          <option>...</option>
                        </select>
                      </div> -->
                    
                    <!-- <div class="form-group mb-0">
                      <div class="form-check">
                        <input name="stat" class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                          Check me out
                        </label>
                      </div>
                    </div> -->
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    
                  </div>
</form>
                </div>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
<?php
include('footer.php');
?>
</body>


<!-- export-table.html  21 Nov 2019 03:56:01 GMT -->
</html>