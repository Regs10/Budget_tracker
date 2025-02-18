const date =new Date();
const n =date.toDateString();
console.log(n);

document.getElementById("time").innerHTML=n;
// -----------------------------
function showProfile(){
    document.getElementById("show-categories").style.display="none";
    document.getElementById("show-profile").style.display="flex";
    
}
function showCategories(){
    document.getElementById("show-categories").style.display="flex";
    document.getElementById("show-profile").style.display="none";
}