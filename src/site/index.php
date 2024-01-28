<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  return include("../view/pages/home.php");
};
