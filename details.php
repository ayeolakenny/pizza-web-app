<?php

  include('config/db_connect.php');

  if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    
    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
      header('Location: index.php');
    } {
      echo 'query error: ' . mysqli_error($conn);
    }
  }

  // check get request id parameter
  if(isset($_GET['id'])){
    
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    $sql = "SELECT * FROM pizzas WHERE id = $id";

    // get query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $pizza = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

  }

?>

<!DOCTYPE html>

<?php include('templates/header.php') ?>

  <div class="container center">
    <?php if($pizza): ?>

      <h4><?php echo htmlspecialchars($pizza['title']) ?></h4>
      <p>Created by: <?php echo htmlspecialchars($pizza['email']) ?></p>  
      <h5>Ingredients</h5>
      <p><?php echo htmlspecialchars($pizza['ingredients']) ?></p>

      <!-- Delete Form   -->
      <form action="details.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
        <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
      </form>

    <?php else: ?>
      
      <h5>No such pizza exists</h5>

    <?php endif ?>

  </div>

<?php include('templates/footer.php') ?>

</html>