let user_list = document.querySelectorAll(".users-list header");

const user_recipient = document.querySelector(".recipient-details p span");
const chatbox = document.querySelector(".chatbox");
const form = document.querySelector(".chat-section form");
const send_button = document.querySelector(".typing-area button");
const typing_input = document.querySelector(".typing-area input");

const product_contact = document.querySelector(".contact_buttons button:nth-child(2)");
const commande_contact = document.querySelector(".contact_buttons button:nth-child(1)");

const commande_contact_acheteur = document.getElementById("commande_contact_acheteur");
const admin_contact = document.getElementById("admin_contact");

chatbox.scrollTop=chatbox.scrollHeight;


form.onsubmit = (e) => {
    e.preventDefault();
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
            

        }
    }

    let formData = new FormData(form);
    xhr.send(formData);

    
}

setInterval(()=>{update_chat();} ,500)

user_list.forEach( item => {
    item.addEventListener('click',event => {

        user_recipient.innerHTML = item.querySelector(".details-user-message span").innerHTML;
        outgoing_id = item.querySelector("input").value;
        document.cookie = "ingoing_id="+outgoing_id;

        update_chat();

    })
})

function update_chat(){

    let xhr = new XMLHttpRequest();
    method = "POST";
    url = "php/get_chat.php";
    xhr.open(method,url,true);

    xhr.onload = () => {
        if(xhr.readyState === 4 && xhr.status === 200){

            let data = xhr.response ;
            chatbox.innerHTML = data;
            //console.log(data);
        }
        else{
            console.log("no working");
        }
    }

    xhr.send();    

}
// when product button is clicked:

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