<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Josefin+Slab:ital,wght@0,100..700;1,100..700&family=Kaushan+Script&family=Sixtyfour&display=swap" rel="stylesheet">
    <style>
      * {
        font-family: 'Josefin Sans', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body {
        background-color: #343434;
      }
      header {
        background-color: white;
        text-align: center;
        padding: 10px;
        font-size: 30px;
      }
      .container {
        display: flex;
      }
      nav {
        background-color: #343434;
        color: white;
        text-align: center;
        padding: 10px;
        width: 25%;
        height: 100vh;
      }
      nav a {
        display: flex;
        color: white;
        text-decoration: none;
        align-items: center;
        width: fit-content;
        padding: 10px;
      }
      nav a:hover {
        background-color: lightpink;
      }
      .headersymbols {
        margin-right: 8px;
      }
      main {
        width: 75%;
        margin: 8px;
        border-radius: 8px;
        padding: 8px;
        background-color: rebeccapurple;
      }
      .pagename{
        text-align: center;
        font-size: 40px;
        margin-top: 30px;
        text-transform: uppercase;
      }
      .introtext{
        margin-bottom: 8px;
      }
      .input{
        margin-bottom: 8px;
        padding: 4px;
      }
      .footer {
        padding: 8px;
        text-align: center;
        background-color: #343434;
      }
      .sitemap a {
        display: block;
        margin-bottom: 20px;
      }
      button {
        padding: 2px;
      }
      .contact-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 8px;
        margin: 16px;
        background-color: lightsalmon;
        border-radius: 16px;
        gap: 8px;
      }
      .phone-button {
        text-decoration: none;
        color: white;
        background-color: #834712;
        padding: 4px;
        border-radius: 4px;
      }
      .phone-button:hover {
        background-color: lightpink;
      }
      .delete {
        background-color: red;
      }
    </style>
  </head>
  <body>
      <header>
        <h1>Meine Webseite</h1>
      </header>
      <div class="container">
        <nav>
          <?php
      $menu = "
      <a href='index.php'>
      <img class='headersymbols' src='img/home.svg'>
      Start
      </a>
      <a href='index.php?page=contacts'>
      <img class='headersymbols' src='img/contacts.svg'>
      Kontakte
      </a>
      <a href='index.php?page=addcontact'>
      <img class='headersymbols' src='img/addcontact.svg'>
      Kontakt hinzufügen
      </a>
      <a href='index.php?page=legal'>
      <img class='headersymbols' src='img/imprint.svg'>
      Impressum
      </a>
      <a href='index.php?page=sitemap'>
      <img class='headersymbols' src='img/map.svg'>
      Sitemap
      </a>
      ";
      echo $menu;
      ?>
      </nav>
      <main>
        <?php        
        $contacts = [];

        if(file_exists('contacts.txt')) {
          $text = file_get_contents('contacts.txt', true);
          $contacts = json_decode($text, true);
        }

        if(isset($_GET['delete'])) {
          $indexToDelete = $_GET['delete'];
          if (isset($contacts[$indexToDelete])){
            unset($contacts[$indexToDelete]);
            file_put_contents('contacts.txt', json_encode(array_values($contacts), JSON_PRETTY_PRINT));
            echo "<p>Kontakt wurde gelöscht.</p>";
          }
        }

        if(isset($_POST["name"]) && isset($_POST["phone"])){
          echo "<p>Kontakt <b>" . $_POST['name'] . "</b> wurde hinzugefügt.</p>";
          $newContact  = [
            'name' => $_POST['name'],
            'phone' => $_POST['phone']
          ];
          array_push($contacts, $newContact);
          file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT));
        }

        if (!$_GET['page']) {
          $headline = 'Herzlich Willkommen!';
        } else {
          $headline = $_GET['page'];
        }
        echo '<h1 class="pagename">' . $headline . '</h1>';
        if ($_GET['page'] == 'contacts') {
          echo '<p>Das sind Deine Kontakte:</p>';
          foreach ($contacts as $index => $row) {
          $name=$row['name'];
          $phone=$row['phone'];
          echo "<div class='contact-card'><img src='img/person.svg'>
          <p>Name: " . $name . "</p>
          <p>Telefon: " . $phone . "</p>
          <a class='phone-button' href='tel:$phone'>Anrufen</a>
          <a class='phone-button delete' href='index.php?page=contacts&delete=$index'>Kontakt löschen</a>
          </div>
          ";
          }
        } elseif ($_GET['page'] == "sitemap") {
          echo '<p>Das ist die Sitemap-Seite.</p>';
          echo '<div class="sitemap">' . $menu . '</div>';
        } elseif ($_GET['page'] == "addcontact") {
          echo '<p class="introtext">Hier kann man Kontakte hinzufügen.</p>
          <form action="index.php?page=contacts" method="POST">
          <label for="name">Name:</label>
          <br>
          <input id="name" class="input" placeholder="Johny Cash" type="text" name="name" required>
          <br>
          <label for="phonenumber">Telefonnummer:</label>
          <br>
          <input id="phonenumber" class="input" placeholder="+49 123 1234 1234" type="text" name="phone" required>
          <br>
          <button type="submit">Kontakt hinzufügen</button>
          </form>';
        } elseif ($_GET['page'] == 'legal') {
          echo '<p>Das ist das Impressum.</p>';
        } else {
          echo '<p>Das ist die Willkommensseite.</p>';
        }
        ?>
      </main>
    </div>
      <footer class="footer">
        (c) 2024 by Florian Lutz
      </footer>
    </body>
</html>