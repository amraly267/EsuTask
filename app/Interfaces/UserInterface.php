<?php

namespace App\Interfaces;

interface UserInterface {

  public function getAll(array $parameters);
  public function create(array $row);
  public function show($whereCondition);
  public function update($row, $id);
  public function delete($id);

}

?>
