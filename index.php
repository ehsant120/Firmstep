<?php
require 'dirset.php';
include $strRootP.'\include\page-top.php';

include 'index.core.php';

include $strRootP.'include\head.php';
?>
</head>

<?php include $strRootP.'template\content-before.php';?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h4>New Customer</h4></div>
        <div class="panel-body">
            <form id="frmCustomer" method="post">
                <div id="divForm" class="row-fluid">
                    <div id="divServices" class="col-md-6">
                        <?php
                        $resultServices = getServicesList();
                        foreach($resultServices as $row)
                            echo '<div class="radio"><label for="rdbtnService'.$row['srv_id'].'"><input type="radio" id="rdbtnService'.$row['srv_id'].'" name="rdbtnService" value="'.$row['srv_id'].'">'.$row['srv_name'].'</label></input></div>';
                        ?>
                        <div id="divServicesError" class="error" hidden>Please select the service</div>
                    </div>

                    <div id="divCustomer" class="col-md-6">
                        <div id="tab" class="btn-group" data-toggle="buttons">
                            <?php
                            $string = '';
                            foreach ($arrCustomerType as $key => $value)
                                $string .= '<a href="#div'.$key.'" class="btn btn-primary" data-toggle="tab"><input type="radio" name="rdbtnType" value="'.$value.'">'.$key.'</a>';
                            echo $string;
                            ?>
                            <div id="divCustomerTypeError" class="error" hidden>Please select the customer type</div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade" id="divCitizen">
                                <div class="form-group col-sm-12">
                                    <label class="control-label col-sm-2" for="cmbTitle">Title:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="cmbTitle" name="cmbTitle">
                                            <option value="-">Please select one</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Ms.">Ms.</option>
                                        </select>
                                        <div id="divTitleError" class="error" hidden>Please select the title</div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-sm-12">
                                    <label class="control-label col-sm-2" for="txtFirstname">Firstname: </label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="txtFirstname" name="txtFirstname" placeholder="Customer's firstname">
                                        <div id="divFirstnameError" class="error" hidden>Please enter the firstname</div>
                                    </div>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label class="control-label col-sm-2" for="txtLastname">Lastname: </label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="txtLastname" name="txtLastname" placeholder="Customer's lastname">
                                        <div id="divLastnameError" class="error" hidden>Please enter the lastname</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="divOrganisation">

                                <div class="form-group col-sm-12">
                                    <label class="control-label col-sm-4" for="txtOrganisationName">Organisation name: </label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="txtOrganisationName" name="txtOrganisationName" placeholder="Organisation name">
                                        <div id="divOrganisationNameError" class="error" hidden>Please enter the organisation name</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="divAnonymous"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h4>Queue</h4></div>
        <div class="panel-body">

            <div id="divQueue">
                <?php
                $resultQueue = getQueueList();
                $string = '<table class="table table-striped table-hover" id="tblQueue">';
                $string .= '<thead class="thead-inverse">';
                $string .= '<tr>';
                $string .= '<th>#</th>';
                $string .= '<th>Type</th>';
                $string .= '<th>Name</th>';
                $string .= '<th>Service</th>';
                $string .= '<th>Queued at</th>';
                $string .= '</tr>';
                $string .= '</thead>';
                $string .= '<tbody>';
                if($resultQueue){
                    $iCnt = 1;
                    foreach($resultQueue as $row){
                        $customerType = array_search($row['qu_type'], $arrCustomerType);
                        $serviceName = $row['srv_name'];
                        $queueTime = date('H:i', strtotime($row['qu_time']));
                        $name = $row['qu_name'];

                        $string .= '<tr>';
                        $string .= '<th>'.$iCnt.'</th>';
                        $string .= '<th>'.$customerType.'</th>';
                        $string .= '<th>'.$name.'</th>';
                        $string .= '<th>'.$serviceName.'</th>';
                        $string .= '<th>'.$queueTime.'</th>';
                        $string .= '</tr>';

                        $iCnt++;
                    }
                }
                else
                    $string .= '<tr id="trNoRecord"><td colspan="5"><div class="alert alert-danger text-center">No records found.</div></td></tr>';
                $string .= '</tbody>';
                $string .= '</table>';
                echo $string;
                ?>
            </div>
        </div>
    </div>
</div>
<div id="divMessage">Record created successfully</div>

<?php include $strRootP.'template\content-after.php';?>