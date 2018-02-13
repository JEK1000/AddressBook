<?php

include 'includes/head.php';
include 'functions/helpers.php';
require_once './system/connDB.php';

?>
<div class="container-fluid">
	<div class="main" >
		<div class="header">

		<!-- Button trigger modal -->
<button type="button" class="btn btn-default btn btn-xs add" data-toggle="modal" data-target="#Modal">
		<span class="glyphicon glyphicon-plus add"></span>
</button>

<!-- Modal Begin-->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Modal">Add New Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!--modal form -->
      <div class="modal-body">
<?php

	$errors = array();

//IF FORM IS SUBMITTED

if (isset($_POST['form_submit'])) {



	$number = $_POST['pnumber'];

	//VALIDATION

	if ($_POST['fname'] == '' || is_numeric($_POST['fname'])) {

		$errors[] .= 'Please enter a first name';

	}

	if ($_POST['lname'] == '' || is_numeric($_POST['fname'])) {

		$errors[] .= 'Please enter a last name';

	}

	if (!preg_match('/^\d{10}$/', $number)) {

		$errors[] .= 'Please enter a valid number';
	}

	//DISPLAY ERRORS

	if (!empty($errors)) {

		?>
		<Script>

						$('#Modal').modal('show');

						</Script>

		<?php

		echo display_errors($errors);

	} else {

		//INSERT INTO DATABASE

		$fname  = $_POST['fname'];
		$lname  = $_POST['lname'];
		$number = $_POST['pnumber'];

		$fname = ucfirst($fname);
		$lname = ucfirst($lname);

		$insertSql = "INSERT INTO `Contacts` (`first_name`,`last_name`,`pnumber`)
		VALUES ('$fname','$lname','$number')";

		$conn->query($insertSql);

	}

}

?>
<!-- FORM INPUT -->

	<form action="index.php" method="POST" id="formSub">
        First name: <input type="text" name="fname" id="fname"><br><br>
        Last name: <input type="text" name="lname" id="lname"><br><br>
        Number: <input type="text" name="pnumber" id="number"><br><br>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="submit" name="form_submit" value="Save Changes" class="btn btn-primary btn btn-sm">
	</form>
        </div>
      </div>
    </div>
  </div>
</div>
			<div class="text-left contact"><strong>Contacts<strong></div>
				<div class="col-lg-6">
   				 <div class="input-group">
      			<input type="text" class="form-control" placeholder="Search">
     		 <span class="input-group-btn">
      	 	<button class="btn btn-default glyphicon glyphicon-search searchBtn" type="button"></button>
     		</span>
		</div>
	</div>
</div>

<div class="contact-inner">
<?php

// DISPLAY CONTACTS

$sql = "SELECT first_name,last_name,pnumber FROM Contacts";
$result = $conn ->query($sql);

while ($print = mysqli_fetch_assoc($result)):?> 


<p><?=$print['first_name'];?> <?=$print['last_name']?><br><?=$print['pnumber']?></p>



<?php endwhile;?>
</div>

</div>



<?php
include 'includes/footer.php'
?>