<?php
    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message"><span>'.$message.'</span><i class="fas fa-times" onclick="this.parentElemnt.remove();"></i></div>';
        }
    }
?>
