<?php

if (isset($_POST['view']))
{
    $email = $_POST['email'];
    $id = substr((string)$_POST['cid'],13);

    $db = mysqli_connect("localhost", "root", "", "csi");
    $sql = "SELECT * FROM certificates where email='$email' or id='$id'";
    $res = mysqli_query($db, $sql);
}

?>


<!doctype html>
<html>
    <head> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <style>
            .input input
            {
                outline: none;
                border: none;
                border: 1px solid black;
                border-radius: 20px;
                /* width: 300px; */
                width: 100%;
                padding: 2px 7px;
            }
            .view input
            {
                border: none;
                outline: none;
                border-radius: 20px;
                height: 30px;
                width: 60px;
                background-color: rgba(25, 181, 254, 1);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top: 30px;">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <form method="post">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input"><input placeholder="Email" name="email" type="email"></div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">
                                <div class="input"><input placeholder="Certificate id" name="cid" type="text"></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="view">
                                <input name="view" value="Check" type="submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-2"></div>
            </div>            
        </div>

        <div class="row" style="margin-top:30px;">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contest</th>
                        <th>Certificate id</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if (isset($_POST['view'])) { 
                        while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                    <tr>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['contest']; ?></td>
                        <td><?php echo $data['contest'].dechex($data['id']); ?></td>
                        <td><button onclick="document.location.href='certificate.php?email=<?php echo $data['email']; ?>&contest=<?php echo $data['contest']; ?>'">View</button></td>
                    </tr>
                    <?php }} ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-2"></div>
            
        </div>
    </body>
</html>