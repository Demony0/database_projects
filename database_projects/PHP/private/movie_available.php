<?php
    include $_SERVER['DOCUMENT_ROOT']."/database_projects/PHP/auth.php";
    $con=authentication();
    if(!isset($_SESSION['user_id'])){
        echo header('location:/database_projects/index.php');
    }
    $user_id=$_SESSION['user_id'];
    $data=movie_processor($user_id,"SELECT","not_in_user");
    $details=$data->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/database_projects/CSS/header-aside.css">
    <link rel="stylesheet" href="/database_projects/CSS/movie_section.css">
    <script src="/database_projects/JS/drawer-outline.js" defer></script>
    <title>Movies Maniac</title>
</head>
<body>
    <header>
        <h1>
            MAKE YOUR RESERVATION
        </h1>
    </header>

    <main>
        <?php
            if(isset($details)){
                do{ ?>
                    <div class="movie_container" style="background-image:url(<?php echo $details['image']?>);background-size:100% 100%;background-repeat:no-repeat">
                        <?php
                            echo "<div class=details>".$details['title']."<br/>".$details['price']."<br/> ADMIN: ".$details['first_name']." ".$details['last_name']."</div>";
                            echo "<span class=content_container>
                                <div>
                                    <a href=./reservation.php?admin_id=".$details['admin_id'].">
                                        MAKE A RESERVATION
                                    </a>
                                </div>
                            </span>";
                        ?>
                    </div>
                <?php }while($details=$data->fetch_assoc());
            }else{
                echo "<ol class=err> No Movies Created</ol>";
            }
        ?>
    </main>

    <aside class="aside" id="aside">
        <div class="c-o-button" id="openCloseButton"></div>
        <li>
            <ol><a href="./userIndex.php">Home</a></ol>
            <ol><a href="./logout.php">Log Out</a></ol>
        </li>
    </aside>
    
</body>
</html>