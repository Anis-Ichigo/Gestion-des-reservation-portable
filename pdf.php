<?php
require('decide-lang.php');
require('Connexion_BD.php');
mysqli_set_charset($session, "utf8");
date_default_timezone_set('Europe/Paris');

require('fpdf183/fpdf.php');

$IdentifiantE = $_POST['IdentifiantE'];


$informations = "SELECT materiel.IdentifiantM AS 'IdentifiantM', materiel.CategorieM AS 'CategorieM', emprunt.DateRetour AS 'DateRetour', modele.IdentifiantMo AS 'IdentifiantMo', modele.Marque AS 'Marque', emprunt.DateEmprunt AS 'DateEmprunt', emprunt.IdentifiantE AS 'IdentifiantE', personne.PrenomPe AS 'PrenomPe', personne.NomPe AS 'NomPe'
                                        FROM personne, materiel, emprunt, modele
                                        WHERE emprunt.IdentifiantM = materiel.IdentifiantM
                                        AND emprunt.IdentifiantPe = personne.IdentifiantPe
                                        AND materiel.IdentifiantMo = modele.IdentifiantMo
                                        AND emprunt.IdentifiantE = '$IdentifiantE'";
$result = mysqli_query($session, $informations);

foreach ($result as $row) {
    $IdentifiantM = $row['IdentifiantM'];
    $CategorieM = $row['CategorieM'];
    $date_retour = strftime('%d/%m/%Y', strtotime($row['DateRetour']));;
    $modele = $row['IdentifiantMo'];
    $marque = $row['Marque'];
    $date_emprunt = strftime('%d/%m/%Y', strtotime($row['DateEmprunt']));
    $IdentifiantE = $row['IdentifiantE'];
    $prenom = $row['PrenomPe'];
    $nom = $row['NomPe'];
}


if ($CategorieM == 'Ordinateur') {
    $var = "un";
} else {
    $var = "une";
}

    class PDF extends FPDF
    {
        protected $B = 0;
        protected $I = 0;
        protected $U = 0;
        protected $HREF = '';

        function WriteHTML($html)
        {
            // HTML parser
            $html = str_replace("\n", ' ', $html);
            $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
            foreach ($a as $i => $e) {
                if ($i % 2 == 0) {
                    // Text
                    if ($this->HREF)
                        $this->PutLink($this->HREF, $e);
                    else
                        $this->Write(10, $e);
                } else {
                    // Tag
                    if ($e[0] == '/')
                        $this->CloseTag(strtoupper(substr($e, 1)));
                    else {
                        // Extract attributes
                        $a2 = explode(' ', $e);
                        $tag = strtoupper(array_shift($a2));
                        $attr = array();
                        foreach ($a2 as $v) {
                            if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                                $attr[strtoupper($a3[1])] = $a3[2];
                        }
                        $this->OpenTag($tag, $attr);
                    }
                }
            }
        }

        function OpenTag($tag, $attr)
        {
            // Opening tag
            if ($tag == 'B' || $tag == 'I' || $tag == 'U')
                $this->SetStyle($tag, true);
            if ($tag == 'A')
                $this->HREF = $attr['HREF'];
            if ($tag == 'BR')
                $this->Ln(10);
        }

        function CloseTag($tag)
        {
            // Closing tag
            if ($tag == 'B' || $tag == 'I' || $tag == 'U')
                $this->SetStyle($tag, false);
            if ($tag == 'A')
                $this->HREF = '';
        }

        function SetStyle($tag, $enable)
        {
            // Modify style and select corresponding font
            $this->$tag += ($enable ? 1 : -1);
            $style = '';
            foreach (array('B', 'I', 'U') as $s) {
                if ($this->$s > 0)
                    $style .= $s;
            }
            $this->SetFont('', $style);
        }

        function PutLink($URL, $txt)
        {
            // Put a hyperlink
            $this->SetTextColor(0, 0, 255);
            $this->SetStyle('U', true);
            $this->Write(5, $txt, $URL);
            $this->SetStyle('U', false);
            $this->SetTextColor(0);
        }
    }


/*
    echo $prenom;
    echo $nom ;
    echo $var ;
    echo $CategorieM ;
    echo $IdentifiantM;
    echo $date_retour;
    echo $modele;
    echo $marque;
    echo $date_emprunt;
*/

$pdf = new PDF();
$pdf->SetLeftMargin(30);
$pdf->SetRightMargin(30);
$pdf->AddPage();
$pdf->Image('miage.jpg', 10, 6, 30);
$pdf->Ln(60);
$pdf->SetFont('Helvetica', '', 14);

$pdf->WriteHTML(iconv('UTF-8', 'windows-1252', "Je soussigné(e) <b>{$prenom} {$nom} </b>, déclare recevoir {$var} <b>{$CategorieM} N°{$IdentifiantM}.</b> Je m’engage à restituer le matériel à tout moment si le responsable de la formation en a besoin ou avant le <b>{$date_retour}</b> dans le pire des cas.
"));
$pdf->Ln(15);
$pdf->WriteHTML(iconv('UTF-8', 'windows-1252', "Le prêt comprend :<br>- {$var} <b>{$CategorieM} {$modele}</b> de la marque <b>{$marque}</b>"));
$pdf->Ln();
$pdf->WriteHTML(iconv('UTF-8', 'windows-1252',"- une sacoche"));

$pdf->Ln(30);
$pdf->SetLeftMargin(135);
$pdf->MultiCell(0, 10, iconv('UTF-8', 'windows-1252', "Fait le {$date_emprunt}"));

$pdf->SetLeftMargin(30);
$pdf->SetRightMargin(15);
$pdf->Ln(15);
$pdf->Image('box.png', 31, 192, 5, 0, '');
$pdf->SetLeftMargin(40);
$pdf->WriteHTML(iconv('UTF-8', 'windows-1252', "Je certifie sur l'honneur être d'accord avec le présent contrat."));
$pdf->Ln(15);
$pdf->Image('box.png', 31, 207, 5, 0, '');
$pdf->SetLeftMargin(40);
$pdf->WriteHTML(iconv('UTF-8', 'windows-1252', "En cochant cette case, je consent à l'utilisation de ma signature électronique, je certifie qu'elle est valide et a le même effet qu'une signature écrite sur une copie papier de ce document."));


$pdf->Output();


?>
