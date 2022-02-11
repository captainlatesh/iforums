<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
    .browsebox {
        min-height: 370px;
    }
    </style>
    <title>Iforums-life saver</title>
</head>

<body>


    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>


    <?php
    $id=$_GET['catid'];
    $sql="  SELECT * FROM `category` WHERE category_id=$id";
   $result=mysqli_query($conn,$sql);

   while($row=mysqli_fetch_assoc($result))
   {
     $catname=$row['category_name'];
     $catdesc=$row['category_description'];
   }

?>

<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{    $showAlert=false;
    $th_title=$_POST['title'];
    $th_description=$_POST['description'];
    $sql="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_description ', '$id', '0', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    $showAlert=true;
    if($result)
    {
     echo '<div class="alert alert-success alert-dismissible">
     <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
     <strong>Success!</strong> Your Question has Successfully Included!!
   </div>';
    }
}

?>

<!-- Slider start here -->
    <!-- Slider end here -->
    <div class="container my-1">
        <div class="jumbotron bg-secondary p-5 my-4">
            <h1 class="display-4 text-white">Hello, <?php echo $catname; ?> World!</h1>
            <p class="lead text-white"><?php
            echo $catdesc; ?></p>
            <hr class="my-4 ">
            <p class="text-white">It is a peer Forum Dont be Misbehave to anyone its a social organization and dont post
                same question again and again</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>


    </div>
    
<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
  echo'  <div class="container mb-3">
    <form action=" $_SERVER["REQUEST_URI"]" method="post">
        <h2>Ask your question here</h2>
    <div class="mb-3 col-md-6 form-control" align-items: center">
        <div class="form-group my-3">
            <label for="title">Thread Title</label>
            <input type="text" class="form-control" id="title"  aria-describedby="emailHelp" name="title" required>
            <small id="title" class="form-text text-muted">Keep your Title as small as crisp...</small>
        </div>

        <div class="form-group my-3">
            <label for="description">Elaborate your Question</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success my-3">Submit</button>
        </div>
    </form>
    </div>';}
    else
    {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Please logIn</strong> you post your queries only when you logged in
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>


    <div class="container browsebox">
        <h1 class="py-3">Browse Questions.</h1>


        <?php
    $id=$_GET['catid'];
    $sql="  SELECT * FROM `threads` WHERE thread_cat_id=$id";
   $result=mysqli_query($conn,$sql);
    $noresult=true;
   while($row=mysqli_fetch_assoc($result))
   { $noresult=false;
     $id=$row['thread_id'];
     $title=$row['thread_title'];
     $description=$row['thread_desc'];
     $thred_id=$row['thread_user_id'];
     $sql2="SELECT username FROM `user` WHERE userno=$thred_id";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);

  echo '<div class="media d-flex my-4 ">
  <img class="mr-3" src="img/user-default.png" width="55px" alt="Generic placeholder image">
  <div class="media-body">
  <p><b>'.$row2['username'].' </b> at '.$row['timestamp'].'</p>
      <h5 class="mt-0"><a href="threads.php?thread-id='.$id.'" class="text-decoration-none ">'.$title.'</a></h5>
      '.$description.'
  </div>
</div>
';

    }

    
if($noresult)
{
   echo '<div class="jumbotron jumbotron-fluid bg-secondary p-5 text-white">
   <div class="container">
     <h1 class="display-4">No Threads Found!! </h1>
     <p class="lead">Be the first one to answer this.</p>
   </div>
 </div>' ;
}
?>

  
    <?php
include 'partials/_footer.php';
?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>


</html>