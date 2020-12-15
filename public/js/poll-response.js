const pollId = $("#poll-response-form").data("poll-id");
let idQuestion = 0;
let currentQuestion = 1

/**
 * DISPLAY END COMPONENT (WHEN POLL IS OVER)
 * 
 * @param string testContent
 */
function displayEndComponent(textContent) {
    $("#content-page").html(`
        <h1>
            ${textContent}
        </h1>
        <a href="${MAIN_PATH + "/poll/chat/" + pollId}" class="btn btn-success" title="Accéder au chat du sondage">Accéder au chat du sondage </a>
    `)
}

/**
 * DISPLAY QUESTION (UI)
 * 
 * @param number currentQuestion 
 */
function displayQuestion (currentQuestion) {
    

    $.ajax({
        url : MAIN_PATH + "/poll/response/" + pollId + "/" + currentQuestion,
        accepts : {
            json : 'application/json'
        },
        dataType : "Json"
    })

    .done((question)=> {
        
        const questionKey = Object.keys(question)

        idQuestion = question[questionKey][0].idQuestion

        const answers = question[questionKey].map(answer => `
            <div class="d-flex align-items-center border mx-3">
                <label for="${answer.answerId}">${answer.answer}</label>
                <input type="radio" name="poll-answer" value="${answer.answerId}" id="${answer.answerId}" />
            </div>
        `)
        
        const questionComponent = $(`
        
            <div class="d-flex flex-column align-items-center py-5">
                <h2 class="py-5">${questionKey}</h2>

                <div class="d-flex justify-content-around">
                    ${answers.join("")}
                </div>

                <button type="submit" class="btn btn-primary my-4">
                    Valider
                </button>
                
            </div>
        
        `)

        $("#poll-response-form").html(questionComponent)
    })

    .fail(()=> {
        displayEndComponent("Le sondage a déjà été complété !")
    })

}

/**
 * SEND ANSWER TO SERVER
 * 
 * @param {*} answer 
 */

function sendAnswer (answer) {

    $.ajax({
        url : MAIN_PATH + "/poll/response/" + pollId + "/" + currentQuestion,
        method : "POST",
        data : {["poll-answer"] : answer[0].value, idQuestion },
        accepts : {
            json : 'application/json'
        },
        dataType : "Json"
    })
    
    .done((res)=> {
        
        currentQuestion = res.nextQuestion

        if(currentQuestion) {
           return displayQuestion(currentQuestion)
        }
        
       displayEndComponent("Merci d'avoir répondu au sondage")

        
    })
    .fail((err)=> {
        console.log(err.responseText);
        alert("La réponse ne s'est pas correctement envoyée")
    })

}

//ADD SUBMIT EVENT TO FORM

$("#poll-response-form").submit((e)=> {

    e.preventDefault()

    const data = $(e.currentTarget).serializeArray()

    if(data.length === 1) {

        sendAnswer(data)

    } else {
        alert("Vous devez répondre à la question pour valider la réponse")
    }
   
}) 

displayQuestion(1)
