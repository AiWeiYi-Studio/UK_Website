backtop.onclick = function(){
scrollTo(0,0);
}
var timer = null;
backtop.onclick = function(){
cancelAnimationFrame(timer);
timer = requestAnimationFrame(function fn(){
var oTop = document.body.scrollTop || document.documentElement.scrollTop;
if(oTop > 0){
scrollTo(0,oTop-50);
timer = requestAnimationFrame(fn);
}else{
cancelAnimationFrame(timer);
} 
});
}