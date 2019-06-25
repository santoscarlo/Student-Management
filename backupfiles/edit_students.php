<?php
session_start();
	require_once('dbconnect.php');
	include ('nav.php');
	$upload_image = 'uploads/';

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "select * from studenttable where id=".$id;
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
		}else{
			$errorMsg = 'Data could not get.';
		}
	}

	if(isset($_POST['btnUpdate'])){
		
		$StudID = $_POST['StudID'];
		$RFIDStudNo = $_POST['RFIDStudNo'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$Gender = $_POST['Gender'];
		$contactnum  = $_POST['contactnum'];
		$section = $_POST['section'];
		$statusofstud = $_POST['statusofstud'];
		$yearlevel = $_POST['yearlevel'];
		$course = $_POST['course'];
		$parentcontactnum = $_POST['parentcontactnum'];
// FOR IMAGE

		$imgName = $_FILES['myfile']['name'];
		$imgTmp = $_FILES['myfile']['tmp_name'];
		$imgSize = $_FILES['myfile']['size'];

        if(empty($RFIDStudNo)){
            $errorMsg = 'Please input RFID No.';
        }elseif(empty($StudID)){
            $errorMsg = 'Please input StudID.';
        }elseif(empty($firstname)){
            $errorMsg = 'Please input firstname.';
        }elseif(empty($middlename)){
            $errorMsg = 'Please input middlename.';
        }elseif(empty($lastname)){
            $errorMsg = 'Please input lastname';
        }elseif(empty($Gender)){
            $errorMsg = 'Please select specific Gender.';
        }elseif(empty($section)){
            $errorMsg = 'Please select section.';
        }elseif(empty($course)){
            $errorMsg = 'Please select course.';
		}

		//udate image if user select new image
		if($imgName){
			//get image extension
			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
			//allow extenstion
			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');
			//random new name for photo
			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;
			//check a valid image
			if(in_array($imgExt, $allowExt)){
				//check image size less than 5MB
				if($imgSize < 5000000){
					//delete old image
					unlink($upload_image.$row['studimg']);
					move_uploaded_file($imgTmp ,$upload_image.$userPic);
				}else{
					$errorMsg = '<span class="glyphicon glyphicon-remove"><strong>Image too large. Please select photo below 5mb.</strong>';
				}
			}else{
				$errorMsg = '<span class="glyphicon glyphicon-remove"><strong>Please select a valid image</strong>';
			}
		}else{
			//if not select new image - use old image name
			$userPic = $row['studimg'];
		}


// NOT SURE FOR VALIDATION OF UPDATE
      //   $sql = mysqli_query($conn, "SELECT * from studenttable WHERE id = '$StudID' OR firstname = '$lastname' AND lastname= '$lastname'");
      // if (mysqli_num_rows($sql) > 0) {
      //    $errorMsg =  'Same record already exist!';
      //   }

		//check upload file not error than insert data to database
		if(!isset($errorMsg)){
			$sql = "update studenttable
				set StudID = '".$StudID."',
				RFIDStudNo = '".$RFIDStudNo."',
				firstname = '".$firstname."',
				middlename = '".$middlename."',
				lastname = '".$lastname."',
				contactnum = '".$contactnum."',
				statusofstud = '".$statusofstud."',
				yearlevel = '".$yearlevel."',
				course = '".$course."',
				parentcontactnum = '".$parentcontactnum."',
				section = '".$section."',
				Gender = '".$Gender."',
				studimg = '".$userPic."'
				where id=".$id;

			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = '<span class="glyphicon glyphicon-edit"></span><strong> Record successfully updated!</strong>';
				header('refresh:4;view_students.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}

	}
?>


<div class="container">

  <div class="jumbotron"> 

    
    <?php
        if(isset($errorMsg)){       
    ?>
          <div class="alert alert-danger">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong><?php echo $errorMsg; ?></strong>
        </div>
    <?php
        }
    ?>

    <?php
        if(isset($successMsg)){     
    ?>
        <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong><?php echo $successMsg; ?> -- redirecting</strong>
        </div>
    <?php
        }
    ?>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="row">

          <div class="col-md-12 col-md-offset-13">

                    <legend class="text-center">Manage Student</legend>

                    <fieldset>
                        <legend>Update Student Information</legend>
                        
                          <div class="form-group col-md-6">
						<img  class="img_pic" src="<?php echo $upload_image.$row['studimg'] ?>">
						<input type="file"  class="custom-file-input"  accept="image/png, image/jpeg, image/gif"  name="myfile">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Student ID</label>
                               <input type="input" onkeyup="this.value = this.value.replace(/[^0-9]/, '')" min="0" maxlength="12"  name="StudID" class="form-control"  placeholder="Enter Student ID" value="<?php echo $row['StudID'] ?>" required>
                        </div>

                         <div class="form-group col-md-6">
                            <label>RFID Student No.</label>
                           <input type="text" name="RFIDStudNo" class="form-control pull-right"  placeholder="Scan RFID" value="<?php echo $row['RFIDStudNo']; ?>" required>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Gender</label>
                         <select name="Gender" class="form-control" value="<?php  echo $row['Gender']; ?>">
                         <option value="Male">Male</option>
                         <option value="Female">Female</option>
                         </select>
                        </div>

                         <div class="form-group col-md-6">
						<label>Firstname</label>
                         <input type="input" onkeyup="this.value = this.value.replace(/[^a-z\s,A-Z\s]/, '')" name="firstname" class="form-control"  placeholder="Enter First Name" value="<?php echo $row['firstname']; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Student Cellphone Number</label>
                           <input type="input" onkeyup="this.value = this.value.replace(/[^0-9,+]/, '')" min="0" maxlength="13" name="contactnum" class="form-control"  placeholder="Enter Student Cellphone Number" value="<?php echo $row['contactnum'];?>">
                            </div>
                         
                        <div class="form-group col-md-6">
                        <label>Middlename</label>
                         <input type="input" onkeyup="this.value = this.value.replace(/[^a-z/\s,A-Z/\s]/, '')"  name="middlename" class="form-control pull-right"  placeholder="Enter Middle Name" value="<?php echo $row['middlename']; ?>" required>   
                        </div>

  			           	
                         <div class="form-group col-md-6">
                            <label>Parent Cellphone Number</label>
                          <input type="input" onkeyup="this.value = this.value.replace(/[^0-9,+]/, '')" min="0" maxlength="13" name="parentcontactnum" class="form-control"  placeholder="Enter Guardian Cellphone Number" value="<?php echo $row['parentcontactnum']; ?>">
                        </div>



                        <div class="form-group col-md-6">
                        <label>Lastname</label>
                          <input type="input" onkeyup="this.value = this.value.replace(/[^a-z\s,A-Z\s]/, '')" name="lastname" class="form-control"  placeholder="Enter lastname" value="<?php echo $row['lastname']; ?>" required>
                        </div>


                       
                    </fieldset>

                        <legend>Select option:</legend>
            
                        <div class="form-group col-md-6">
                             <label>Select Status of Student</label>
                            <select class="form-control" name="statusofstud" value="<?php echo $row['statusofstud']; ?>" required>
                               
                                <option>Enrolled</option>
                                <option>Not Enrolled</option>
                                <option>Suspended</option>
                                <option>Alumni</option>
                                <option>Kickout</option>
                            </select>
                        </div>

<script type="text/javascript">
function course_onchange(){
    var course = document.getElementById("course").value;
    var yearlevel = document.getElementById("yearlevel");

    if(course=="ICT"){
        var html = '<option value="GRADE 11 SHS">GRADE 11 SHS</option>';
            html += '<option value="GRADE 12 SHS">GRADE 12 SHS</option>';
            yearlevel.innerHTML = html;
    }
    else if(course=="ABM"){
           var html = '<option value="GRADE 11 SHS">GRADE 11 SHS</option>';
            html += '<option value="GRADE 12 SHS">GRADE 12 SHS</option>';
            yearlevel.innerHTML = html;
    }
    else if(course=="HUMSS"){
         var html = '<option value="GRADE 11 SHS">GRADE 11 SHS</option>';
            html += '<option value="GRADE 12 SHS">GRADE 12 SHS</option>';
            yearlevel.innerHTML = html;
    }
     else if(course=="BSIT"){
        var html = '<option value="1ST YEAR COLLEGE - REG">1ST YEAR COLLEGE - REG</option>';
            html += '<option value="2ND YEAR COLLEGE - REG">2ND YEAR COLLEGE - REG</option>';
            html += '<option value="3RD YEAR COLLEGE - REG">3RD YEAR COLLEGE - REG</option>';
            html += '<option value="1ST YEAR COLLEGE - NC">1ST YEAR COLLEGE - NC</option>';
            html += '<option value="2ND YEAR COLLEGE - NC">2ND YEAR COLLEGE - NC</option>';
            html += '<option value="3RD YEAR COLLEGE - NC">3RD YEAR COLLEGE - NC</option>';
            yearlevel.innerHTML = html;
    }
     else if(course=="BSBA"){
        var html = '<option value="1ST YEAR COLLEGE - REG">1ST YEAR COLLEGE - REG</option>';
            html += '<option value="2ND YEAR COLLEGE - REG">2ND YEAR COLLEGE - REG</option>';
              html += '<option value="3RD YEAR COLLEGE - REG">3RD YEAR COLLEGE - REG</option>';
                html += '<option value="1ST YEAR COLLEGE - NC">1ST YEAR COLLEGE - NC</option>';
                  html += '<option value="2ND YEAR COLLEGE - NC">2ND YEAR COLLEGE - NC</option>';
                    html += '<option value="3RD YEAR COLLEGE - NC">3RD YEAR COLLEGE - NC</option>';
            yearlevel.innerHTML = html;

        }
         else if(course=="Alumni"){
        var html = '<option>-Choose-</option>';
         html += '<option value="Alumni">Alumni</option>';
            yearlevel.innerHTML = html;
    }            
}


function yearlevel_onchange(){
    var course = document.getElementById("course").value;
    var yearlevel = document.getElementById("yearlevel").value;
    var section = document.getElementById("section");

    if(course=="ICT" && yearlevel=="GRADE 11 SHS"){
        var html = '<option value="ICT - UNIX">ICT - UNIX</option>';
            html += '<option value="ICT - VISTA">ICT - VISTA</option>';
            section.innerHTML = html;
    }
    else if(course=="ICT" && yearlevel=="GRADE 12 SHS"){
        var html = '<option value="ICT - Mark Zuckerburg">ICT - Mark Zuckerburg</option>';
            html += '<option value="ICT - Bill Gates">ICT - Bill Gates</option>';
            section.innerHTML = html;
    }
     else if(course=="ABM" && yearlevel=="GRADE 11 SHS"){
        var html = '<option value="ABM - Henry Sy">ABM - Henry Sy</option>';
            section.innerHTML = html;
    }
    else if(course=="ABM" && yearlevel=="GRADE 12 SHS"){
        var html = '<option value="ABM - Steve Jobs">ABM - Steve Jobs</option>';
            section.innerHTML = html;
    }
    else if(course=="HUMSS" && yearlevel=="GRADE 11 SHS"){
        var html = '<option value="HUMSS - Sigmund Freud">HUMSS - Sigmund Freud</option>';
            section.innerHTML = html;
    }
    else if(course=="HUMSS" && yearlevel=="GRADE 12 SHS"){
        var html = '<option value="HUMSS - GRADE 12">HUMSS - GRADE 12</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="1ST YEAR COLLEGE - REG"){
        var html = '<option value="BSIT 1 - 1 REG">BSIT 1 - 1 REG</option>';
             html += '<option value="BSIT 1 - 2 REG">BSIT 1 - 2 REG</option>';
            section.innerHTML = html;
    }
     else if(course=="BSIT" && yearlevel=="2ND YEAR COLLEGE - REG"){
        var html = '<option value="BSIT 2 - 1 REG">BSIT 2 - 1 REG</option>';
             html += '<option value="BSIT 2 - 2 REG">BSIT 2 - 2 REG</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="3RD YEAR COLLEGE - REG"){
        var html = '<option value="BSIT 3 - 1 REG">BSIT 3 - 1 REG</option>';
             html += '<option value="BSIT 3 - 2 REG">BSIT 3 - 2 REG</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="1ST YEAR COLLEGE - NC"){
        var html = '<option value="BSIT 1 - 1 NC">BSIT 1 - 1 NC</option>';
             html += '<option value="BSIT 1 - 2 NC">BSIT 1 - 2 NC</option>';
            section.innerHTML = html;
    }
     else if(course=="BSIT" && yearlevel=="2ND YEAR COLLEGE - NC"){
        var html = '<option value="BSIT 2 - 1 NC">BSIT 2 - 1 NC</option>';
             html += '<option value="BSIT 2 - 2 NC">BSIT 2 - 2 NC</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="3RD YEAR COLLEGE - NC"){
        var html = '<option value="BSIT 3 - 1 NC">BSIT 3 - 1 NC</option>';
             html += '<option value="BSIT 3 - 2 NC">BSIT 3 - 2 NC</option>';
            section.innerHTML = html;  
    }  
                 // BSBA

     else if(course=="BSBA" && yearlevel=="1ST YEAR COLLEGE - REG"){
        var html = '<option value="BSBA 1 - 1 REG">BSBA 1 - 1 REG</option>';
             html += '<option value="BSBA 1 - 2 REG">BSBA 1 - 2 REG</option>';
            section.innerHTML = html;
    }
     else if(course=="BSBA" && yearlevel=="2ND YEAR COLLEGE - REG"){
        var html = '<option value="BSBA 2 - 1 REG">BSBA 2 - 1 REG</option>';
             html += '<option value="BSBA 2 - 2 REG">BSBA 2 - 2 REG</option>';
            section.innerHTML = html;
    }
    else if(course=="BSBA" && yearlevel=="3RD YEAR COLLEGE - REG"){
        var html = '<option value="BSBA 3 - 1 REG">BSBA 3 - 1 REG</option>';
             html += '<option value="BSBA 3 - 2 REG">BSBA 3 - 2 REG</option>';
            section.innerHTML = html;  
    } 
     else if(course=="BSBA" && yearlevel=="1ST YEAR COLLEGE - NC"){
        var html = '<option value="BSBA 1 - 1 NC">BSBA 1 - 1 NC</option>';
             html += '<option value="BSBA 1 - 2 NC">BSBA 1 - 2 NC</option>';
             section.innerHTML = html;
    }
     else if(course=="BSBA" && yearlevel=="2ND YEAR COLLEGE - NC"){
        var html = '<option value="BSBA 2 - 1 NC">BSBA 2 - 1 NC</option>';
             html += '<option value="BSBA 2 - 2 NC">BSBA 2 - 2 NC</option>'; 
             section.innerHTML = html;
    }
    else if(course=="BSBA" && yearlevel=="3RD YEAR COLLEGE - NC"){
        var html = '<option value="BSBA 3 - 1 NC">BSBA 3 - 1 NC</option>';
             html += '<option value="BSBA 3 - 2 NC">BSBA 3 - 2 NC</option>';
             section.innerHTML = html; 
    }
     else if(course=="Alumni" && yearlevel=="Alumni"){
        var html = '<option value="Alumni">Alumni</option>';
             section.innerHTML = html; 
    }
    
}

</script>

                         <div class="form-group col-md-6">
                             <label>Select Course</label>
                         <select id= "course" class="form-control" name="course" value="<?php echo $row['course']; ?>" onChange= "course_onchange()" required>
                          <option value="" selected="selected">-Choose Course-</option>
                                <option>BSIT</option>
                                <option>BSBA</option>
                                <option>ICT</option>
                                <option>ABM</option>
                                <option>HUMSS</option>
                                <option>Alumni</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6"> 
                           <label>Select Year Level</label>
                            <select id= "yearlevel" class="form-control" name="yearlevel" value="<?php echo $row['yearlevel']; ?>" onChange= "yearlevel_onchange();" required>
                           

                           </select>
                        </div>

                         <div class="form-group col-md-6">
                             <label>Select Section</label>
                         <select id="section" class="form-control" name="section"  value="<?php echo $row['section']; ?>" required>  
                 
                          </select>  
              </div>

			
				<button type="submit" class="btn btn-primary pull-right" name="btnUpdate">
			     Update Information
				</button>
		</div>
	</form>
</div>

