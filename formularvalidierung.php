<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = array();

  header("Access-Control-Allow-Origin: https://example.com");
  header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  header("Content-Security-Policy: default-src 'self'; img-src 'self' https://example.com; style-src 'self' 'unsafe-inline';");
}

 // Überprüfung des Nutzernamens
 if (empty($_POST['username'])) {
    $errors[] = 'Der Nutzername darf nicht leer sein.';
  } else {
    $username = $_POST['username'];
    if (strlen($username) < 4) {
      $errors[] = 'Der Nutzername muss mindestens 4 Zeichen lang sein.';
    } elseif (strlen($username) > 16) {
      $errors[] = 'Der Nutzername darf höchstens 16 Zeichen lang sein.';
    } elseif (preg_match('/\s/', $username)) {
      $errors[] = 'Der Nutzername darf keine Leerzeichen enthalten.';
    }
  }

  // Überprüfung der E-Mail-Adresse
  if (empty($_POST['email'])) {
    $errors[] = 'Die E-Mail-Adresse darf nicht leer sein.';
  } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Die E-Mail-Adresse ist ungültig.';
  }

  // Überprüfung des Passworts
  if (empty($_POST['password'])) {
    $errors[] = 'Das Passwort darf nicht leer sein.';
  } else {
    $password = $_POST['password'];
    if (strlen($password) < 8) {
      $errors[] = 'Das Passwort muss mindestens 8 Zeichen lang sein.';
    } elseif (!preg_match('/[a-z]/', $password)) {
      $errors[] = 'Das Passwort muss mindestens einen Kleinbuchstaben enthalten.';
    } elseif (!preg_match('/[A-Z]/', $password)) {
      $errors[] = 'Das Passwort muss mindestens einen Großbuchstaben enthalten.';
    } elseif (!preg_match('/[0-9]/', $password)) {
      $errors[] = 'Das Passwort muss mindestens eine Zahl enthalten.';
    } elseif (!preg_match('/[^a-zA-Z\d]/', $password)) {
      $errors[] = 'Das Passwort muss mindestens ein Sonderzeichen enthalten.';
    } elseif (preg_match('/\s/', $password)) {
      $errors[] = 'Das Passwort darf keine Leerzeichen enthalten.';
    }
  }

    // Überprüfung des Geschlechts
    if (empty($_POST['gender'])) {
        $errors[] = 'Das Geschlecht muss ausgewählt werden.';
      }
    
      // Überprüfung des Landes
      if (empty($_POST['country'])) {
        $errors[] = 'Das Land muss ausgewählt werden.';
      }
    
      // Überprüfung der AGB-Akzeptanz
      if (empty($_POST['agb'])) {
        $errors[] = 'Die AGB müssen akzeptiert werden.';
      }
    
      if (count($errors) === 0) {
        // Formulardaten speichern oder weiterverarbeiten
      } else {
        // Fehlermeldungen ausgeben
        foreach ($errors as $error) {
          echo $error . '<br>';
        }
      }
    

    ?>