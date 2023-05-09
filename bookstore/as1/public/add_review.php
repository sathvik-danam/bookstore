<?php
session_start();
          
        if (isset($_POST['submit'])) {
            include("theconnection.php");
          
            // Prepare the INSERT statement

            $stmt = $Conn->prepare('INSERT INTO reviews (reviewtext)
            VALUES (:reviewtext)');
            //print_r($_POST);
            $values = array('reviewtext' => $_POST['reviewtext']);
            
            try {
                if (!$stmt->execute($values)) {
                    echo "Category might already exist.";
                }
            } catch (Exception $ex) {
                echo "Category might already exist.";
            }
            

            // Redirect to the product page
            header("location: addAuction.php");
            exit();
            
        }


?>
