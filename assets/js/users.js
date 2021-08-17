const recipient_details = document.querySelector(".recipient-details");
const user_recipient = document.querySelector(".recipient-details p span");

const chatbox = document.querySelector(".chatbox");
const chat_section = document.querySelector(".chat-section");
const form = document.querySelector(".chat-section form");

const send_button = document.querySelectorAll(".typing-area button")[1];
const typing_input = document.getElementById("typing_input");

const product_contact = document.querySelector(".contact_buttons button:nth-child(2)");
const commande_contact = document.querySelector(".contact_buttons button:nth-child(1)");

const commande_contact_acheteur = document.getElementById("commande_contact_acheteur");
const admin_contact = document.getElementById("admin_contact");

var recent_conversations = document.querySelector(".users-list");

const user_profile = document.querySelector('.user-profile');


var current_user_id = document.getElementById("current_id_user");
// Select upload file elements: 
const input_image = document.getElementById("input_image");
const button_image = document.querySelectorAll(".typing-area button")[0];

const input_current = document.getElementById("current_conversation");

var MessageCount = document.getElementById("MessageCount");

form.onsubmit = (e) => {
    e.preventDefault();
}


button_image.onclick = () => {
    input_image.click();

}

send_button.onclick = () => {
    
    let xhr = new XMLHttpRequest();
    method = "POST";
    url = "php/insert_chat.php";
    xhr.open(method,url,true);

    xhr.onload = () => {
        if(xhr.readyState === 4 && xhr.status === 200){

            let data = xhr.response ;
            typing_input.value = "";
            input_image.value= "";
            update_chat();
            get_recent();
            if(data=="no success"){
                alert("ce genre de fichier n'est pas supporté");
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
    
    update_chat();
        
}
var x=null;
recent_conversations.addEventListener("click",function(event){


    var mytarget = event.target.closest(".user-list");
    //changeColor(mytarget);
    x=mytarget;
    user_recipient.innerHTML = mytarget.querySelector(".details-user-message span").innerHTML;
    ingoing_id = mytarget.querySelector("input").value;
    document.cookie = "ingoing_id="+ingoing_id;

    if(mytarget.querySelector(".input_user")){
        outgoing_id = mytarget.querySelector(".input_user").value;
        document.cookie = "outgoing_id="+outgoing_id;
    }
    else{
        document.cookie = "outgoing_id=";
    }
    if(current_user_id.value=="1"){
        get_users_details();
    }
    update_chat();



})
// get user details that are members of the current conversation (FOR ADMIN ONLY)
function get_users_details(){

    
    let xhr = new XMLHttpRequest();
    method = "POST";
    url = "php/get_conversation_memebers_info.php";
    xhr.open(method,url,true);

    xhr.onload = () => {
        if(xhr.readyState === 4 && xhr.status === 200){

            
            let data = xhr.response ;
            user_profile.innerHTML=data;


        }
        else{
            console.log("no working");
        }
    }
    xhr.send();

}

function update_message_status(conversation){

    let xhr = new XMLHttpRequest();
    method = "POST";
    url = "php/update_message_status.php";
    xhr.open(method,url,true)

    xhr.onload = () => {
        if(xhr.readyState === 4 && xhr.status === 200){

            let data = xhr.response ;
            console.log(data);
        }
        else{
            console.log("no working");
        }
    }
    xhr.send();

}


function update_chat(){

    let xhr = new XMLHttpRequest();
    method = "POST";
    url = "php/get_chat.php";
    xhr.open(method,url,true);

    xhr.onload = () => {
        if(xhr.readyState === 4 && xhr.status === 200){

            let data = xhr.response ;
            chatbox.innerHTML = data;
            get_recent();
            scroll_Botoom();

        }
        else{
            console.log("no working");
        }
    }
    xhr.send();    
    



}
// when product button is clicked:
if(product_contact){
product_contact.onclick =() =>{
    
    let product_id = prompt("please enter product id");
    document.cookie="type=produit";

    let xhr_0 = new XMLHttpRequest();
    method = "POST";
    url = "php/Provider/Products.php";

    xhr_0.open(method,url,true);

    xhr_0.onload = () => {
        if(xhr_0.readyState === 4 && xhr_0.status === 200){
        
            let data = xhr_0.response;
            let new_data =JSON.parse(data);
            
            let xhr = new XMLHttpRequest();
            method = "POST";
            url = "php/insert_chat.php";
    
            xhr.open(method,url,true);

            xhr.onload = () => {
                if(xhr.readyState === 4 && xhr.status === 200){
                    let data_0 = xhr.response;
                }
            }

            document.cookie = "ingoing_id="+new_data.product_vendeur_id;
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('type=automatic&message_content='+data);
        }
        else{
            console.log("no working");
        }
    }
    xhr_0.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_0.send('product_id='+product_id);


}
}

if(commande_contact){
commande_contact.onclick =() =>{
    
    let commande_id = prompt("please enter commande id");
    document.cookie="type=commande";

    let xhr_0 = new XMLHttpRequest();
    method = "POST";
    url = "php/Provider/Commandes.php";

    xhr_0.open(method,url,true);

    xhr_0.onload = () => {
        if(xhr_0.readyState === 4 && xhr_0.status === 200){

            let data = xhr_0.response;
            let new_data =JSON.parse(data);
            //console.log(new_data.product_vendeur_id);
            
            let xhr = new XMLHttpRequest();
            method = "POST";
            url = "php/insert_chat.php";
    
            xhr.open(method,url,true);

            xhr.onload = () => {
                if(xhr.readyState === 4 && xhr.status === 200){
                    let data_0 = xhr.response;
                    console.log(data_0);
                }
            }
            const commande = "commande";
            document.cookie = "ingoing_id="+new_data.commande_vendeur_id;
            document.cookie = "type=commande";
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('type=automatic&message_content='+data);
        }
        else{
            console.log("no working");
        }
    }
    xhr_0.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_0.send('commande_id='+commande_id);


}
}

// Button pour l'acheteur : contacter à propos une commande
if(commande_contact_acheteur){

commande_contact_acheteur.onclick =() =>{
    let commande_id = prompt("please enter commande id");


    let xhr_0 = new XMLHttpRequest();
    method = "POST";
    url = "php/Provider/Commandes.php";
    document.cookie="type=commande";

    xhr_0.open(method,url,true);

    xhr_0.onload = () => {
        if(xhr_0.readyState === 4 && xhr_0.status === 200){

            let data = xhr_0.response;
            let new_data =JSON.parse(data);
            //console.log(new_data.commande_vendeur_id);
            
            let xhr = new XMLHttpRequest();
            method = "POST";
            url = "php/insert_chat.php";
    
            xhr.open(method,url,true);

            xhr.onload = () => {
                if(xhr.readyState === 4 && xhr.status === 200){
                    let data_0 = xhr.response;
                    console.log(data_0);
                }
            }
            document.cookie = "ingoing_id="+new_data.commande_acheteur_id;
            document.cookie = "type=commande";
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('type=automatic&message_content='+data);
        }
        else{
            console.log("no working");
        }
    }
    xhr_0.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_0.send('commande_id='+commande_id);
}
}
// Button pour l'acheteur : contacter administration
if(admin_contact){


admin_contact.onclick= ()=>{

    let xhr = new XMLHttpRequest();
    method = "POST";
    url = "php/insert_chat.php";
    xhr.open(method,url,true);
    document.cookie="ingoing_id=1";
    document.cookie="type=conversation";

    xhr.onload = () => {
        if(xhr.readyState === 4 && xhr.status === 200){

            let data = xhr.response ;
            
            

        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("message_content=bonjour");
}
}

// get recent conversations


function get_recent(){


    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/get_recent_conversation.php", true);
    xhr.onload = () => {
        if(xhr.readyState === 4 && xhr.status === 200){
            let data = xhr.response ;
            
            recent_conversations.innerHTML = data;
            
            var y = recent_conversations.querySelector('#message_num').value;
            MessageCount.innerHTML=y;
            /*
            if(y=='0'){
                MessageCount.style.display='none';

            }
            else{
                MessageCount.innerHTML=y;
            }*/
            

        }
    }
    xhr.send();


};


function scroll_Botoom(){
    chat_section.scrollTop=chat_section.scrollHeight;

}


get_recent();

setInterval(get_recent,500);
setInterval(update_chat,500);


// show or hide drowp down menu: 

$(document).ready(function(){
    $(".profile .icon_wrap").click(function(){
      $(this).parent().toggleClass("active");
      $(".notifications").removeClass("active");
    });

    $(".notifications .icon_wrap").click(function(){
      $(this).parent().toggleClass("active");
       $(".profile").removeClass("active");
    });

    $(".show_all .link").click(function(){
      $(".notifications").removeClass("active");
      $(".popup").show();
    });

    $(".close").click(function(){
      $(".popup").hide();
    });
});