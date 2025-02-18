    const date =new Date();
    const n =date.toDateString();
    console.log(n);

    document.getElementById("time").innerHTML=n;



    function showIncomeTab(){
        document.getElementById("income").style.display="flex";
        document.getElementById("expense").style.display="none";
        let shadowBox =document.getElementsByClassName("shadow");
        Array.from(shadowBox).forEach(function(item){
            item.style.boxShadow =" 0px 4px 11px 0px  #61D3B8"
        })
        let selectBox =document.getElementsByClassName("categories");
        Array.from(selectBox).forEach((item)=>{
            item.style.boxShadow =" 0px 4px 11px 0px  #61D3B8"
        })
    }
    function showExpenseTab(){
        document.getElementById("income").style.display="none";
        document.getElementById("expense").style.display="flex";
        let shadowBox= document.getElementsByClassName("shadow");
        Array.from(shadowBox).forEach((item)=>{
            item.style.boxShadow =" 0px 4px 11px 0px #D3619F"
        })
        let selectBox =document.getElementsByClassName("categories");
        Array.from(selectBox).forEach((item)=>{
            item.style.boxShadow =" 0px 4px 11px 0px #D3619F"
        })
    }
// -------------------------------expense

function showCategoriesImg2(){

    var select = document.getElementById('categories2');
    var selectedOption = select.options[select.selectedIndex];
    var imageLoc = selectedOption.getAttribute('data-image');

    // Create a new image element
    document.getElementById("selectionImg2").setAttribute("src","./uploads/"+imageLoc)
}

function showCategoriesImg() {
    var select = document.getElementById('categories1');
    var selectedOption = select.options[select.selectedIndex];
    var imageLoc = selectedOption.getAttribute('data-image');

    // Create a new image element
    document.getElementById("selectionImg1").setAttribute("src","./uploads/"+imageLoc)

}

