<?php
session_start();

include 'connect.php';

// Database id is taken
$id = $_SESSION['id'];
$roll_no = $_SESSION['roll_no'];
echo $roll_no;
echo $id;


if(isset($_FILES['letter'])){
$filename = $_FILES['letter']['name']; //SDG Admin.pdf
$filename = explode(" ",$filename);//SDG Admin.pdf
$filename = join("_",$filename);//SDG_Admin.pdf
$file_ext=explode('.',$filename);//SDG_admin . pdf
$file_ext=strtolower(end($file_ext));//pdf
echo $filename;

// get the file extension
$extension1 = pathinfo($filename, PATHINFO_EXTENSION);
$file_path = 'letter/'.$roll_no;
if(!is_dir($file_path)){
    mkdir($file_path);
}
// destination of the file on the server
$destination1 = $file_path.'/'.'RAIT_'.$roll_no.'.'.$file_ext;



// the physical file on a temporary uploads directory on the server
$file1 = $_FILES['letter']['tmp_name'];
$size1 = $_FILES['letter']['size'];
if (move_uploaded_file($file1, $destination1) )
    {
    $sql = "UPDATE internship_data SET letter = '".$destination1."' WHERE internship_data.id = $id ";
    if($conn->query($sql)){
        echo "Done!";
    }else{
        echo "$conn->error";
    }
}
}
if (isset($_POST['approvalstat'])) {
    if($_POST['approvalstat']=='Approved'){
      mysqli_query($conn,"UPDATE internship_data SET completion_status = 'In-progress',approval_status = '".$_POST['approvalstat']."',comment = 'Applied Successfully'
      WHERE internship_data.id = '$id'");
      header('location:admin_1.php');
    }else{
      mysqli_query($conn,"UPDATE internship_data SET completion_status = 'Rejected' approval_status = '".$_POST['approvalstat']."',comment = '".$_POST['comments']."'
      WHERE internship_data.id = '$id'");
      header('location:admin_1.php');
    }

  }


?>