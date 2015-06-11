<?php

namespace LiveChat\Tests;

include('../lib/LiveChat/API.php');
include('../lib/LiveChat/Models/BaseModel.php');

include('../lib/LiveChat/Models/Chats.php');
include('../lib/LiveChat/Models/Reports.php');
include('../lib/LiveChat/Models/Tickets.php');

class ModelsTest extends \PHPUnit_Framework_TestCase
{

	public function testReports(){

		$mock = $this->getMockBuilder('\LiveChat\Models\Reports')->setMethods(array('_doRequest'))->getMock();
		$mock->expects($this->once())->method('_doRequest')->with($this->equalTo('GET'),$this->equalTo('reports/chatting_time?date_from=2015-01-01&date_to=2015-02-01'));
		$mock->get('chatting_time', array('date_from' => "2015-01-01", 'date_to' => "2015-02-01"));

	}

	public function testChats(){

		$mock = $this->getMockBuilder('\LiveChat\Models\Chats')->setMethods(array('_doRequest'))->getMock();
		$mock->expects($this->once())->method('_doRequest')->with($this->equalTo('GET'),$this->equalTo('chats?date_from=2015-01-01&agent=name%2Bsurname%40domain.com'));
		$mock->get(array('date_from' => "2015-01-01", 'agent' => "name+surname@domain.com"));

	}

	public function testTickets(){

		$mock = $this->getMockBuilder('\LiveChat\Models\Tickets')->setMethods(array('_doRequest'))->getMock();
		$mock->expects($this->once())->method('_doRequest')->with($this->equalTo('GET'),$this->equalTo('tickets?requester[mail]=test%40test.com'));
		$mock->get( array('requester[mail]' => "test@test.com", "" => "empty"));

	}
}