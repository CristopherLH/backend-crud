<?php
class StateModel extends ConnecDB {
  public function get_states() {
    $prepare = $this->prepare('CALL SP_GET_STATES()');
    $prepare->execute();
    return $prepare->fetchAll(PDO::FETCH_OBJ);
  }
}