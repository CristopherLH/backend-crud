<?php
class StateView {
  public function cbo($state = '', $id = 'cbo_state_user') {
    $stateController = new StateController();
    $stateCbo = '';

    foreach ($stateController->get_states() as $s) {
      $stateCbo .= '<option '.($state == $s->id_state ? 'selected' : '').' value="'.$s->id_state.'">'.$s->description_state.'</option>';
    }
    $stateCbo = '<select required class="form-control col-12" id="'.$id.'" name=" state_user"><option value="">Seleccionar</option>'.$stateCbo.'</select>';

    return '<div class="col-12 col-md-6 mb-2">
      <small class="text-muted">Estado</small>
      <div class="input-group input-group-sm">
          <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-list"></i></div>
          </div>
          '.$stateCbo.'
      </div>
    </div>';
  }
}