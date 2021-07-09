const form = document.querySelector(".login form");
const continue_button = document.querySelector(".button input");

// this event handler prevent the browser the form submission so we can use ajax later on.
form.onsubmit = (e)=>{
    e.preventDefault();
}

// handling events(button click) using ajax

continue_button.onclick = ()=>{

    let xhr = new XMLHttpRequest(); // create a new xml object
    method = "POST";
    url = "php/login_verif.php";
    
    xhr.open(method,url,true); // initialize a request
    // calling handler if request is successful sent. 
    xhr.onload = ()=>{

        if(xhr.readyState === 4 && xhr.status === 200){ // if the operation is complete(fetch data has been done succefully)

            let data = xhr.response;
            if(data === "success"){
                location.href = "chatArea.php"
            }
            else{
                console.log(data);
            }
        }
        else{
            console.log("not working");
            
        }
   
    }
    // sending form data through ajax(fname, lname) ..
    let formData = new FormData(form);
    xhr.send(formData);

}

