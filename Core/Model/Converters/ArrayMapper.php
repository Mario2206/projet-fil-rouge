<?php 

namespace Core\Model\Converters;

class ArrayMapper {

    /**
     * For grouping data in associative array by a property name
     * 
     * @param string $propertyName
     * @param array $wantedValues
     * @param array<Object> $dataToProcess
     * 
     * @return array
     */
    public static function groupByPropertyOfSubObject(string $propertyName, array $wantedValues,  array $dataToProcess) : array {
        $data = [];
   
        foreach($dataToProcess as $item ) {
            $dataToAdd = [];
            foreach ($wantedValues as $wantedVal) {
                
                $dataToAdd[$wantedVal] = $item->{$wantedVal};
            }

            $data[$item->$propertyName][] = $dataToAdd;
        }

        return $data;
    }

}