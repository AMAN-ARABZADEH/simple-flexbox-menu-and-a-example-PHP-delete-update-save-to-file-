
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form method="POST">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username"><br><br>
  <label for="data">Message:</label>
  <textarea id="data" name="data" rows="10" cols="40"></textarea><br><br>
  <input type="submit" name="save" value="Save">
  <input type="submit" name="update" value="Update">
  <input type="submit" name="delete" value="Delete">
</form>

</body>
</html>



<?php
if (isset($_POST['save'])) {
  $username = $_POST['username'];
  $data = $_POST['data'];
  
  // Create a new instance of the SerializedData class with the username and data
  $serializedData = new SerializedData($username, $data);
  
  // Serialize the data and write it to a file
  $serialized = serialize($serializedData);
  file_put_contents('serializedData.txt', $serialized);
  
  echo "Data saved successfully.";
}

if (isset($_POST['update'])) {
  $username = $_POST['username'];
  $data = $_POST['data'];
  
  // Read the serialized data from the file and deserialize it
  $serialized = file_get_contents('serializedData.txt');
  $serializedData = unserialize($serialized);
  
  // Update the data for the specified username
  $serializedData->setDataForUsername($username, $data);
  
  // Serialize the updated data and write it to the file
  $serialized = serialize($serializedData);
  file_put_contents('serializedData.txt', $serialized);
  
  echo "Data updated successfully.";
}

if (isset($_POST['delete'])) {
  $username = $_POST['username'];
  
  // Read the serialized data from the file and deserialize it
  $serialized = file_get_contents('serializedData.txt');
  $serializedData = unserialize($serialized);
  
  // Delete the data for the specified username
  $serializedData->deleteDataForUsername($username);
  
  // Serialize the updated data and write it to the file
  $serialized = serialize($serializedData);
  file_put_contents('serializedData.txt', $serialized);
  
  echo "Data deleted successfully.";
}



class SerializedData {
  private $data = array();
  
  public function __construct($username, $data) {
    $this->setDataForUsername($username, $data);
  }
  
  public function getDataForUsername($username) {
    if (isset($this->data[$username])) {
      return $this->data[$username];
    } else {
      return null;
    }
  }
  
  public function setDataForUsername($username, $data) {
    $this->data[$username] = $data;
  }
  
  public function deleteDataForUsername($username) {
    unset($this->data[$username]);
  }
}
