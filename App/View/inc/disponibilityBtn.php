
<?php

use Core\Model\Converters\TypeConverter;

function disponibilityBtn ($idPoll, $currentDate, $availableAt, $unAvailableAt) {
    
    $availableTime = TypeConverter::convertToDate($availableAt);
    $unAvailableTime = TypeConverter::convertToDate($unAvailableAt);
    $currentTime = TypeConverter::convertToDate($currentDate);

    if($currentTime > $availableTime && $currentTime < $unAvailableTime) :
                            
        echo "<button type='submit' for='form-result' class='cta--danger'>Terminer le pari</button>";

    else :

        echo '   <button type="button" class="cta--success action-modal" data-toggle="modal" data-target="#exampleModalCenter">Rendre disponible</button>';
    
    endif;
}