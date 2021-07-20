let user_list = document.querySelectorAll(".users-list header");

const user_recipient = document.querySelector(".recipient-details p span");
const chatbox = document.querySelector(".chatbox");
const form = document.querySelector(".chat-section form");
const send_button = document.querySelector(".typing-area button");

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
            chatbox.innerHTML = data;
            //console.log(data);
        }
    }

    
}
user_list.forEach( item => {
    item.addEventListener('click',event => {

        user_recipient.innerHTML = item.querySelector(".details-user-message span").innerHTML;
        outgoing_id = item.querySelector("input").value;
        document.cookie = "ingoing_id="+outgoing_id;


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
        }

        xhr.send();
    })
})

