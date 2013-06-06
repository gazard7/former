<?php
class ButtonTest extends FormerTests
{

  public function testCanCreateAButton()
  {
    $button  = $this->former->button('Save')->__toString();
    $matcher = $this->matchButton('btn', 'Save');

    $this->assertHTML($matcher, $button);
  }

  public function testCanChainMethodsToAButton()
  {
    $button  = $this->former->button('Save')->class('btn btn-primary')->value('Cancel')->__toString();
    $matcher = $this->matchButton('btn btn-primary', 'Cancel');

    $this->assertHTML($matcher, $button);
  }

  public function testCanCreateASubmitButton()
  {
    $button  = $this->former->submit('Save')->class('btn btn-primary')->__toString();
    $matcher = $this->matchInputButton('btn btn-primary', 'Save');

    $this->assertHTML($matcher, $button);
  }

  public function testCanUseFormerObjectMethods()
  {
    $button  = $this->former->button('pagination.next')->setAttributes($this->testAttributes)->__toString();
    $matcher = $this->matchButton('foo', 'Next', array('data-foo' => 'bar'));

    $this->assertHtml($matcher, $button);
  }

  public function testCanDynamicallyCreateButtons()
  {
    $button  = $this->former->large_block_primary_submit('Save')->__toString();
    $matcher = $this->matchInputButton('btn-large btn-block btn-primary btn', 'Save');

    $this->assertHTML($matcher, $button);
  }

  public function testCanCreateAResetButton()
  {
    $button  = $this->former->large_block_inverse_reset('Reset')->__toString();
    $matcher = $this->matchInputButton('btn-large btn-block btn-inverse btn', 'Reset', 'reset');

    $this->assertHTML($matcher, $button);
  }

  public function testCanHaveMultipleInstancesOfAButton()
  {
    $multiple = array($this->former->submit('submit'), $this->former->reset('reset'));
    $multiple = implode(' ', $multiple);

    $matcher1 = $this->matchInputButton('btn', 'Submit', 'submit');
    $matcher2 = $this->matchInputButton('btn', 'Reset', 'reset');

    $this->assertHTML($matcher1, $multiple);
    $this->assertHTML($matcher2, $multiple);
  }

  public function testButtonsAreHtmlObjects()
  {
    $button = $this->former->submit('submit');
    $button->name('foo');
    $matcher = $this->matchInputButton('btn', 'Submit', 'submit');
    $matcher['attributes']['name'] = 'foo';

    $this->assertHTML($matcher, $button->render());
  }

  public function testLinksDontHaveTypeAttribute()
  {
    $link = $this->former->link('#', 'foo')->render();

    $this->assertEquals('<a href="foo" class="btn">#</a>', $link);
  }

}
