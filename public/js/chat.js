const path = $("#chat-form").attr("action");
const username =  $("#chat-form").data("username")


function displayMessages() {

    $.ajax({
        url : path, 
        dataType : "Json"
    })
    .done((res) => {
    
        const messagesHTML = res.map((mess) => (`
            <div class="flex  ${mess.username === username ? "self--end justify--end" : "self--start"}">
                <p class="bg--light-blue p-2 f-white">
                    ${mess.message}
                </p>
                <span class="align-self-end style--italic">
                    ${mess.username}
                </span>
            </div>
        `))

        $("#chat-container").html(messagesHTML.join(""))

        //AUTO SCROLL DOWN FOR MESSAGES CONTAINER

        $("#chat-container").scrollTop($("#chat-container").prop('scrollHeight'))

    })

    .fail ((res)=> {
        console.log(res);
        alert("Les messages ne se sont pas correctement synchronisés ! ")
    })

}

$('#chat-form').submit( (e) => {
    e.preventDefault()

    const message = $(e.target).serializeArray()[0].value
    $("input[name='message']").val("")
    
    $.ajax({
        url : path, 
        method : "POST",
        data : { "message" : message}
    })
    .done((res)=> {
        displayMessages();
    })
    .fail((err) => {
        alert("Une erreur est survenue lors de l'ajout du message")
    })
})

displayMessages()

//START TO SIMULATE SOCKET

setInterval(displayMessages, 5000)

