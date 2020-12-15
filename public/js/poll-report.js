const pollId = $("#poll-id").val()

/**
 * For displaying results comming from server
 */
function displayResults () {

    $.ajax({
        url : MAIN_PATH + "/poll/report/details/" + pollId,
        dataType : "Json"
    })
    .done((res)=> {

        let resultsHtml = []

        for(const question in res.questions ) {
            
            resultsHtml.push(`

                <article class="py-5">

                    <h2 class="py-4">

                        ${question}

                    </h2>

                    <ul>

                    ${res.questions[question].map(answer=> (`
                    
                        <li class="list-group-item d-flex flex-column">

                            <p>

                            ${answer.answer}

                            </p>

                            <strong class="align-self-end">

                                Nombre de votants : ${answer.nVoter}

                            </strong>

                        </li>
                
                    `)).join("")}
                    
                    </ul>

                <article>
            
            `)

        }

        


        $("#container-results").html(resultsHtml.join(""))



    })
    .fail(()=> {
        alert("Une erreur s'est produite lors de la récupération des données")
    })

}

//SIMULATE  SOCKET FOR GETTING RESULTS 
setInterval(displayResults, 5000)

displayResults()