const path = $("#poll-chat-form").attr("action");

function displayMessages() {

    $.ajax({
        url : path, 
        dataType : "Json"
    })
    .done((res) => {
       
        const messagesHTML = res.map((mess) => (`
            <div class="d-flex flex-column bg-light p-3 rounded my-1">
                <p class="align-self-start">
                    ${mess.message}
                </p>
                <span class="align-self-end">
                    ${mess.username}
                </span>
            </div>
        `))

        $("#poll-chat").html(messagesHTML.join(""))

        //AUTO SCROLL DOWN FOR MESSAGES CONTAINER

        $("#poll-chat").scrollTop($('#poll-chat').prop('scrollHeight'))

    })

    .fail (()=> {
        alert("Les messages ne se sont pas correctement synchronisés ! ")
    })

}

$('#poll-chat-form').submit( (e) => {
    e.preventDefault()

    const message = $(e.target).serializeArray()[0].value

    $.ajax({
        url : path, 
        method : "POST",
        data : { "poll-message" : message}
    })
    .done((res)=> {
        
        displayMessages();
    })
    .fail(() => {
        alert("Une erreur est survenue lors de l'ajout du message")
    })
})

displayMessages()

//START TO SIMULATE SOCKET

setInterval(displayMessages, 5000)

