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
            <div class="">
                <label for="bet_question${IdQuestion}">Question ${IdQuestion}</label>
                <input type="text" name="bet_questions[]" id="bet_question${IdQuestion}" required>
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
        const currentQuestion = $(e.target).siblings("input[type=text]").attr("id").split('bet_question')[1]
     
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
            <input type="text" id="response${IdReponse}" placeholder="Réponse ${IdReponse + 1}" name="bet_responses[${currentQuestion}][]" required>
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

$(".bet-form").submit(e => {

    const questionLength = $(".container-responses", $(e.target)).children().length 

    if(!questionLength) {
        e.preventDefault()
    }
})

$(document.body).bind("DOMSubtreeModified", () => {
    console.log($(".container-question-response").children().length);
    const disable = $(".container-question-response").children().length === 0
    $(".bet-validation").prop("disabled", disable)
})