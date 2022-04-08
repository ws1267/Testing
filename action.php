<?php 
   session_start();
   require_once 'config.php';

   $update=false;
   $id=0;
   $name='';
   $email='';
   $phone='';
   $photo='';

   if (isset($_POST['add'])) {
        $name =  $_POST['name'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];

        $photo = $_FILES['image']['name'];
        $upload = "uploads/".$photo;

        $query= "INSERT INTO Crud (name,email, phone, photo) Values (?,?,?,?)";
        $stmt=$myconn->prepare($query);
        $stmt->bind_param("ssss", $name, $email,$phone,$upload);
        $stmt->execute();

        move_uploaded_file($_FILES['image']['tmp_name'],$upload);

        header('location: index.php');
        $_SESSION['response'] = "Successfully inserted into the database.";
        $_SESSION['res_type'] = "success";

   } 

   if(isset($_GET['delete'])) {
        $id=$_GET['delete'];

        $sql = "SELECT photo FROM crud WHERE id=?";
        $stmt2=$myconn->prepare($sql);
        $stmt2->bind_param("i",$id);
        $stmt2->execute();
        $result2=$stmt2->get_result();
        $row=$result2->fetch_assoc();

        $imgpath=$row['photo'];
        unlink($imgpath);


        $query = "DELETE FROM crud WHERE id=?";
        $stmt=$myconn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();

        header('location: index.php');
        $_SESSION['response'] = "Record Successfully Deleted.";
        $_SESSION['res_type'] = "danger";

   }

   if(isset($_GET['edit'])) {
        $id=$_GET['edit'];

        $sql = "SELECT * FROM crud WHERE id=?";
        $stmt=$myconn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $row=$result->fetch_assoc();

        $id=$row['id'];
        $name=$row['name'];
        $email=$row['email'];
        $phone=$row['phone'];
        $photo=$row['photo'];

        $update=true;

}
if(isset($_POST['update'])) {
    $id=$_POST['id'];
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $phone =  $_POST['phone'];
    $oldimage = $_POST['oldimage'];

    if (isset($_FILES['image']['name']) && ($_FILES['image']['name']!='')) {
        $newimage = $_FILES['image']['name'];
        $upload = "uploads/".$newimage;
        unlink($newimage);
        move_uploaded_file($_FILES['image']['tmp_name'],$upload);
    } else {
        $newimage = $oldimage;
    }
    $query= "UPDATE Crud 
            SET name=?,email=?, phone=?, photo=?
            WHERE id=?";
    $stmt=$myconn->prepare($query);
    $stmt->bind_param("ssssi", $name, $email,$phone,$upload,$id);
    $stmt->execute();

    header('location: index.php');
    $_SESSION['response'] = "Record Has Been Successfully Updated.";
    $_SESSION['res_type'] = "primary";

}

if(isset($_GET['details'])) {
    $id=$_GET['details'];

    $sql = "SELECT * FROM crud WHERE id=?";
    $stmt=$myconn->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $row=$result->fetch_assoc();

    $did=$row['id'];
    $dname=$row['name'];
    $demail=$row['email'];
    $dphone=$row['phone'];
    $dphoto=$row['photo'];

}





?>