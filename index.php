<?php
$_SESSION['connected']='';
require_once 'contr/controller.php';
$connection = new Connection() ;

if(isset($_GET['id'])){
    $current = $connection->getTaskById($_GET['id']);
}else{
    $current = [
            'id' => '',
            'title' => '',
            'description' => ''
    ];
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/additional.css">
    <title>Lista to-do</title>
</head>
<body>
    <div class="container">

        <nav class="navbar navbar-expand-lg  p-3">
            <a class="navbar-brand" href="#"><img src="img/logo.png" width="20%" alt="logo"></a>
        </nav>

    <?php

    if(isset($_SESSION['connected'])){
        if(!$_SESSION['connected']){
            echo '<div class="alert alert-danger" role="alert">Błąd połączenia z bazą danych!</div>';
        }
    }

    if (isset($_SESSION['error'])){
        echo $_SESSION['error'];
    }

    ?>

            <div class="d-flex justify-content-center p-3">
                <hr>
                <form class="w-100" action="scripts/saveTask.php" method="post">

                    <div class="form-group row">
                        <input class="form-control" type="hidden" name="id" value="<?php echo $current['id']; ?>">
                    </div>
                    <div class="form-group row">
                        <input class="form-control" type="text" name="title" placeholder="Wpisz tytuł zadania" value="<?php echo $current['title']; ?>">
                    </div>
                    <br>
                    <div class="form-group row">
                        <textarea class="form-control" name="description" placeholder="Wpisz treść zadania"><?php echo $current['description']; ?></textarea>
                    </div>
                    <br>
                    <button class="btn btn-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                        </svg> Zapisz</button>

                </form>
                <hr>
                </div>

                <?php
                $tasks = $connection->getTask();
                foreach ($tasks as $task){
                    ECHO <<< TASKCARD
                    <div class="card">
                        <h5 class="card-header">$task[title]</h5>
                                            
                    <div class="card-body text-right">

                        <p class="card-text">$task[description]
                        <br>
                        <p style="text-align: end; font-style: italic;">$task[date]</p>
                        </p>
                        <div class="row">
                            <div class="col">
                                <a href="?id=$task[id]" class="btn btn-secondary">Zmień</a> 
                            </div>
                            <div class="col d-flex justify-content-end">
                                <form  method="post" action="scripts/deleteTask.php">
                                <input type="hidden" name="id" value="$task[id]">
                                <button class="btn btn-danger">Usuń</button>
                                </form>
                            </div>
                            
                        </div>
                        
                        
                        </p> 

                        
                    </div>
                    </div>
                    <br>
                    TASKCARD;
                }

                // var_dump($tasks)
                ?>
</div>


    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>