<?php

$insert=false;
$update=false;
$delete=false;


// connect to the database
$link=mysqli_connect("localhost","root","","phpnotes");

if(!$link){
    die("sorry we failed to connect-->".mysqli_connect_error());
}

// echo $_GET['update'];
// echo $_POST['snoedit'];
// exit();

if(isset($_GET['delete'])){
    $dsno=$_GET['delete'];

    $query3 = "DELETE FROM notes WHERE sno='$dsno'";
    $result3=mysqli_query($link,$query3);
    if($result3){
        // echo"The record has been inserted succesfully !<br>";
        header("location:/phppractise/index.php");
                $delete=true;


    }
    else{
        echo"The record has not been deleted succesfully because of this error--> ".mysqli_error($link);

    }
    

}

if($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['snoedit'])){
        
//upadte the record
    $sno= $_POST['snoedit'];

    $titledit= $_POST['titleedit'];
    $descriptionedit= $_POST['descedit'];

    $query2="UPDATE notes  SET title='$titledit' , description='$descriptionedit' WHERE sno='$sno'";
    $result2=mysqli_query($link,$query2);
    if($result2){
        // echo"The record has been inserted succesfully !<br>";
        $update=true;
    }
    else{
        echo"The record has not been updated succesfully because of this error--> ".mysqli_error($link);

    }
    
        
    }

    else{
    $title=$_POST['title'];
    $description=$_POST['desc'];

    $query1="INSERT INTO notes ( title, description) VALUES ('$title', '$description')";
    $result1=mysqli_query($link,$query1);

    if($result1){
        // echo"The record has been inserted succesfully !<br>";
        $insert=true;
    }
    else{
        echo"The record has not been inserted succesfully because of this error--> ".mysqli_error($link);

    }
}

}

?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js">
    </script>

    <title>iNotes - Notes taking made easy</title>
</head>

<body>


    <!-- edit modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
  Edit Modal
</button> -->

    <!-- Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodalLabel">Edit this Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/phppractise/index.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoedit" id="snoedit">
                        <div class="mb-3">
                            <label for="titleedit" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleedit" name="titleedit"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="descedit">Notes Description</label>
                                <textarea class="form-control" id="descedit" name="descedit" rows="3"></textarea>
                            </div>
                        </div>
                        <!-- <button type="submit" class="btn btn-primary">Update Note</button> -->
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">iNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <?php
    if($insert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You notes has been inserted successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    if($update){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You notes has been updated successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    if($delete){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You notes has been deleted successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container my-4">
        <h2> Add a Note</h2>

        <form action="/phppractise/index.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="desc">Notes Description</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>


    <div class="container my-4">




        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
$query="SELECT * FROM notes";
$result=mysqli_query($link,$query);
$no=0;
while ($row=mysqli_fetch_assoc($result)) {

    $no=$no +1;
    echo'<tr>
    <th scope="row">'.$no.'</th>
    <td>'.$row['title'].
    '</td>
    <td>'.$row['description'].'</td>
    <td>
        <button class="edit btn btn-sm btn-primary" id='.$row['sno'].'>Edit</button>   <button class="delete btn btn-sm btn-primary" id=d'.$row['sno'].'>Delete</button> 
    </td>
  </tr>';
    
}

?>

            </tbody>
        </table>
        <hr>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            let table = new DataTable('#myTable');

        });
    </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleedit.value = title;
                descedit.value = description;
                snoedit.value = e.target.id;
                console.log(e.target.id);
                $('#editmodal').modal('toggle');

            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ",);
                sno = e.target.id.substr(1,);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;

                if (confirm("Delete Note!")) {
                    console.log("yes");
                    window.location = `/phppractise/index.php?delete=${sno}`;
                    //if we use ``instead of this"",'' then we can write ${sno} as a php variable
                    //TODO::use a form and use post request to submit a form.
                }
                else {
                    console.log("no");

                }

            })
        })


    </script>

</body>

</html>