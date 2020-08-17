<?php
class UserView {
  public function insert_update($user) {
    $stateController = new StateController();
    $stateView = new StateView();

    return '<form id="frm_user" class="needs-validation form-row" novalidate>
    <input type="hidden" class="form-control text-center" name="id_user" value="'.$user->id_user.'" />

      <div class="col-12 col-md-6 mb-2">
        <small class="text-muted">Nombre</small>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
            </div>
            <input type="text" required class="form-control text-center" placeholder="Ingresar nombre" name="name_user" value="'.$user->name_user.'" />
            <div class="invalid-feedback">Campo obligatorio</div>
        </div>
      </div>

      <div class="col-12 col-md-6 mb-2">
        <small class="text-muted">Apellidos</small>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
            </div>
            <input type="text" required class="form-control text-center" placeholder="Ingresar apellido" name="last_name_user" value="'.$user->last_name_user.'" />
            <div class="invalid-feedback">Campo obligatorio</div>
        </div>
      </div>

      <div class="col-12 col-md-6 mb-2">
        <small class="text-muted">Login</small>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
            </div>
            <input type="text" required class="form-control text-center" placeholder="Ingresar login" name="login_user" value="'.$user->login_user.'" />
            <div class="invalid-feedback">Campo obligatorio</div>
        </div>
      </div>

      <div class="col-12 col-md-6 mb-2">
        <small class="text-muted">Password</small>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock"></i></div>
            </div>
            <input type="password" '.($user->id_user ? '' : 'required').' class="form-control text-center" placeholder="Ingresar password" name="password_user" value="'.$user->password_user.'" />
            <div class="invalid-feedback">Campo obligatorio</div>
        </div>
      </div>

      '.$stateView->cbo(!empty($user->state_user) ? $user->state_user : '', 'cbo_state_user_save').'

      <button type="submit" class="btn btn-block btn-success">Enviar</button>
    </form>';
  }
}