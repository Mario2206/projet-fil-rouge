const betId = $("#bet-response-form").data("bet-id");
let idQuestion = 0;
let currentQuestion = 1

/**
 * DISPLAY END COMPONENT (WHEN bet IS OVER)
 * 
 * @param string testContent
 */
function displayEndComponent(textContent) {
    $("#content-page").html(`
        <h1>
            ${textContent}
        </h1>
    `)
}

/**
 * DISPLAY QUESTION (UI)
 * 
 * @param number currentQuestion 
 */
function displayQuestion (currentQuestion) {
    
    
    $.ajax({
        url : MAIN_PATH + "/bet/response/" + betId + "/" + currentQuestion,
        accepts : {
            json : 'application/json'
        },
        dataType : "Json"
    })

    .done((question)=> {
        console.log(question);
        const questionKey = Object.keys(question)

        idQuestion = question[questionKey][0].idQuestion

        const answers = question[questionKey].map(answer => `
            <label for="${answer.answerId}" class=" border p-1 my-1 flex justify--center col10">
                ${answer.answer}
                <input type="radio" name="bet-answer" value="${answer.answerId}" id="${answer.answerId}" />
            </label>
        `)
        
        const questionComponent = $(`
        
            <div class="flex--column align--center py-5">
                <h2 class="py-5">${questionKey}</h2>

                <div class="d-flex justify-content-around col12">
                    ${answers.join("")}
                </div>

                <button type="submit" class="btn btn-primary my-4">
                    Valider
                </button>
                
            </div>
        
        `)

        $("#bet-response-form").html(questionComponent)
    })

    .fail((res)=> {
        console.log(res);
        displayEndComponent(res.responseJSON)
    })

}

/**
 * SEND ANSWER TO SERVER
 * 
 * @param {*} answer 
 */

function sendAnswer (answer) {

    $.ajax({
        url : MAIN_PATH + "/bet/response/" + betId + "/" + currentQuestion,
        method : "POST",
        data : {["bet-answer"] : answer[0].value, idQuestion },
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
        
       displayEndComponent("Votre pari a correctement été enregistré")

        
    })
    .fail((err)=> {
        console.log(err.responseText);
        alert("La réponse ne s'est pas correctement envoyée")
    })

}

//ADD SUBMIT EVENT TO FORM

$("#bet-response-form").submit((e)=> {

    e.preventDefault()

    const data = $(e.currentTarget).serializeArray()

    if(data.length === 1) {

        sendAnswer(data)

    } else {
        alert("Vous devez répondre à la question pour valider la réponse")
    }
   
}) 

displayQuestion(1)
