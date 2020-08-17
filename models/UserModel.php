<?php
class UserModel extends ConnecDB {
  public function get_users($p_filter, $p_state_user, $p_opt) {
    $prepare = $this->prepare('CALL SP_GET_USERS(:p_filter, :p_state_user, :p_opt)');
    $prepare->bindValue(':p_filter', $p_filter);
    $prepare->bindValue(':p_state_user', $p_state_user);
    $prepare->bindValue(':p_opt', $p_opt);
    $prepare->execute();
    return $prepare->fetchAll(PDO::FETCH_OBJ);
  }

  public function get_users_id(UserEntity $userEntity) {
    $prepare = $this->prepare('CALL SP_GET_USERS_ID(:p_id_user)');
    $prepare->bindValue(':p_id_user', $userEntity->id_user);
    $prepare->execute();
    return $prepare->fetch(PDO::FETCH_OBJ);
  }

  public function users_insert_update(UserEntity $userEntity) {
    $prepare = $this->prepare('CALL SP_USERS_INSERT_UPDATE(:p_id_user, :p_name_user, :p_last_name_user, :p_login_user, :p_password_user, :p_state_user)');
    $prepare->bindValue(':p_id_user', $userEntity->id_user);
    $prepare->bindValue(':p_name_user', $userEntity->name_user);
    $prepare->bindValue(':p_last_name_user', $userEntity->last_name_user);
    $prepare->bindValue(':p_login_user', $userEntity->login_user);
    $prepare->bindValue(':p_password_user', $userEntity->password_user);
    $prepare->bindValue(':p_state_user', $userEntity->state_user);
    $prepare->execute();
    return $prepare->fetch(PDO::FETCH_OBJ);
  }

  
  public function user_delete(UserEntity $userEntity) {
    $prepare = $this->prepare('CALL SP_USER_DELETE(:p_id_user)');
    $prepare->bindValue(':p_id_user', $userEntity->id_user);
    $prepare->execute();
    return $prepare->fetch(PDO::FETCH_OBJ);
  }

  
  public function user_active(UserEntity $userEntity) {
    $prepare = $this->prepare('CALL SP_USER_ACTIVE(:p_id_user)');
    $prepare->bindValue(':p_id_user', $userEntity->id_user);
    $prepare->execute();
    return $prepare->fetch(PDO::FETCH_OBJ);
  }
}