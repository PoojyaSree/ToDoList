<?php
$errors="";
$db= mysqli_connect('localhost','root','','todo');
if(isset($_POST['submit'])){
    $task=$_POST['task'];
    if(empty($task)){
        $errors="You must fill the task";
        
    }else{
        mysqli_query($db, "INSERT INTO taks (task) VALUES ('$task')");
    header('location:home.php');
        
    }
    
}
if(isset($_GET['del_task'])){
    $id=$_GET['del_task'];
    mysqli_query($db,"DELETE FROM taks WHERE id=$id");
    header('location:home.php');
}
$taks= mysqli_query($db,"SELECT * FROM taks");





?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Todo list application with PHP and mySQL</title>
        <style>
            body{
                font-size: 18px;
            }
            .heading{
                width: 50%;
                margin: 30px auto;
                text-align: center;
                color: #6B8E23;
                background: #FFF8DC;
                border-radius: 20px;
            }
            form{
                width: 50%;
                margin: 30px auto;
                border-radius: 5px;
                padding: 10px;
                background: #FFF8DC;
                border: 1px solid #6B8E23;
                
            }
            form p{
                color: red;
                margin:0px;
            }
            .task_input{
                width: 73%;
                height: 15px;
                padding: 10px;
                border: 2px solid #6B8E23;
                
            }
            .add_btn{
                height: 39px;
                background: #FFF8DC;
                color:#6B8E23;
                border-radius: 5px;
                border:2px solid #6B8E23;
                padding: 5px 20px;
            }
            table{
                width: 50%;
                margin: 30px auto;
                border-collapse: collapse;
                
            }
            tr{
                border-bottom: 1px solid #cbcbcb;
               
            }
            th,td{
                border:none;
                height: 30px;
                padding: 2px;
            }
            tr:hover{
                background: #E9E9E9;
            }
            .task{
                text-align: left;
                
            }
            .delete{
                text-align: center;
            }
            .delete a{
                color: white;
                background: #a52a2a;
                padding: 1px 6px;
                border-radius: 3px;
                text-decoration: none;
            }
            </style>
    </head>
    <body>
        <div class="heading">
            <h2>Todo list application with PHP and mySQL</h2> 
            
       </div>
        <form method="post" action="home.php">
            <?php if(isset($errors)){?>
            <p><?php echo $errors; ?></p>  
            <?php }?>
            <input type='text' name="task" class="task_input">
            <button type="submit" class="add_btn" name="submit">Add task</button>
        </form> 
        <table>
            <thead>
                <tr>
                    <th>N</th>
                     <th>task</th>
                     <th>Action</th></tr>
            </thead>
            <tbody>
            
                
            
            <?php $i=1; while ($row=mysqli_fetch_array($taks)){
                
                ?><tr>
                <td><?php echo $i;?></td>
            <td class="task"><?php echo $row['task'];?></td>
            <td class="delete">
                <a href="home.php?del_task=<?php echo $row['id'];?>">x</a>
            </td>
            </tr>
            <?php $i++; } ?>
          
            </tbody>
        </table>
    </body>
</html>