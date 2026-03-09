<?php
/////////////////////////////////////////////////////////
//SMTP Mailer Scrip auf Basis von:                    //
//PHPMailer 5.2.9 (Last Update 15.10.2014)            //
//****************************************************//
//Urheber: Alexander Pascual                          //
//Kontakt: alex-pascual@hotmail.com                   //
//Version 1.01 (Last Update 15.10.2014)               //
//Copyright (c): Dieses Script darf unter Angabe      //
//des Urhebers verwendet werden und ist ausdrücklich  //
//erwünscht.                                          //
////////////////////////////////////////////////////////

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;


// ======= Text der Mail aus den Formularfeldern erstellen:
 
if(isset($_REQUEST)) { 											// Wenn Daten mit method="post oder get" versendet wurden
   foreach($_REQUEST as $name => $value) {						// alle Formularfelder der Reihe nach durchgehen
      if(is_array($value)) {									// Wenn der Feldwert aus mehreren Werten besteht (z.B. <select multiple>)
          $mailText .= $name . "<br />\n";						// "Feldname:" und Zeilenumbruch dem Mailtext hinzufügen
          foreach($valueArray as $entry) {						// alle Werte des Feldes abarbeiten
             $mailText .= "   " . $value . "<br />\n";			// Einrückungsleerzeichen, Wert und Zeilenumbruch dem Mailtext hinzufügen
          } 													// ENDE: foreach
      }															// ENDE: if 
      else {													// Wenn der Feldwert ein einzelner Feldwert ist
          $mailText .= $name . ": " . $value . "<br />\n"; 		// "Feldname:", Wert und Zeilenumbruch dem Mailtext hinzufügen
      }															// ENDE: else
   } 															// ENDE: foreach
}																// Ende: if


// ======= Server-Verbindung aufbauen (SMTP Konfiguration):

//$mail->SMTPDebug = 3;                             	// Aktiviert verbose debug ausgabe, wenn "//" gelöscht

$mail->isSMTP();                                 	    // Führt Script mit SMTP Verbindung aus
$mail->Host = 'smtp.steingeist.ch';                         // SMTP Server-Adresse (FQDN oder IP)
$mail->SMTPAuth = true;                                 // Authentifizierung: Ein = true; aus = false
$mail->Username = 'form@steingeist.ch';      			// SMTP Benutzername
$mail->Password = '6+Ru$588';                            // SMTP Passwort
$mail->SMTPSecure = '';                                 // Keine Verschlüsselung = ''; SSL = 'ssl'; TLS = 'tls'
$mail->Port = 587;                                      // TCP Port für die SMTP Verbindung


// ======= Definition des Absenders, der Empfänger, sowie CC und BCC Empfänger:

$mail->From = 'bildhauerei@steingeist.ch';								// Absender des Mails
$mail->FromName = 'STEINGEIST.ch';						// Angezeigter Absendername
$mail->addAddress('form@steingeist.ch', 'Formular Steingeist');    	// Empfänger des Formulares
$mail->addAddress('');                 								// Optional: Name des Formular-Empfängers
$mail->addReplyTo('', ' ');											// Antwortadresse für gesendete Nachricht
$mail->addCC('');													// CC Empfänger des Formulares
$mail->addBCC('');													// BCC Empfänger des Formulares


// ======= Weitere Mailinformationen (Anhang, Versand als HTML-Mail):

$mail->WordWrap = 50;                                 // Festlegen des Zeilenumbruchs auf 50 Zeichen
$mail->addAttachment('');        					  // Hinzufügen von Anhängen (Dateipfad auf dem Server)
$mail->addAttachment('', '');   					  // Optional: Name des Anhangs
$mail->isHTML(true);                                  // Setzt E-Mail Format auf HTML = true


// ======= Angabe des Mail-Betreffs, der Nachricht und eine Nachricht für nicht-HTML kompatible Clients:

$mail->Subject = 'Kontaktaufnahme - STEINGEIST.ch';				  // Betreff des Formulares
$mail->Body    = "$mailText";						  // Zu sendende Nachricht (HTML)
$mail->AltBody = 'Sie können diese Nachricht nicht lesen, da Ihr E-Mail-Programm keine HTML Nachrichten unterstützt.';


// ======= Funktin zum versenden Formulares:

if(!$mail->send()) {
    echo 'Nachricht konnte nicht versendet werden.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Die Nachricht wurde erfolgreich versendet!';

// header("location: http://www.graechen.com/Kontakt_D/Danke.html");
}


?>
<meta http-equiv="refresh" content="0; URL=http://www.steingeist.ch/form/danke.html">
