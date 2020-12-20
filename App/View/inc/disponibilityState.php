  
<?php

use Core\Model\Converters\TypeConverter;

function disponibilitySate($currentDate, $availableAt, $unAvailableAt) {

    $availableTime = TypeConverter::convertToDate($availableAt);
    $unAvailableTime = TypeConverter::convertToDate($unAvailableAt);
    $currentTime = TypeConverter::convertToDate($currentDate);
    
    if( $currentTime > $availableTime && $currentTime < $unAvailableTime) : 
                            
        echo "<p class='f-green '>Disponible</p>";
   
    elseif($currentTime < $availableTime) : 

        echo  "<p class='f-orange'>Pas encore Disponible</p>";

    else : 

        echo "<p class='f-red'>Plus disponbile</p>";
    
    endif;

}