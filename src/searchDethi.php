<?php
function searchDT($Data){
    $arrayDT=explode(' ',$Data);
    $stringDT='%'.implode('%',$arrayDT).'%';
    return $stringDT;
}