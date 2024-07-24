<?php
include'header.php';
include'side.php';
include'config.php';
?>
<?php
$Name = "";
$Expiredate = "";
$Manufacturer ="";
$Price ="";
$Entery_date ="";
$ID ="";
$QuantityAvailable = "";
$c = 0;
$errorMessage = "";
$successMessage = "";
if( $_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    $Name = $_POST["Name"];
    $Expiredate =  $_POST["Expiredate"];
    $Manufacturer =  $_POST["Manufacturer"];
    $Price =  $_POST["Price"];
    $Entery_date =  $_POST["Entery_date"];
    $ID =  $_POST["ID"];
    $QuantityAvailable =  $_POST["QuantityAvailable"];

  do{
    if(empty($Name) || empty($Expiredate) || empty($Manufacturer) || empty($Price) || empty($Entery_date) || empty($ID)|| empty($QuantityAvailable)){
        $errorMessage = "All the fields are requried";
        break;
    }
    $sql = "INSERT INTO medicen (Name, Expiredate ,Manufacturer, Price, Entery_date, ID, QuantityAvailable)" . 
           " VALUES('$Name', '$Expiredate', '$Manufacturer', '$Price', '$Entery_date', '$ID', '$QuantityAvailable')";
           $result = $conn->query($sql);

           if(!$result)
           {
            $errorMessage ="Invalid query :"  .$conn->error;
            break;
           }
           
           $Name = "";
           $Expiredate = "";
           $Manufacturer ="";
           $Price ="";
           $Entery_date ="";
           $ID ="";
           $QuantityAvailable = "";
$c = 1;
$successMessage = "Info is added";
break;
exit;
  }while(false);


}
if($c==1)
{
  header("location: /table.php");

}

?>


      <!-- Main Content -->
      <div class="main-content">
       <div class="card">
                  <div class="card-header">
                    <h4>Register Medicine</h4>
                    <br/>
                    <br/>
                
                    
                  <div>  <?php
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

                  </div>
                  <form method="post">
                  <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputEmail4">Name</label>
                        <input name="Name" type="text" class="form-control" id="inputEmail4" placeholder="Name">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword4">Expiredate</label>
                        <input name="Expiredate" type="Date" class="form-control" id="inputPassword4" placeholder="Expiredate">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputAddress">Manufacturer</label>
                      <input name="Manufacturer" type="text" class="form-control" id="inputAddress" placeholder="Manufacturer">
                    </div>
                    <div class="form-group">
                      <label for="inputAddress">ID</label>
                      <input name="ID" type="text" class="form-control" id="inputAddress" placeholder="ID">
                    </div>
                    <div class="form-group">
                      <label for="inputAddress">QuantityAvailable</label>
                      <input name="QuantityAvailable" type="number" class="form-control" id="inputAddress" placeholder="QuantityAvailable">
                    </div>
                    <div class="form-group">
                      <label for="inputAddress2">Price</label>
                      <input name="Price" type="number" class="form-control" id="inputAddress2"
                        placeholder="Price">
                    </div>
                    <div class="form-group">
                      <label for="inputAddress2">Entery_date</label>
                      <input name="Entery_date" type="Date" class="form-control" id="inputAddress2"
                        placeholder="Entery_date">
                    </div>
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
                      <!-- <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                      </div>
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
        <!-- <section class="section">
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
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                          </tr>
                        </thead>
                        <tbody>
                           
                           
                        
                      
                        
                           
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </section>
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