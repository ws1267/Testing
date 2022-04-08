<?php include 'action.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <title>PHP CRUD</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <!-- <div class="container"> -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">PHP CRUD</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Feature</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Serveices</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            </ul>
        </div>
        <form class="form-inline" action="/action_page.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
        </nav> 
        
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4 class="text-center text-dark mt-2">Advanced CRUD App Using Bootstrap 4, PHP & MySQLi</h4>
                </div>
                <hr>
                <?php if(isset($_SESSION['response'])){ ?>
                <div class="alert alert-<?=$_SESSION['res_type']; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?=$_SESSION['response']; ?>
                </div>
                <?php } unset($_SESSION['response']); ?>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <h4 class="text-center text-info">Add Record</h4>
                    <form action="action.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$id; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="<?=$name; ?>" required> 
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" value="<?=$email; ?>" required> 
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter Phone" value="<?=$phone; ?>">
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="hidden" name="odlimage" value="<?=$photo; ?>">
                            <input type="file" name="image" class="custom-file">
                            <img src="<?=$photo; ?>" width="120" class="img-thumbnail">
                        </div>
                        <div class="form-group">
                            <?php if(isset($_GET['edit'])) : ?>
                                <input type="submit" name="update" id="update" class="btn btn-info btn-block" value="Update Record">
                            <?php else: ?>
                                <input type="submit" name="add" id="add" class="btn btn-primary btn-block" value="Add Record">
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <?php 
                        $query="SELECT * FROM crud ORDER BY ID";
                        $stmt=$myconn->prepare($query);
                        $stmt->execute();
                        $result=$stmt->get_result();
                    ?>
                    <h4 class="text-center text-info">Existing Record</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row=$result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['id'];  ?></td>
                                <td><img src="<?= $row['photo']; ?>" width="40" height="30"></td>
                                <td><?=$row['name'];  ?></td>
                                <td><?=$row['email'];  ?></td>
                                <td><?=$row['phone'];  ?></td>
                                <td>
                                    <a href="details.php?details=<?=$row['id']; ?>" class="badge badge-primary p-2">Details</a> |
                                    <a href="action.php?delete=<?=$row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you really want to delete this record?');">Delete</a> |
                                    <a href="index.php?edit=<?=$row['id']; ?>" class="badge badge-success p-2">Edit</a> 
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



  <!-- </div> -->
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>