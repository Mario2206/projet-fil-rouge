<?php 

function disponibilityModal (string $pollId) {

    echo '
    <div class="modal modal--disable fade">
        <form method="POST" action="'. MAIN_PATH . BET_OPEN . "/" . $pollId .'" class="modal--box" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title" id="exampleModalLongTitle">Définir les nouvelles dates de disponibilité</h5>
                    </div>
                    <div class="modal-body">
                            <div class="py-2">
                                <label for="available-date">Disponible le</label>
                                <input type="date" name="availableAt" id="available-date"/>
                            </div>
                            <div class="py-2">
                                <label for="unavailable-date">Indisponbile dès</label>
                                <input type="date" name="unAvailableAt" id="unavailable-date"/>
                            </div>
                    </div>
                    <div class="flex justify--center py-3">
                        <button type="button" class="cta--danger action-modal" data-dismiss="modal">Close</button>
                        <button type="submit" class="cta--success">Sauvegarder</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    ';

}