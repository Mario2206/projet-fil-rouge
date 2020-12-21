const pollId = $("#bet-id").val()
console.log(MAIN_PATH + "/bet/report/details/" + pollId);
/**
 * For displaying results comming from server
 */
function displayResults () {

    $.ajax({
        url : MAIN_PATH + "/bet/report/details/" + pollId,
        dataType : "Json"
    })
    .done((res)=> {

        let resultsHtml = []
        console.log(res);
        for(const question in res.questions ) {
            
            resultsHtml.push(`

                <div class="py-1 col6">

                    <h2 class="py-2 style--underline">

                        ${question}

                    </h2>

                    <ul class="flex--column align--center col12">

                    ${res.questions[question].map((answer, index)=> (`
                    
                        <li class="col12 my-2 flex align--center ">
                            <label for="${answer.answerId}" class="flex--column flex-fill  p-1 border--black">
                                <p>

                                ${answer.answer}

                                </p>

                                <strong class="self--end py-2">

                                    Nombre de votants : ${answer.nVoter}

                                </strong>
                            </label>
                            <input type="radio" name="response[${answer.idQuestion}]" value="${answer.answerId}" id="${answer.answerId}"/>
                        </li>
                
                    `)).join("")}
                    
                    </ul>

                </div>
            
            `)

        }

        $("#container-results").html(resultsHtml.join(""))



    })
    .fail((err)=> {
        console.log(err);
        alert("Une erreur s'est produite lors de la récupération des données")
    })

}

//SIMULATE  SOCKET FOR GETTING RESULTS 
setInterval(displayResults, 50000)

displayResults()