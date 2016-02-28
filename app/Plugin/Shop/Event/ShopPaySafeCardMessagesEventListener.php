<?php
App::uses('CakeEventListener', 'Event');

class ShopPaySafeCardMessagesEventListener implements CakeEventListener {
    public function implementedEvents() {
        return array(
            'onLoadPage' => 'checkPSCMessages',
        );
    }

    public function checkPSCMessages($event) {

      // On chage les models
      $this->User = ClassRegistry::init('User');
      $this->PaysafecardMessage = ClassRegistry::init('Shop.PaysafecardMessage');


      $search_psc_msg = $this->PaysafecardMessage->find('all', array('conditions' => array('user_id' =>  $this->User->getKey('id'))));
      if(!empty($search_psc_msg)) {
        $this->PaysafecardMessage->deleteAll(array('user_id' =>  $this->User->getKey('id')));

        ModuleComponent::$vars['search_psc_msg'] = $search_psc_msg;
      }

    }
}
