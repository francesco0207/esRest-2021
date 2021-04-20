<?php
  include('./class/Student.php');
  $method = $_SERVER["REQUEST_METHOD"];
  $student = new Student();

  switch($method) {
    case 'GET':
      $id = $_GET['id'];
      if (isset($id))
      {
        $student = $student->find($id);
        $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
      }else
      {
        $students = $student->all();
        $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
      }
      header("Content-Type: application/json");
      echo($js_encode);
      break;

    case 'POST':
      $numStudent = count($student->all());
      $result = $student->all();

      $student->_id = $result[$numStudent-1]['id']+1;
      $student->_name = $_POST["name"];
      $student->_surname = $_POST["surname"];
      $student->_sidiCode = $_POST["sidiCod"];
      $student->_taxCode = $_POST["taxCod"];
      $student->add($student);
      echo "Operazione completata con successo";
      break;

    case 'DELETE':
      $substringedURI = explode('/', $_SERVER["REQUEST_URI"]);
      if(count($substringedURI) != 0)
      {
        $student->delete($substringedURI[count($substringedURI)-1]);
        echo "Operazione completata con successo";
      }
      else echo "Inserire ID studente";
      break;

    case 'PUT':
      $substringedURI = explode('/', $_SERVER["REQUEST_URI"]);
      if(count($substringedURI) != 0)
      {
        $body = file_get_contents("php://input");
        $decodeBody = json_decode($body, true);

        $student->_id = $substringedURI[count($substringedURI)-1];
        $student->_name = $decodeBody["_name"];
        $student->_surname = $decodeBody["_surname"];
        $student->_sidiCode = $decodeBody["_sidiCode"];
        $student->_taxCode = $decodeBody["_taxCode"];
  
        $student->update($student);
        echo "Operazione completata con successo";
      }
      else echo "Inserire ID studente";
      break;

    default: 
      echo "Impossibile eseguire questa operazione"; 
      break;
  }
?>
