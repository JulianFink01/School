<?php

function test($a){
    
        $a += 10;
        return $a;
    
}
function test2(&$a){
        $a += 12;
    
}
function test3($a, $b = 5){
        return $a + $b;
}

$a = 1;

function testGlobal(){
    global $a;
    $a = 5;
}
function staticVariable(){
    static $done = false;
    if(!$done){
        $done = true;
        echo "jaj";
    }else{
        echo "Nono";
    }
}
