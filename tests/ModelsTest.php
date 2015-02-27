<?

include('../lib/models/abstract.Model.php');

include('../lib/models/Chats.php');
include('../lib/models/Reports.php');
include('../lib/models/Tickets.php');

class ModelsTest extends PHPUnit_Framework_TestCase 
{

	public function testReports(){

		$mock = $this->getMockBuilder('Reports')->setMethods(array('_doRequest'))->getMock();
		$mock->expects($this->once())->method('_doRequest')->with($this->equalTo('GET'),$this->equalTo('reports/chatting_time?date_from=2015-01-01&date_to=2015-02-01'));
		$mock->get('chatting_time', array(date_from => "2015-01-01", date_to => "2015-02-01"));

	}

	public function testChats(){

		$mock = $this->getMockBuilder('Chats')->setMethods(array('_doRequest'))->getMock();
		$mock->expects($this->once())->method('_doRequest')->with($this->equalTo('GET'),$this->equalTo('chats?date_from=2015-01-01&agent=name%2Bsurname%40domain.com'));
		$mock->get(array(date_from => "2015-01-01", agent => "name+surname@domain.com"));

	}

	public function testTickets(){

		$mock = $this->getMockBuilder('Tickets')->setMethods(array('_doRequest'))->getMock();
		$mock->expects($this->once())->method('_doRequest')->with($this->equalTo('GET'),$this->equalTo('tickets?requester[mail]=test%40test.com'));
		$mock->get( array('requester[mail]' => "test@test.com", "" => "empty"));

	}
}