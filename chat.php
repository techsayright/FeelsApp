<?php 
  session_start();

  include_once "php/config.php";

  if(!isset($_SESSION['unique_id'])){ //session
    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ChatBox | FeelApp</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

  <style>
    /* for emotionn */
    .emotion{
        display: flex;
        /* justify-content:space-around; */
        align-items: center;
        overflow-x: auto;
        padding-top: 10px;
        margin-bottom: -20px;
        display: none; /* initially display will be none */ 

    }
    .emotion div{
        margin-left: 10px;
        margin-right: 5px;
    }

    .emotion div button{
        padding: 4px 5px;
        background-color: silver;
        border: 1px solid silver;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
    }
    .emotion div button:hover{
        border: 1px solid black;
    }
    .emotion div button:last-child{
        margin-right: 10px;
    }

    :is(.emotion)::-webkit-scrollbar {
          width: 0px;
            /* for hiding scroll bar*/
        }

    /* for e msg */
    .e{
        color: darkgray;
        margin-left: 2px;
        height: 20px;
        width: 20px;
        font-size: 12px;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>

        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']); //get from url rewriting
         
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        
        <img src="php/uploading/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>

      <div class="chat-box">
          <!-- chat will come dynamically here -->
      </div>

      <div class="emotion">
          <div>
              <button type="button" onclick="emotion('Joy')">Joy</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Sadness')">Sadness</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Excitement')">Excitement</button>
          </div>
           <div>
              <button type="button" onclick="emotion('Anger')">Anger</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Fear')">Fear</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Disgust')">Disgust</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Love')">Love</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Surprise')">Surprise</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Shame')">Shame</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Guilt')">Guilt</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Pride')">Pride</button>
          </div>
          <div>
              <button type="button" onclick="emotion('Anxiety')">Anxiety</button>
          </div>
      </div>

      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" class="e_value" name="e_value" value="Joy" hidden>
        <!-- hidden input -->
        
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
