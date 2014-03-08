<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataFormater
 *
 * @author Giovani
 */
final class DataFormatter {
      public static function dataBrToMySql($dataBR){
        $aux = explode("/", $dataBR);
        return $aux[2] . "-" . $aux[1]. "-" . $aux[0];
    }
}

?>
