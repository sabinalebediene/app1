<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use Controller\EmployeeController;
use Model\Employee;
use Repository\EmployeeRepository;

class EmployeeContollerTest extends TestCase {
    public function testGetAllJsonReturnsJson() {
        $mock = $this->getMockBuilder(EmployeeRepository::class)->getMock();
        $employeeController = new EmployeeController($mock);
        $mock->expects($this->exactly(1))
            ->method('getAll')
            ->willReturn(array(new Employee("1", "Jonas"), new Employee("2", "Antanas")));
            
        
        // when
        $res = $employeeController->getAllJsonWithMetaInformation();
        // then
        assertEquals('[{"id":"1","name":"Jonas"},{"id":"2","name":"Petras"}]', $res);
        }

    public function testGetAllJsonReturnsJsonMeta() {
        $mock = $this->getMockBuilder(EmployeeRepository::class)->getMock();
        $employeeController = new EmployeeController($mock);
        $mock->expects($this->exactly(1))
            ->method('getAll')
            ->willReturn(array(new Employee("1", "Jonas"), new Employee("2", "Antanas")));
            
            // when
            $res = $employeeController->getAllJsonWithMetaInformation();
            // then
            assertEquals('{"employees":[{"id":"1","name":"Jonas"},{"id":"2","name":"Petras"}],"count":2}', $res);
        }
       
}