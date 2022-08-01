<?php
session_start();
require_once("include/config.inc.php");
$objRows = new CommonCRUD();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KEMURI Technology</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
  </head>
  <body>

    <div id="wrap">
      <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                    <li class="nav-item active">
                      <a class="nav-link" href="<?php echo SITE_URL; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo SITE_URL.'search.php'; ?>">Search</a>
                    </li>
                  </ul>
                </div>
              
            </div>
          </div>
        </div>
      </nav>
    
 