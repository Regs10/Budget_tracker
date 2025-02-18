 var loginpage=true;
 

 function showRegister(){

   let cpass=document.getElementById('confirmPass')
   let top=document.querySelector('.topic h1')
   let option=document.querySelector('.create h4')
   let okay=document.querySelector('.signup')
   if(loginpage){
      cpass.style.display="flex";
      top.innerHTML="Register"
      option.innerHTML="sign In!"
      okay.setAttribute('value','Register')
      loginpage=false;
   }
   else{
      cpass.style.display="none";
      top.innerHTML="login"
      option.innerHTML="create new account"
      okay.setAttribute('value','Login')
      loginpage=true;
   }
 }