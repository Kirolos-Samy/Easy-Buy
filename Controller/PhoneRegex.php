<?php
function phoneValidation($pn){
    $pattern = "/^01[0125][0-9]{8}$/i";
    if(preg_match($pattern,$pn)){
        return 1;
    }
}
?>