<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    require('include/connection.php');

    $sql = "SELECT * FROM `questions`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $questions = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php');
        ?>

        <div class="admins pt-5">
            <div class="container pt-5">
                        
                        <!-- alerts -->
                        <?php require('./include/alerts.php') ?>

                <div class="py-3 container d-flex justify-content-between">
                    <h2 class="h2 text-capitalize">questions</h2>
                    <a class="btn text-capitalize rounded-pill py-2 px-3" href="add-questions.php">add questions</a>
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">question</th>
                            <th scope="col">answer</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($questions)):
                            foreach ($questions as $question) : ?>
                                <tr>
                                    <th scope="row"><?= $question['id'] ?></th>
                                    <td><?= $question['question'] ?></td>
                                    <td><?= $question['answer'] ?></td>
                                    <td class="d-flex">
                                    <a href="update-question.php?id=<?=$question['id']?>"><i class="fa-solid fa-pen-to-square rounded-pill bg-info text-light py-1 px-2"></i></a>
                                    <a href="handlers/delete-question.php?id=<?=$question['id']?>"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                                </td>
                                </tr>
                                <?php 
                        endforeach; 
                    endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        include('include/script.php');
        ?>
        
    </body>

</html>