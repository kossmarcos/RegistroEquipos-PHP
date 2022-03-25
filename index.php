<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ST SeiSua</title>
</head>

<body class="body">

    <?php require_once 'process.php'; ?>

    <?php
    if (!isset($_SESSION['message'])) : ?>
        <div class="alert alert- <?= $_SESSION['msg_type'] ?>">

            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <div class="container ">

        <?php
        $mysqli = new mysqli("localhost", "root", "root", "stseisua") or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        ?>


        <div class="registro">
            <div class="formulario">
                <h1>Registro de Entrada de Equipos</h1>
                <form action="process.php" method="POST">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-group">
                        <label for="">Propietario</label>
                        <br>
                        <input type="text" name="owner" id="input" value="<?php echo $owner; ?>" class="text-input" placeholder="Propietario/Cliente">
                    </div>
                    <div class="form-group">
                        <label for="">Ingreso</label>
                        <br>
                        <input type="date" name="ingreso" id="input" value="<?php echo $ingreso; ?>" class="   text-input">
                    </div>
                    <div class="form-group">
                        <label for="">Procesador</label>
                        <br>
                        <input type="text" name="procesador" id="input" value="<?php echo $procesador; ?>" class=" text-input" placeholder="procesador">
                    </div>
                    <div class="form-group">
                        <label for="">MotherBoard</label>
                        <br>
                        <input type="text" name="mb" id="input" value="<?php echo $mb; ?>" class=" text-input" placeholder="MB">
                    </div>
                    <div class="form-group">
                        <label for="">Disco</label>
                        <br>
                        <input type="text" name="disco" id="input" value="<?php echo $disco; ?>" class="   text-input" placeholder="Tipo de disco y tamño">
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <br>
                        <input type="text-area" name="descripcion" id="input" value="<?php echo $descripcion; ?>" class="   descripcion" placeholder="Descripcion del problema del equipo">
                    </div>

                    <div class="btn-box">
                        <?php
                        if ($update == true) : ?>
                            <button type="submit" class="btn btn-info" name="update">Update</button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-primary" name="save">Guardar</button>
                        <?php endif; ?>

                    </div>
                </form>
            </div>
        </div>
        <a href="#sec-2">
            <div class="scroll-down">
        </a>
    </div>
    <br>

    <div class="display td">
        <table class="table">
            <section id="sec-2">
                <thead class="margin">
                    <tr>
                        <th>Dueño</th>
                        <th>Ingreso</th>
                        <th>Procesador</th>
                        <th>Motherboard</th>
                        <th>Disco</th>
                        <th>Descripcion</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                <?php
                while ($row = $result->fetch_assoc()) : ?>

                    <tr>
                        <td><?php echo $row['owner']; ?></td>
                        <td><?php echo $row['ingreso']; ?></td>
                        <td><?php echo $row['procesador']; ?></td>
                        <td><?php echo $row['mb']; ?></td>
                        <td><?php echo $row['disco']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td class="linea">
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>

                    </tr>
                <?php endwhile; ?>
            </section>
        </table>
    </div>

    <?php
    function pre_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    ?>
    </div>

</body>

</html>
