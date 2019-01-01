<?php
/**
 * Created by PhpStorm.
 * User: hoang_son
 * Date: 12/17/2018
 * Time: 11:55 AM
 */

namespace Tests\Library;

use Tests\TestCase;
use App\Libraries\ChatworkLib;

/**
 * @property ChatworkLib cw
 */
class ChatworkLibTest extends TestCase {

    public function setUp() {

        parent::setUp();
        $this->cw = new ChatworkLib();
    }

    /**
     *
     */
    public function testSendResponseChatWork() {
        if ($this->cw->say_in_chatwork(config('AI.config_ai.list_answer_smarty.hoangson'), 'testSendResponseChatWork') != null) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    /**
     *
     */
    public function testSendResponseChatWorkProperty() {

        $this->cw->setRoomId(config('AI.config_ai.list_answer_smarty.hoangson'));
        $this->cw->setMsg('testSendResponseChatWork');

        if ($this->cw->say_in_chatwork() != null) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
}
