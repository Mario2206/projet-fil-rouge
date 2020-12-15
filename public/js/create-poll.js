/**
 * For creating question (HTML node)
 * 
 * @param {number} IdQuestion 
 * 
 * @returns HTML node
 */
function createQuestionComponent (IdQuestion) {
    const question = $(`
        <div>
            <div class="poll-container-form--input-wrapper py-4 w-100">
                <label for="poll_question${IdQuestion}">Question ${IdQuestion}</label>
                <input type="text" name="poll_questions[]" id="poll_question${IdQuestion}" required>
                <button class="btn btn-info add-response">
                    Ajouter réponse
                </button>
                <button class="btn btn-danger remove-question">
                    Supprimer la question
                </button>
            </div>
            <div class="pl-3 container-responses"></div>
        </div>
    `)

    $(".remove-question", question).click(e => {
        e.preventDefault()
        $(e.target).parent().parent().remove()
    })

    $(".add-response", question).click(e => {
        e.preventDefault()
        const containerResponse = $(e.target).parent().siblings()
        const responseLength = containerResponse.children().length 
        const currentQuestion = $(e.target).siblings("input[type=text]").attr("id").split('poll_question')[1]
     
        const response = CreateResponseComponent(responseLength, currentQuestion)
       
        $(e.target).parent().siblings().append(response)
    })

    return question
}


/**
 * For creating a response (HTML node)
 * 
 * @param {number} orderQuestion 
 * 
 * return HTML node
 */
function CreateResponseComponent (IdReponse, currentQuestion) {

     
        const response = $(`<div class="py-2">
            <label for="response${IdReponse}">Réponse ${IdReponse + 1}</label>
            <input type="text" id="response${IdReponse}" placeholder="Réponse ${IdReponse + 1}" name="poll_responses[${currentQuestion}][]" required>
            <button class="btn btn-danger btn-delete-response">X</button>
        </div>`)

        $(".btn-delete-response", response).click((e)=> {
            e.preventDefault()
            const containerReponse = $(e.target).parent()
            containerReponse.parent().children().length == 1 ? containerReponse.parent().parent().remove() : containerReponse.remove()
           
        })

        return response
}

$(".add-question").click(e => {
    e.preventDefault()
    const nQuestions = $(".container-question-response").children().length + 1
    
    const question = createQuestionComponent(nQuestions)
    
    const initResponse = CreateResponseComponent(0, nQuestions)

    $(".container-responses" , question).append(initResponse)
    $(".container-question-response").append(question)

})

$(".poll-form").submit(e => {

    const questionLength = $(".container-responses", $(e.target)).children().length 

    if(!questionLength) {
        e.preventDefault()
        console.log( $(e.target).serializeArray());
    }
})

$(document.body).bind("DOMSubtreeModified", () => {
    const disable = $(".container-question-response").children().length > 0
    $(".poll-validation").prop("disabled", !disable)
})