let user_list = document.querySelectorAll(".users-list header");

const user_recipient = document.querySelector(".recipient-details p span");


user_list.forEach( item => {
    item.addEventListener('click',event => {
        user_recipient.innerHTML = item.querySelector(".details-user-message span").innerHTML;
    
    })
})

