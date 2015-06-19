<?php require_once 'templates/_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Advanced Internet Development | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
</head>

<body>
<?php require_once 'templates/_topNav.php';?>
<div class="container-fluid">
	<div class="row">
 <?php require_once 'templates/_leftnav.php'; ?>  
    <div class="col-md-9">

<div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Database CRUD</h3>
                </div>
                <div class="panel-body">
          
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Display Data
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
     <?php 
     //string to create a table
     $tableCreate = "CREATE TABLE Members (    id int(11) NOT NULL auto_increment,
  			email varchar(255) NOT NULL,
  			password varchar(255) NOT NULL,
	  		PRIMARY KEY (id)
	    )";
     // Drop the table (as we manipulate this data we wish to recreate)
     $query_str = "DROP TABLE IF EXISTS Members CASCADE ";
     $db -> query($query_str);
     
     /* 2.CREATE A TABLE AND INSERT DATA */
     if ($db -> query($tableCreate) === TRUE) {
     	print "<h2>Display Data </h2>";
     	print " Table  'Members' successfully created.";
     }
     $query_str = "INSERT INTO `Members` VALUES (1, 'tony@leedsmet.ac.uk','itechytony') ";
     $db -> query($query_str);
     $query_str = "INSERT INTO `Members` VALUES (2, 'tellisa@hotmail.com','sherida') ";
     $db -> query($query_str);
     $query_str = "INSERT INTO `Members` VALUES (3, 'david@gmail.ac.uk','rehana')";
     $db -> query($query_str);
     
     /* 3. GET RESULTS FROM QUERY AND DISPLAY DATA */
     $result = $db->query("SELECT * FROM Members");
     print " Query returned ". $result->rowCount() . " rows ";
     
     
     
     //The function to display data is below
     displayData($result);
     
     ?>
     </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Update data
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
     <?php 
     
     /* 4. UPDATE DATA (set all passwords to secret) AND DISPLAY */
     $db->query("UPDATE Members SET password='secret'");
     print "Changing Password to 'Secret'; - Affected rows (UPDATE): = ";
     print $result->rowCount();
     $result = $db->query("SELECT * FROM Members");
     displayData($result);
     ?>
     
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Delete data
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
      <?php 
      
      /* 5. DELETE  DATA (delete green) AND DISPLAY */
      $db->query("DELETE FROM Members WHERE email = 'green@leedsmet.ac.uk'");
      print "Deleting row with email = tony@leedsmet.ac.uk";
      $result = $db->query("SELECT * FROM Members");
      displayData($result);
      
      ?>
      
      </div>
    </div>
  </div>
</div>      
                
    <?php             

	//The function to display the data	
	  function displayData($result){
		print '<table class="table table-striped" >'; 
  			while ($row = $result->fetch(PDO::FETCH_ASSOC)){
  				print "  <tr>"; 
				print "    <td>" . $row["id"] . "</td>"; 
  				print "    <td>" . $row["email"] . "</td>"; 
  				print "    <td>" . $row["password"] . "</td>"; 
  				print "  </tr>"; 
  			} 
  		print "</table>"; 
       }//end of display function
    ?>

    
                </div>
              </div>
		</div>
		<!-- end of col-md-9 -->
	</div>
	<!-- end of row -->
</div>
<!-- end of container fluid -->
<?php require_once 'templates/_footer.php'; ?>

</body>
</html>