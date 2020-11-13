window.onload = function() {
document.getElementById("b1").onclick=start;
document.getElementById("b2").onclick=stop;    
}
var t;
function start() {
//alert("hi");
    t=setInterval(doit,500);
}

function stop() {
alert("bye");
    clearInterval(t);
}

function doit(){
    document.getElementById("center").innerHTML+="again ";
}