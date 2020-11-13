"use strict";

var timer;
var myString;
var interval;
var size;
var index = 0;
var result;
var flag = 0;

window.onload = function() {
    
    document.getElementById("start").onclick=start;
    document.getElementById("stop").onclick=stop;  
    document.getElementById("wpm").onchange=speedChange;
    document.getElementById("wpm").onchange();
    
   var elements = document.getElementsByName("size");
    for(var i=0; i<elements.length;i++){
        elements[i].onclick = function(){
            document.getElementById("dis").style.fontSize = this.value;
        }
    }
}

function doArray(){
    myString = document.getElementById("inptxt").value;
    result = myString.split(/[ \t\n]+/);
    var p = [",",".",":",";","?","!"];
    for(var i = 0; i<result.length;i++){
        var wordlength = result[i].length;
        for(var j=0;j<p.length;j++){
            if(result[i].charAt(wordlength-1) == p[j]){
                result[i]=result[i].substring(0,wordlength-1);
                i++;
            }
        }
    }
}

function start(){
    doArray();
    start.disabled=true;
    stop.disabled=false;
    timeChange();
}

function stop(){
    start.disabled=false;
    stop.disabled=true;
    
    clearInterval(timer);
    timer=null;
    //if(index>result.length){
        
    //index=0;
        
    //}
}

function speedChange(){
clearInterval(timer);
    interval = this.value;
    if(start.disabled){
        timeChange();
    }
}

function timeChange(){
    timer = setInterval(speedread,parseInt(interval));
}


function speedread(){
    if(index < result.length-1){
        document.getElementById("dis").innerHTML = result[index];
        
    }else{
        flag=1;
        //stop();
    }
    if(flag==0){index++;}
}